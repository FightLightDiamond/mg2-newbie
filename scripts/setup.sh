#!/bin/bash
# Install Magento 2 on Ubuntu 20.04 | 18.04 with Nginx and Let’s Encrypt

## Setup
### Setup nginx
echo "Update os"
sudo apt update
echo "Install nginx"
sudo apt install nginx -y
sudo systemctl stop nginx.service
sudo systemctl start nginx.service
sudo systemctl enable nginx.service

### Install MariaDB Database Server
echo "Install MariaDB Database Server"
sudo apt-get install mariadb-server mariadb-client

sudo systemctl stop mariadb.service
sudo systemctl start mariadb.service
sudo systemctl enable mariadb.service


### nstall PHP 7.4 and Related Modules
echo "To get Magento latest release you may want to use Github repository… Install Composer, Curl and other dependencies to get started…"
sudo apt-get install software-properties-common
sudo add-apt-repository ppa:ondrej/php
sudo apt update
sudo apt install php7.4-fpm php7.4-common php7.4-mysql php7.4-gmp php7.4-curl php7.4-intl php7.4-mbstring php7.4-xmlrpc php7.4-gd php7.4-xml php7.4-cli php7.4-zip




## Config Manual
### Mysql
echo "Config MariaDB Database Server"
sudo mysql_secure_installation

echo "Enter current password for root (enter for none): Just press the Enter
Set root password? [Y/n]: Y
New password: Enter password
Re-enter new password: Repeat password
Remove anonymous users? [Y/n]: Y
Disallow root login remotely? [Y/n]: Y
Remove test database and access to it? [Y/n]:  Y
Reload privilege tables now? [Y/n]:  Y"

### Php
sudo nano /etc/php/7.4/fpm/php.ini

echo "
file_uploads = On
allow_url_fopen = On
short_open_tag = On
memory_limit = 256M
cgi.fix_pathinfo = 0
upload_max_filesize = 100M
max_execution_time = 360
date.timezone = America/Chicago
"


## Create database for magento
sudo mysql -u root -p
echo "
CREATE DATABASE magento;
CREATE USER 'magentouser'@'localhost' IDENTIFIED BY 'new_password_here';
GRANT ALL ON magento.* TO 'magentouser'@'localhost' WITH GRANT OPTION;
EXIT;
FLUSH PRIVILEGES;
"

##  Download Magento
sudo apt install curl git
curl -sS https://getcomposer.org/installer | sudo php -- --install-dir=/usr/local/bin --filename=composer

echo "
When prompted, enter your authentication keys. Your public key is your username; your private key is your password….  ( https://marketplace.magento.com/customer/accessKeys/ )
"

cd "/var/www/"
sudo composer create-project --repository=https://repo.magento.com/ magento/project-community-edition magento

echo "
Output:
Authentication required (repo.magento.com):
Username: 234f2343435d190983j0ew8u3220
Password:
Do you want to store credentials for repo.magento.com in /opt/magento/.config/composer/auth.json ? [Yn] Y
"

echo "After downloading Magento packages, run the commands below to install Magento with the following options:"
cd "/var/www/magento"
sudo bin/magento setup:install --base-url-secure=https://example.com/ --db-host=localhost --db-name=magento --db-user=magentouser --db-password=db_user_password_here --admin-firstname=Admin --admin-lastname=User --admin-email=admin@example.com --admin-user=admin --admin-password=admin123 --language=en_US --currency=USD --timezone=America/Chicago --use-rewrites=1

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
