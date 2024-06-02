#!/bin/bash

LOG_FILE="/home/ec2-user/db_log.txt"
MYSQL_ROOT_PASSWORD="luan123"

# Function to log successful operation
log_success() {
    echo "$(date): $1" >> "$LOG_FILE"
}

# Execute mysql_secure_installation.sql
mysql -sfu root < "mysql_secure_installation.sql" && log_success "MySQL securely configured."

# Execute mysql_db_config_file.sql
mysql -sfu root -p"$MYSQL_ROOT_PASSWORD" < "mysql_db_config_file.sql" && log_success "MySQL user and database configured."

#mysql -sfu root -pluan123 < "mysql_db_config_file.sql" && log_success "MySQL user and database configured."
##mysql -h test-rds.curiyylknltj.us-east-1.rds.amazonaws.com -P 3306 -u test_user -pp5CuDklKauPbkzfW < "mysql_secure_installation.sql" 