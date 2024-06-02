################################################################################
# Local variables
################################################################################

locals {
  user_data = <<-EOT
#!//bin//bash

LOG_FILE="/home/ec2-user/init_log.txt"

# Function to log successful installation
log_success() {
    echo "$(date): $1 successfully installed" >> "$LOG_FILE"
}

# Update system packages
sudo yum update -y
log_success "Init files"

# Install Git
sudo yum install -y git
log_success "Git"

# Install Apache
sudo yum install -y httpd
log_success "Apache"

# Install MariaDB
sudo yum install -y mariadb-server
log_success "MariaDB"

# Install PHP
sudo amazon-linux-extras install -y php7.4
log_success "PHP"

# Start and enable Apache and MariaDB
sudo systemctl start httpd
sudo systemctl enable httpd
sudo systemctl start mariadb
sudo systemctl enable mariadb

# Set file permissions for ec2-user
sudo usermod -a -G apache ec2-user
sudo chown -R ec2-user:apache /var/www
sudo chmod 2775 /var/www && find /var/www -type d -exec sudo chmod 2775 {} \;
find /var/www -type f -exec sudo chmod 0664 {} \;
echo "<?php phpinfo(); ?>" > /var/www/html/phpinfo.php

# Clone necessary mysql setup
sudo git clone https://github.com/Catcurity123/Temp_repos_tf

# Setup databases
cd Temp_repos_tf
cp mysql* /home/ec2-user/
cp wp-config.php /home/ec2-user/
cd /home/ec2-user/
sed -i 's/localhost/${module.rds.db_instance_address}/g' mysql_db_config_file.sql
mysql -h ${module.rds.db_instance_address} -sfu ${module.rds.db_instance_username} -p${module.rds.db_instance_password} < "mysql_db_config_file.sql"


sed -i 's/localhost/${module.rds.db_instance_address}/g' wp-config.php
sed -i 's/wp_user/${module.rds.db_instance_username}/g' wp-config.php
sed -i 's/luan123/${module.rds.db_instance_password}/g' wp-config.php

# Install WordPress
cd /var/www/html/
wget https://wordpress.org/latest.tar.gz
tar -xzf latest.tar.gz
cp /home/ec2-user/wp-config.php wordpress/

  EOT
}

################################################################################
# Supporting Resources
################################################################################

module "asg_sg" {
  source  = "terraform-aws-modules/security-group/aws"
  version = "~> 4.0"

  name        = var.asg_sg_name
  description = var.asg_sg_description
  vpc_id      = module.vpc.vpc_id

  computed_ingress_with_source_security_group_id = [
    {
      rule                     = "http-80-tcp"
      source_security_group_id = module.alb_http_sg.security_group_id
    },
    {
      rule                     = "ssh-tcp"
      source_security_group_id = aws_security_group.Web_SG.id
    }
  ]
  number_of_computed_ingress_with_source_security_group_id = 2

  egress_rules = ["all-all"]

  tags = var.asg_sg_tags
}

################################################################################
# Autoscaling scaling group (ASG)
################################################################################

module "asg" {
  source = "terraform-aws-modules/autoscaling/aws"

  # Autoscaling group
  name = var.asg_name

  min_size                  = var.asg_min_size
  max_size                  = var.asg_max_size
  desired_capacity          = var.asg_desired_capacity
  wait_for_capacity_timeout = var.asg_wait_for_capacity_timeout
  health_check_type         = var.asg_health_check_type
  vpc_zone_identifier       = module.vpc.private_subnets
  target_group_arns         = module.alb.target_group_arns
  user_data                 = base64encode(local.user_data)

  # Launch template
  launch_template_name        = var.asg_launch_template_name
  launch_template_description = var.asg_launch_template_description
  update_default_version      = var.asg_update_default_version

  image_id          = var.asg_image_id
  instance_type     = var.asg_instance_type
  ebs_optimized     = var.asg_ebs_optimized
  enable_monitoring = var.asg_enable_monitoring
  key_name = var.asg_key_name

  # IAM role & instance profile
  create_iam_instance_profile = var.asg_create_iam_instance_profile
  iam_role_name               = var.asg_iam_role_name
  iam_role_path               = var.asg_iam_role_path
  iam_role_description        = var.asg_iam_role_description
  iam_role_tags               = var.asg_iam_role_tags
  iam_role_policies = {
    AmazonSSMManagedInstanceCore = "arn:aws:iam::aws:policy/AmazonSSMManagedInstanceCore"
  }

  block_device_mappings = [
    {
      # Root volume
      device_name = "/dev/xvda"
      no_device   = 0
      ebs = {
        delete_on_termination = true
        encrypted             = true
        volume_size           = var.asg_block_device_mappings_volume_size_0
        volume_type           = "gp2"
      }
      }, {
      device_name = "/dev/sda1"
      no_device   = 1
      ebs = {
        delete_on_termination = true
        encrypted             = true
        volume_size           = var.asg_block_device_mappings_volume_size_1
        volume_type           = "gp2"
      }
    }
  ]

  network_interfaces = [
    {
      delete_on_termination = true
      description           = "eth0"
      device_index          = 0
      security_groups       = [module.asg_sg.security_group_id]
    },
    {
      delete_on_termination = true
      description           = "eth1"
      device_index          = 1
      security_groups       = [module.asg_sg.security_group_id]
    }
  ]

  tag_specifications = [
    {
      resource_type = "instance"
      tags          = var.asg_instance_tags
    },
    {
      resource_type = "volume"
      tags          = var.asg_volume_tags
    }
  ]

  tags = var.asg_tags
}