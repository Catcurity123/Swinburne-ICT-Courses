#!//bin//bash
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
sudo git clone https://github.com/Catcurity123/Tempt-Repos
# Setup databases
cd Tempt-Repos
cp mysql* /home/ec2-user/
cp wp-config.php /home/ec2-user/
cd /home/ec2-user/
sudo chmod +x mysql_setup_db.sh
./mysql_setup_db.sh
# Install WordPress
wget https://wordpress.org/latest.tar.gz
tar -xzf latest.tar.gz
sudo cp wp-config.php ./wordpress
mkdir /var/www/html/blog
cp -r wordpress/* /var/www/html/blog/
