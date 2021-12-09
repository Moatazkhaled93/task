# create databases
CREATE DATABASE IF NOT EXISTS `lamasatech_master`;
CREATE DATABASE IF NOT EXISTS `visipoint_gpd`;

# create root user and grant rights
CREATE USER 'root'@'localhost' IDENTIFIED BY 'local';
GRANT ALL PRIVILEGES ON *.* TO 'root'@'%';
