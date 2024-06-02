# Generic variables
region = "us-east-1"

# VPC variables
vpc_name             = "assignment2"
vpc_cidr             = "10.0.0.0/16"
vpc_azs              = ["us-east-1a", "us-east-1b"]
vpc_public_subnets   = ["10.0.1.0/24", "10.0.2.0/24"]
vpc_private_subnets  = ["10.0.11.0/24", "10.0.12.0/24"]
vpc_database_subnets = ["10.0.21.0/24", "10.0.22.0/24"]
vpc_tags             = { "created-by" = "terraform" }

# RDS variables
rds_sg_name                               = "a2-rds-sg"
rds_sg_description                        = "a2-rds-sg"
rds_sg_tags                               = { "Name" = "a2-rds-sg", "created-by" = "terraform" }
rds_identifier                            = "a2-rds"
rds_mariadb_engine                          = "mariadb"
rds_engine_version                        = "10.11.6"
rds_family                                = "mariadb10.11" # DB parameter group
rds_major_engine_version                  = "10.11"      # DB option group
rds_instance_class                        = "db.t3.micro"
rds_allocated_storage                     = 20
rds_max_allocated_storage                 = 100
rds_db_name                               = "a2_mariadb"
rds_username                              = "a2_user"
rds_port                                  = 3306
rds_multi_az                              = false
rds_maintenance_window                    = "Mon:00:00-Mon:03:00"
rds_backup_window                         = "03:00-06:00"
rds_enabled_cloudwatch_logs_exports       = ["general"]
rds_create_cloudwatch_log_group           = true
rds_backup_retention_period               = 0
rds_skip_final_snapshot                   = true
rds_deletion_protection                   = false
rds_performance_insights_enabled          = false
rds_performance_insights_retention_period = 7
rds_create_monitoring_role                = true
rds_monitoring_interval                   = 60
rds_tags                                  = { "Name" = "a2-rds", "created-by" = "terraform" }
rds_db_instance_tags                      = { "Name" = "a2-rds-instance", "created-by" = "terraform" }
rds_db_option_group_tags                  = { "Name" = "a2-rds-option-group", "created-by" = "terraform" }
rds_db_parameter_group_tags               = { "Name" = "a2-rds-db-parameter-group", "created-by" = "terraform" }
rds_db_subnet_group_tags                  = { "Name" = "a2-rds-db-subnet-group", "created-by" = "terraform" }

# ALB variables
alb_sg_name                    = "a2-alb-sg"
alb_sg_ingress_cidr_blocks     = ["0.0.0.0/0"]
alb_sg_description             = "a2-alb-sg"
alb_sg_tags                    = { "Name" = "a2-alb-sg", "created-by" = "terraform" }
alb_name                       = "a2-alb"
alb_http_tcp_listeners_port    = 80
alb_target_group_name          = "a2-alb-tg"
alb_target_groups_backend_port = 80
alb_tags                       = { "Name" = "a2-alb", "created-by" = "terraform" }

# ASG variables
asg_sg_name                             = "a2-asg-sg"
asg_sg_description                      = "a2-asg-sg"
asg_sg_tags                             = { "Name" = "a2-asg-sg", "created-by" = "terraform" }
asg_name                                = "a2-asg"
asg_min_size                            = 0
asg_max_size                            = 4  
asg_desired_capacity                    = 2
asg_wait_for_capacity_timeout           = 0
asg_health_check_type                   = "EC2"
asg_launch_template_name                = "a2-lt"
asg_launch_template_description         = "a2-lt"
asg_update_default_version              = true
asg_image_id                            = "ami-026b57f3c383c2eec"
asg_instance_type                       = "t3.micro"
asg_ebs_optimized                       = true
asg_enable_monitoring                   = true
asg_create_iam_instance_profile         = true
asg_iam_role_name                       = "a2-asg-iam-role"
asg_iam_role_path                       = "/ec2/"
asg_iam_role_description                = "a2-asg-iam-role"
asg_iam_role_tags                       = { "Name" = "a2-asg-iam-role", "created-by" = "terraform" }
asg_block_device_mappings_volume_size_0 = 20
asg_block_device_mappings_volume_size_1 = 30
asg_instance_tags                       = { "Name" = "a2-asg-instance", "created-by" = "terraform" }
asg_volume_tags                         = { "Name" = "a2-asg-volume", "created-by" = "terraform" }
asg_tags                                = { "Name" = "a2-asg", "created-by" = "terraform" }
asg_key_name = "test_key_web"

# Bastion Host
ec2_name = "test_web"
ec2_instance_type = "t2.micro"
ec2_key_name = "test_key_web"