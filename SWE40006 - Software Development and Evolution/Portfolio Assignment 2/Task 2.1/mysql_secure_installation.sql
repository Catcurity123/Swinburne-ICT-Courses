UPDATE mysql.user SET Password=PASSWORD('luan123') WHERE User='root';
DELETE FROM mysql.user WHERE User='';
DELETE FROM mysql.user WHERE User='root' AND Host NOT IN ('localhost', '127.0.0.1', '::1');
DROP DATABASE IF EXISTS test;
DELETE FROM mysql.db WHERE Db='test' OR Db='test\\_%';
FLUSH PRIVILEGES;

-- mysql -sfu root < "mysql_secure_installation.sql" --

-- UPDATE mysql.user SET Password=PASSWORD('p5CuDklKauPbkzfW') WHERE User='root';