#!/bin/bash

sourcePath="/var/www"
projectName="magento"
baseUrlSecure=""
dbHost="localhost"
dbName="magento"
dbUsername="magentouser"
dbPassword="db_user_password_here"
adminFirstname="Admin"
adminLastname="User"
adminEmail="admin@example.com"
adminUser="admin"
adminPassword="admin123"
language="en_US"
currency="USD"
timezone="Asia/Ho_Chi_Minh"

echo "
When prompted, enter your authentication keys. Your public key is your username; your private key is your password….  ( https://marketplace.magento.com/customer/accessKeys/ )
"

cd $sourcePath
sudo composer create-project --repository=https://repo.magento.com/ magento/project-community-edition "$projectName"

echo "
Output:
Authentication required (repo.magento.com):
Username: 234f2343435d190983j0ew8u3220
Password:
Do you want to store credentials for repo.magento.com in /opt/magento/.config/composer/auth.json ? [Yn] Y
"

echo "After downloading Magento packages, run the commands below to install Magento with the following options:"

echo "
The Magento software is installed in the root directory on localhost…. Admin is admin;  therefore: Your storefront URL is https://exmaple.com
The database server is on the same localhost as the webserver….
The database name is magento, and the magentouser and password is db_user_password_here
Uses server rewrites
The Magento administrator has the following properties:
First and last name are: Admin User
Username is: admin
 and the password is admin123
E-mail address is: admin@example.com
Default language is: (U.S. English)
Default currency is: U.S. dollars
Default time zone is: U.S. Central (America/Chicago)
"

cd "$sourcePath/$projectName"
sudo bin/magento setup:install --base-url-secure="$baseUrlSecure" --db-host="$dbHost" --db-name="$dbName" --db-user="$dbUsername" --db-password="$dbPassword" --admin-firstname="$adminFirstname" --admin-lastname="$adminLastname" --admin-email="$adminEmail" --admin-user="$adminUser" --admin-password="$adminPassword" --language="$language" --currency="$currency" --timezone="$timezone" --use-rewrites=1


