# Generic variables
variable "region" {
  description = "Region code"
  type        = string
  default     = "us-east-1"
}

variable "project" {
  description = "The project name to use for unique resource naming"
  default     = "assignment2"
  type        = string
}

# VPC variables
variable "vpc_name" {
  description = "Name of the VPC"
  type        = string
  default     = "assignment2"
}

variable "vpc_cidr" {
  description = "VPC CIDR range"
  type        = string
  default     = "10.0.0.0/16"
}

variable "vpc_azs" {
  description = "List of AZs"
  type        = list(string)
  default     = ["us-east-1a", "us-east-1b", "us-east-1c"]
}

variable "vpc_public_subnets" {
  description = "List of public subnet CIDR ranges"
  type        = list(string)
  default     = ["10.0.11.0/24", "10.0.12.0/24", "10.0.13.0/24"]
}

variable "vpc_private_subnets" {
  description = "List of private subnet CIDR ranges"
  type        = list(string)
  default     = ["10.0.1.0/24", "10.0.2.0/24", "10.0.3.0/24"]
}

variable "vpc_database_subnets" {
  description = "List of database subnet CIDR ranges"
  type        = list(string)
  default     = ["10.0.21.0/24", "10.0.22.0/24", "10.0.23.0/24"]
}

variable "vpc_tags" {
  description = "Tags to apply to vpc peering for api x data vpc"
  type        = map(string)
  default     = { "Name" = "assignment2", "created-by" = "terraform" }
}

# EC2 variables
variable "ec2_name" {
  description = "Name of the EC2 instance"
  type        = string
  default = "test_web"
}

variable "ec2_instance_type" {
  description = "Type of the EC2 instance"
  type        = string
  default     = "t2.micro"
}

variable "ec2_key_name" {
  description = "Name of the key pair to use for the EC2 instance"
  type        = string
}

# RDS variables
variable "rds_sg_name" {
  description = "Relational database service security group name"
  type        = string
  default     = "test-rds-sg"
}

variable "rds_sg_description" {
  description = "Relational database service security group description"
  type        = string
  default     = "test-rds-sg"
}

variable "rds_sg_tags" {
  description = "Relational database service security group tags"
  type        = map(string)
  default     = { "Name" = "test-rds-sg", "created-by" = "terraform" }
}

variable "rds_identifier" {
  description = "Relational database service identifier"
  type        = string
  default     = "test-rds"
}

variable "rds_mariadb_engine" {
  description = "Relational database service mariadb engine"
  type        = string
  default     = "mariadb"
}

variable "rds_engine_version" {
  description = "Relational database service mariadb engine version"
  type        = string
  default     = "8.0.27"
}

variable "rds_family" {
  description = "Relational database service family"
  type        = string
  default     = "mariadb8.0"
}

variable "rds_major_engine_version" {
  description = "Relational database service major engine version"
  type        = string
  default     = "8.0"
}

variable "rds_instance_class" {
  description = "Relational database service instance class"
  type        = string
  default     = "db.t3.micro"
}

variable "rds_allocated_storage" {
  description = "Relational database service allocated storage"
  type        = number
  default     = 20
}

variable "rds_max_allocated_storage" {
  description = "Relational database service max allocated storage"
  type        = number
  default     = 100
}

variable "rds_db_name" {
  description = "Relational database service db name"
  type        = string
  default     = "test_mariadb"
}

variable "rds_username" {
  description = "Relational database service username"
  type        = string
  default     = "test_user"
}

variable "rds_port" {
  description = "Relational database service port"
  type        = number
  default     = 3306
}

variable "rds_multi_az" {
  description = "Relational database service multi az"
  type        = bool
  default     = false
}

variable "rds_maintenance_window" {
  description = "Relational database service maintenance window"
  type        = string
  default     = "Mon:00:00-Mon:03:00"
}

variable "rds_backup_window" {
  description = "Relational database service backup window"
  type        = string
  default     = "03:00-06:00"
}

variable "rds_enabled_cloudwatch_logs_exports" {
  description = "Relational database service enabled cloudwatch log exports"
  type        = list(any)
  default     = ["general"]
}

variable "rds_create_cloudwatch_log_group" {
  description = "Relational database service create cloudwatch log group"
  type        = bool
  default     = true
}

variable "rds_backup_retention_period" {
  description = "Relational database service backup retention period"
  type        = number
  default     = 0
}

variable "rds_skip_final_snapshot" {
  description = "Relational database service skip final snapshot"
  type        = bool
  default     = true
}

variable "rds_deletion_protection" {
  description = "Relational database service deletion protection"
  type        = bool
  default     = false
}

variable "rds_performance_insights_enabled" {
  description = "Relational database service insights enabled"
  type        = bool
  default     = false
}

variable "rds_performance_insights_retention_period" {
  description = "Relational database service retention period"
  type        = number
  default     = 7
}

variable "rds_create_monitoring_role" {
  description = "Relational database service create monitoring role"
  type        = bool
  default     = true
}

variable "rds_monitoring_interval" {
  description = "Relational database service monitoring interval"
  type        = number
  default     = 60
}

variable "rds_tags" {
  description = "Relational database service tags"
  type        = map(string)
  default     = { "Name" = "test-rds", "created-by" = "terraform" }
}

variable "rds_db_instance_tags" {
  description = "Relational database service db instance tags"
  type        = map(string)
  default     = { "Name" = "test-rds", "created-by" = "terraform" }
}

variable "rds_db_option_group_tags" {
  description = "Relational database service db option group tags"
  type        = map(string)
  default     = { "Name" = "test-rds", "created-by" = "terraform" }
}

variable "rds_db_parameter_group_tags" {
  description = "Relational database service db parameter group tags"
  type        = map(string)
  default     = { "Name" = "test-rds", "created-by" = "terraform" }
}

variable "rds_db_subnet_group_tags" {
  description = "Relational database service db subnet group tags"
  type        = map(string)
  default     = { "Name" = "test-rds", "created-by" = "terraform" }
}

# ALB variables
variable "alb_sg_name" {
  description = "Application load balancer security group name"
  type        = string
  default     = "demo-alb-sg"
}

variable "alb_sg_ingress_cidr_blocks" {
  description = "Application load balancer cidr blocks"
  type        = list(any)
  default     = ["0.0.0.0/0"]
}

variable "alb_sg_description" {
  description = "Application load balancer security group description"
  type        = string
  default     = "demo-alb-sg"
}

variable "alb_sg_tags" {
  description = "Application load balancer security group tags"
  type        = map(string)
  default     = { "Name" = "demo-alb-sg", "created-by" = "terraform" }
}

variable "alb_description" {
  description = "Application load balancer description"
  type        = string
  default     = "demo-alb"
}

variable "alb_name" {
  description = "Application load balancer name"
  type        = string
  default     = "demo-alb"
}

variable "alb_http_tcp_listeners_port" {
  description = "Application load balancer http listeners port"
  type        = number
  default     = 80
}

variable "alb_target_group_name" {
  description = "Application load balancer target group name"
  type        = string
  default     = "demo-alb-tg"
}

variable "alb_target_groups_backend_port" {
  description = "Application load balancer http listeners port"
  type        = number
  default     = 80
}

variable "alb_tags" {
  description = "Application load balancer tags"
  type        = map(string)
  default     = { "Name" = "demo-alb", "created-by" = "terraform" }
}
