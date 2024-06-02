terraform {
  backend "s3" {
    bucket         = "luandvassignment2-s3-backend"
    encrypt        = true
    key            = "terraform.tfstate"
    region         = "us-east-1"
    dynamodb_table = "luandvassignment2-s3-backend"
  }
}