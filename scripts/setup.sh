#!/bin/bash
# Install Magento 2 on Ubuntu 20.04 | 18.04 with Nginx and Let’s Encrypt
echo "<< Install Magento 2 on Ubuntu 20.04 | 18.04 with Nginx and Let’s Encrypt >>"
# Cài đặt Elasticsearch
echo "==================================> Begin setup Elasticsearch"
curl -fsSL https://artifacts.elastic.co/GPG-KEY-elasticsearch | sudo apt-key add -
echo "deb https://artifacts.elastic.co/packages/7.x/apt stable main" | sudo tee -a /etc/apt/sources.list.d/elastic-7.x.list
sudo apt update -y
sudo apt install elasticsearch -y
sudo systemctl restart elasticsearch
sudo systemctl enable elasticsearch
echo "==================================> Elasticsearch. Done"

# Cài đặt Phpstorm
echo "==================================> Begin setup Phpstorm"
sudo apt install ubuntu-make -y
umake ide phpstorm
chmod +x ~/.local/share/applications/jetbrains-phpstorm.desktop
echo "==================================> Phpstorm. Done"

## Setup
### Setup nginx
echo "==================================> Begin setup Nginx"
sudo apt update -y
echo "Install nginx"
sudo apt install nginx -y
sudo systemctl restart nginx.service
sudo systemctl enable nginx.service
echo "==================================> Nginx. Done"

### Install MariaDB Database Server
echo "==================================> Begin Install MariaDB Database Server"
sudo apt-get install mariadb-server mariadb-client -y

sudo systemctl restart mariadb.service
sudo systemctl enable mariadb.service
echo "==================================> MariaDB. Done"

### Install PHP 7.4 and Related Modules
echo "==================================> Begin Install PHP 7.4 and Related Modules"
echo "To get Magento latest release you may want to use Github repository… Install Composer, Curl and other dependencies to get started…"
sudo apt-get install software-properties-common -y
sudo add-apt-repository ppa:ondrej/php
sudo apt update -y
sudo apt install php7.4-fpm php7.4-common php7.4-mysql php7.4-gmp php7.4-curl php7.4-intl php7.4-mbstring php7.4-xmlrpc php7.4-gd php7.4-xml php7.4-cli php7.4-zip
# Cài đặt Xdebug
sudo apt-get install php-xdebug
echo "==================================> PHP 7.4 and Related Modules. Done"

###  Install Git
echo "==================================> Begin Install Git"
sudo apt install curl git -y
echo "==================================> Git. Done"

###  Install Composer
echo "==================================> Begin Install Composer"
curl -sS https://getcomposer.org/installer | sudo php -- --install-dir=/usr/local/bin --filename=composer
echo "==================================> Composer .Done"

echo "==================================> Information Nginx"
nginx -v
echo "==================================> Information PHP"
php -v
echo "==================================> Information Mysql"
mysql -V
echo "==================================> Information Elasticsearch"
curl -X GET 'http://localhost:9200'
echo "==================================> Information Composer"
composer -V
echo "==================================> Information Composer"
git --version

echo "Setup. Done.
Config magento follow this link: https://github.com/FightLightDiamond/mg2-newbie/blob/master/docs/setup.md"
echo "<< Thank you!!!!! >>"
