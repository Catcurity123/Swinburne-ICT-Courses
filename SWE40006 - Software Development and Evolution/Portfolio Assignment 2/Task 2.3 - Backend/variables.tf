# Generic variables
variable "region" {
  description = "Region code"
  type        = string
  default     = "us-east-1"
}

variable "project" {
  description = "The project name to use for unique resource naming"
  default     = "luandvassignment2"
  type        = string
}

variable "principal_arns" {
  description = "A list of principal arns allowed to assume the IAM role"
  default     = null
  type        = list(string)
}