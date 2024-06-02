# outputs.tf
output "ec2_instance_public_ip" {
  description = "Public IP address of the EC2 instance"
  value       = module.ec2-instance.public_ip
}
output "db_instance_endpoint" {
  description = "The connection endpoint"
  value       = module.rds.db_instance_endpoint
}
output "db_instance_address" {
  description = "The address of the RDS instance"
  value       = module.rds.db_instance_address
}
output "db_instance_password" {
  description = "The database password (this password may be old, because Terraform doesn't track it after initial creation)"
  value       = module.rds.db_instance_password
  sensitive   = true
}
output "db_instance_username" {
  description = "The database password (this password may be old, because Terraform doesn't track it after initial creation)"
  value       = module.rds.db_instance_username
  sensitive   = true
}

