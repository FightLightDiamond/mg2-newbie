# Cài đặt Magento 2 trên Ubuntu 20.04 | 18.04 với Nginx và Let’s Encrypt

## Cài đặt môi trường
### Step 1: Cài đặt Nginx HTTP Server
Để cài đặt nginx, chạy command như sau:
```
sudo apt update
sudo apt install nginx
```

Sau khi cài cặt xong, sử dụng nhưng command phía dưới để stop, start, và enable service Nginx khởi chạy khi cùng với os
```
sudo systemctl stop nginx.service
sudo systemctl start nginx.service
sudo systemctl enable nginx.service
``` 

Kiểm tra nginx đã được cài đặt chưa, truy cập: 
```
http://localhost
```

Trên trình duyệt sẽ hiển thị thông báo như sau:
![Nginx running](https://websiteforstudents.com/wp-content/uploads/2016/11/xnginx_default_page.png.pagespeed.ic.VnH8vzL__A.webp)

### Step 2: Cài đặt MariaDB Database Server
Để cài đặt MariaDB, chạy command như sau:
```
sudo apt-get install mariadb-server mariadb-client
```

Sau khi cài cặt xong, sử dụng nhưng command phía dưới để stop, start, và enable service MariaDB khởi chạy khi cùng với os
```
sudo systemctl stop mariadb.service
sudo systemctl start mariadb.service
sudo systemctl enable mariadb.service
```

Cài đặt quản lý cấu hình bảo mật với câu lệnh sau:
```
sudo mysql_secure_installation
```

Một số câu hỏi theo sẽ xuất hiện như sau:
```
Enter current password for root (enter for none): Just press the Enter
Set root password? [Y/n]: Y
New password: Enter password
Re-enter new password: Repeat password
Remove anonymous users? [Y/n]: Y
Disallow root login remotely? [Y/n]: Y
Remove test database and access to it? [Y/n]:  Y
Reload privilege tables now? [Y/n]:  Y
``` 

Kiểm tra mysql đã hoạt động chưa
```
sudo mysql -u root -p
```

Sau đó bạn nhập mật khẩu bạn vừa thiết lập. Nếu thành công bạn sẽ thao tác với mysql với màn hình như sau
![Mysql running](https://websiteforstudents.com/wp-content/uploads/2018/01/xmariadb_ubuntu_1604.png.pagespeed.ic.AA7V3rdwWd.webp)

### Step 3: Cài đặt PHP 7.4 và Related Modules
Trước khi cài đặt cần thêm third-party PPA với commands: 
```
sudo apt-get install software-properties-common
sudo add-apt-repository ppa:ondrej/php
```

Sau đó cần update hệ thống
```
sudo apt update
```

Bây giờ có thể cài đặt PHP 7.4 và related modules
```
sudo apt install php7.4-fpm php7.4-common php7.4-mysql php7.4-gmp php7.4-curl php7.4-intl php7.4-mbstring php7.4-xmlrpc php7.4-gd php7.4-xml php7.4-cli php7.4-zip
```

Tùy chỉnh một số cấu hình để magento có thể chạy tốt hơn
```
sudo vi /etc/php/7.4/fpm/php.ini
```

Cấu hình tham khảo tôi đang sử dụng 
```
file_uploads = On
allow_url_fopen = On
short_open_tag = On
memory_limit = -1
cgi.fix_pathinfo = 0
upload_max_filesize = 100M
max_execution_time = 360
date.timezone = Asia/Ho_Chi_Minh
```

### Step 4: Tạo Magento Database
Logon vào  MariaDB database:
```
sudo mysql -u root -p
```
Tạo database, tôi đặt tên nó là `magento` 
```
CREATE DATABASE magento;
```

Tiếp theo, tạo một user mới và đặt mật khẩu. Tôi đặt là `magentouser`, mật khẩu là `new_password_here`
```
CREATE USER 'magentouser'@'localhost' IDENTIFIED BY 'new_password_here';
```

Cấp quyền truy cập cho 
```
GRANT ALL ON magento.* TO 'magentouser'@'localhost' WITH GRANT OPTION;
```

Cuối cùng chúng ta thay đổi và thoát
```
FLUSH PRIVILEGES;
EXIT;
```

### Step 5: Download Magento
Trước khi cài đặt magento ta cần cài đặt trước `curl`, `git` và `composer` 
```
sudo apt install curl git -y 
curl -sS https://getcomposer.org/installer | sudo php -- --install-dir=/usr/local/bin --filename=composer
```

Để cài chúng ta cần lấy `authentication keys`. 
Public key là username;  private key là  password. 
Truy cập ( https://marketplace.magento.com/customer/accessKeys/ ). 
Để lấy thông tin như sau 
![authentication keys](https://websiteforstudents.com/wp-content/uploads/2018/09/xmagento_ubuntu_keuy.png.pagespeed.ic.ouyKj8JlvY.webp)

Bây giờ đã đủ kiều kiện, chạy commands để download `magento`
```
cd /var/www/
sudo composer create-project --repository=https://repo.magento.com/ magento/project-community-edition magento   
```
Nó sẽ yêu cầu bạn điền authentication keys:
```
Output:
Authentication required (repo.magento.com):
Username: 234f2343435d190983j0ew8u3220
Password: 
Do you want to store credentials for repo.magento.com in /opt/magento/.config/composer/auth.json ? [Yn] Y
```

Bây giờ bạn tiến hành cài đặt magento với commands
```
cd /var/www/magento
sudo bin/magento setup:install --base-url-secure=https://example.com/ --db-host=localhost --db-name=magento --db-user=magentouser --db-password=db_user_password_here --admin-firstname=Admin --admin-lastname=User --admin-email=admin@example.com --admin-user=admin --admin-password=admin123 --language=en_US --currency=USD --timezone=America/Chicago --use-rewrites=1
```
- Url chạy magento là https://exmaple.com
- The database server chạy trên localhost 
- Tên database là magento, username là magentouser và password là db_user_password_here
- Uses server rewrites
- Họ tên của admin: Admin User
- Username là: admin
- Password là admin123
- E-mail là: admin@example.com
- Default language là: (U.S. English)
- Default currency là: U.S. dollars
- Default time zone là: U.S. Central (America/Chicago)

Những cấu hình trên thay đổi theo môi trường của bạn 

Chúng ta cấp quyền truy cập và sở hữu cho source code magento 
```
sudo chown -R www-data:www-data /var/www/magento/
sudo chmod -R 755 /var/www/magento/
```

### Step 6: Configure Nginx
Tạo file cấu hình magento trên nginx 
```
sudo vi /etc/nginx/sites-available/magento
```

Đây là thông tin cấu hình tham khảo
```
upstream fastcgi_backend {
  server fastcgi_pass unix:/var/run/php/php7.4-fpm.sock;
}

server {
    listen 80;
    listen [::]:80;

    server_name  example.com www.example.com;
    index  index.php;

    set $MAGE_ROOT /var/www/magento;
    set $MAGE_MODE production;

    access_log /var/log/nginx/example.com-access.log;
    error_log /var/log/nginx/example.com-error.log;

    include /var/www/megento/nginx.conf.sample;
}
```

Sau cần link thư mục cấu hình và restart lại `nginx` 
```
sudo ln -s /etc/nginx/sites-available/magento /etc/nginx/sites-enabled/
sudo systemctl restart nginx.service
```

Truy cập vào đường dẫn 
```
https://example.com
```

## Cài đặt công cụ phát triển

### 1. Cài đặt Elasticsearch 
Muốn cài elaticsearch cần phải cài đặt chúng với APT. Trước tiên phải add với command
```
curl -fsSL https://artifacts.elastic.co/GPG-KEY-elasticsearch | sudo apt-key add -
echo "deb https://artifacts.elastic.co/packages/7.x/apt stable main" | sudo tee -a /etc/apt/sources.list.d/elastic-7.x.list
```  

Cập nhật lại hệ thống 
```
sudo apt update
```

Bây giờ cài đặt:
```
sudo apt install elasticsearch
```

Sau khi cài cặt xong, sử dụng nhưng command phía dưới để stop, start, và enable service `elasticsearch` khởi chạy khi cùng với os
```
sudo systemctl stop elasticsearch
sudo systemctl start elasticsearch
sudo systemctl enable elasticsearch
```

Kiểm tra với curl get 
```
curl -X GET 'http://localhost:9200'
```
Nếu có kết quả tương tự là đã cài đặt thành công
```
{
  "name" : "ad-MS-7A15",
  "cluster_name" : "elasticsearch",
  "cluster_uuid" : "THJEbV7DRh2zoXVicqqM4w",
  "version" : {
    "number" : "7.9.1",
    "build_flavor" : "default",
    "build_type" : "deb",
    "build_hash" : "083627f112ba94dffc1232e8b42b73492789ef91",
    "build_date" : "2020-09-01T21:22:21.964974Z",
    "build_snapshot" : false,
    "lucene_version" : "8.6.2",
    "minimum_wire_compatibility_version" : "6.8.0",
    "minimum_index_compatibility_version" : "6.0.0-beta1"
  },
  "tagline" : "You Know, for Search"
}
```

### Cài đặt IDE Phpstorm
Muốn cài phpstorm chúng ta cần cài đặt `Ubuntu Make`
```
sudo apt install ubuntu-make -y 
```

Kiểm tra đã được cài đặt chưa 
```
umake --version
``` 

Bắt đầu cài đặt phpstorm 
```
 umake ide phpstorm
```

Cấp quyền chạy ứng dụng cho phpstorm 
```
chmod +x ~/.local/share/applications/jetbrains-phpstorm.desktop
```
Sau đó cần khởi động lại máy để cập nhật cấu hình
```
 sudo reboot
```

Sau khi khởi đông lại, bạn có thể truy cập phpstorm thông qua application Menu of Ubuntu 20.04 LTS
![access phpstorm](https://linuxhint.com/wp-content/uploads/2020/04/12-11.png)

### Cài đặt Xdebug 
Cài đặt xdebug các bạn chạy câu lệnh sau:
```
sudo apt-get install php-xdebug
```

Sau khi đã cài đặt thành công xdebug các bạn thêm vào file /etc/php/7.x/mods-available/xdebug.ini như bên dưới.
Hiện tại phiên bản chúng ta là php7.4 

```
vi  /etc/php/7.4/mods-available/xdebug.ini
```

Cấu hình khuyên dùng như sau 
```
zend_extension=xdebug.so
xdebug.remote_enable=1
xdebug.remote_handler=dbgp
xdebug.remote_mode=req
xdebug.remote_host=localhost
xdebug.remote_port=9000
xdebug.var_display_max_depth = -1
xdebug.var_display_max_children = -1
xdebug.var_display_max_data = -1
xdebug.idekey = "PHPSTORM"
```

Chú ý: Option xdebug.remote_port là port sẽ lắng nghe, mặc định là 9000


### Cấu hình phpstorm sử dụng Xdebug
Mở phpstorm vừa cài đặt Chọn File -> Settings -> Languages & Frameworks -> PHP -> Debug. Trong mục Xdebug, điền đúng Xdebug port đã cấu hình ở file xdebug.ini và lưu lại.
![phpstorm xdebug](https://vi-magento.com/wp-content/uploads/2020/08/Screenshot-from-2020-08-17-21-59-38-1021x620.png)


#### Cài đặt xdebug helper extension trên browser
Tùy theo trình duyệt chrome hay firefox sẽ có extension khác nhau. 
Đối với trình duyệt chrome các bạn có thể download [tại đây](https://chrome.google.com/webstore/detail/xdebug-helper/eadndfjplgieldjbigjakmdgkmoaaaoc?hl=vi).
![xdebug chrome](https://vi-magento.com/wp-content/uploads/2020/08/Screenshot-from-2020-08-17-22-00-31.png) 

#### Add config debug 
Cần tạo config để IDE lắng nghe trình duyệt

![config debug](https://vi-magento.com/wp-content/uploads/2020/08/Screenshot-from-2020-08-17-22-01-21.png)

Khi cần config chú ý tới cấu hình Server
- Host: địa chỉ host (mặc định thường là localhost)
- Port: cổng run (mặc định thường là 80)lắng nghe
- Debugger: Xdebug

### Developer Toolbar for Magento2
Chi tiết về toolbar [tại đây](https://github.com/vpietri/magento2-developer-quickdevbar)
 
#### Cài đặt với `composer`
Tại thư mục root của source magento 
```
composer require vpietri/adm-quickdevbar
php bin/magento module:enable ADM_QuickDevBar 
php bin/magento setup:upgrade
```

#### Cấu hình debug mysql query 

Thêm cấu hình `'profiler' => 1` vào file env.php
```
vi app/etc/env.php 
```
Kết quả tương tự như sau: 
```
'db' => [
        'table_prefix' => '',
        'connection' => [
            'default' => [
                'host' => 'localhost',
                'dbname' => 'magento',
                'username' => 'magentouser',
                'password' => 'new_password_here',
                'model' => 'mysql4',
                'engine' => 'innodb',
                'initStatements' => 'SET NAMES utf8;',
                'active' => '1',
                'driver_options' => [
                    1014 => false
                ],
                'profiler' => 1
            ]
        ]
```

Nếu thành công góc phía trên bên phải màn hình sẽ xuất hiện icon debug. 
Thử xem tab Queries thu được kết quả tương tự:
![queries](https://github.com/vpietri/magento2-developer-quickdevbar/raw/master/doc/images/qdb_screen_queries.png)
