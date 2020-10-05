#!/bin/bash

# Create database for magento

dbHost="localhost"
dbName="magento"
dbUsername="magentouser"
dbPassword="db_user_password_here"

echo "Vi du tao database cho magento"
echo "
CREATE DATABASE $dbName;
CREATE USER '$dbUsername'@'$dbHost' IDENTIFIED BY '$dbPassword';
GRANT ALL ON $dbName.* TO '$dbUsername'@'$dbHost' WITH GRANT OPTION;
EXIT;
FLUSH PRIVILEGES;
"

read -p "Do you want connect mysql database? Are you sure? " -n 1 -r
echo "Please enter password"
if [[ $REPLY =~ ^[Yy]$ ]]
then
    sudo mysql -u root -p
fi
