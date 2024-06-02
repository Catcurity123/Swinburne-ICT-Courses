CREATE USER 'wp_user'@'localhost' IDENTIFIED BY 'luan123';
CREATE DATABASE wp_db;
GRANT ALL PRIVILEGES ON wp_db.* TO 'wp_user'@'localhost';
FLUSH PRIVILEGES;

/* test-rds.curiyylknltj.us-east-1.rds.amazonaws.com