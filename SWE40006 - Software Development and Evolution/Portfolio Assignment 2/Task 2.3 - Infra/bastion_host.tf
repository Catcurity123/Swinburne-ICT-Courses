# Security Group
resource "aws_security_group" "Web_SG" {
  name        = "Web_SG"
  description = "Allow SSH inbound and all outbound traffic"
  vpc_id      = module.vpc.vpc_id

  ingress {
    from_port   = 22
    to_port     = 22
    protocol    = "tcp"
    cidr_blocks = ["0.0.0.0/0"]
  }

  # Egress rule to allow all outbound traffic
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
    subnet_id              = module.vpc.public_subnets[1]
    vpc_security_group_ids = [aws_security_group.Web_SG.id]
    associate_public_ip_address = true

    tags = {
        Terraform   = "true"
        Environment = "dev"
    }
    }