# Security Group
resource "aws_security_group" "Web_SG" {
  name        = "Web_SG"
  description = "Allow HTTP inbound and all outbound traffic"
  vpc_id      = module.vpc.vpc_id

  ingress {
    from_port   = 80
    to_port     = 80
    protocol    = "tcp"
    security_groups = [module.alb_http_sg.security_group_id]
  }

  egress {
    from_port   = 0
    to_port     = 0
    protocol    = "-1"
    cidr_blocks = ["0.0.0.0/0"]
  }

  tags = {
    Name = "Web_SG"
  }
}

    module "ec2-instance" {
    source  = "terraform-aws-modules/ec2-instance/aws"

    name = var.ec2_name
    ami = "ami-0d94353f7bad10668"
    instance_type          = var.ec2_instance_type
    key_name               = var.ec2_key_name
    monitoring             = true
    subnet_id              = module.vpc.private_subnets[0]
    vpc_security_group_ids = [aws_security_group.Web_SG.id]
    associate_public_ip_address = false
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
    tags = {
        Terraform   = "true"
        Environment = "dev"
    }
}

