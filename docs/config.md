# Config 

## Mysql
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
![mysql](https://camo.githubusercontent.com/03db202746022bacf5f450a76875f05f773dcb74/68747470733a2f2f77656273697465666f7273747564656e74732e636f6d2f77702d636f6e74656e742f75706c6f6164732f323031382f30312f786d6172696164625f7562756e74755f313630342e706e672e7061676573706565642e69632e414137563372647757642e77656270)

## Tạo Magento Database
Logon vào MariaDB database:
```
sudo mysql -u root -p
```

Tạo database, tôi đặt tên nó là magento
```
CREATE DATABASE magento;
```

Tiếp theo, tạo một user mới và đặt mật khẩu. Tôi đặt là magentouser, mật khẩu là new_password_here
```
CREATE USER 'magentouser'@'localhost' IDENTIFIED BY 'new_password_here';
```

Cấp quyền truy cập cho
```
GRANT ALL ON magento.* TO 'magentouser'@'localhost' WITH GRANT OPTION;
```

Cuối cùng chúng ta thay đổi và thoát

FLUSH PRIVILEGES;
EXIT;
## PHP
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

## Download Magento
Để cài chúng ta cần lấy authentication keys. Public key là username; private key là password. Truy cập ( https://marketplace.magento.com/customer/accessKeys/ ). Để lấy thông tin như sau authentication keys

Bây giờ đã đủ kiều kiện, chạy commands để download magento
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

## Configure Nginx
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
Sau cần link thư mục cấu hình và restart lại nginx
```
sudo ln -s /etc/nginx/sites-available/magento /etc/nginx/sites-enabled/
sudo systemctl restart nginx.service
```

Truy cập vào đường dẫn
```
https://example.com
```

## Config Xdebug
Sau khi đã cài đặt thành công xdebug các bạn thêm vào file /etc/php/7.x/mods-available/xdebug.ini như bên dưới. Hiện tại phiên bản chúng ta là php7.4
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

Cấu hình phpstorm sử dụng Xdebug
Mở phpstorm vừa cài đặt Chọn File -> Settings -> Languages & Frameworks -> PHP -> Debug. Trong mục Xdebug, điền đúng Xdebug port đã cấu hình ở file xdebug.ini và lưu lại.
![xdebug](https://camo.githubusercontent.com/3b6d43b564efcb16ab27f8e4f7f3471f3815b02a/68747470733a2f2f76692d6d6167656e746f2e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032302f30382f53637265656e73686f742d66726f6d2d323032302d30382d31372d32312d35392d33382d31303231783632302e706e67)

#### Cài đặt xdebug helper extension trên browser
Tùy theo trình duyệt chrome hay firefox sẽ có extension khác nhau. Đối với trình duyệt chrome các bạn có thể download tại đây.
![xdebug helper](https://camo.githubusercontent.com/6c5225b90d4ac578b7875af31eb13191239c6760/68747470733a2f2f76692d6d6167656e746f2e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032302f30382f53637265656e73686f742d66726f6d2d323032302d30382d31372d32322d30302d33312e706e67)

#### Add config debug
Cần tạo config để IDE lắng nghe trình duyệt config debug
![config phpstorm xdebug](https://camo.githubusercontent.com/a06ac9877e3392d709a9add4489a9b7597017e4f/68747470733a2f2f76692d6d6167656e746f2e636f6d2f77702d636f6e74656e742f75706c6f6164732f323032302f30382f53637265656e73686f742d66726f6d2d323032302d30382d31372d32322d30312d32312e706e67)

Khi cần config chú ý tới cấu hình Server

Host: địa chỉ host 80 (mặc định thường là localhost)
Port: cổng run (mặc định thường là )lắng nghe
Debugger: Xdebug

## Developer Toolbar for Magento2
Chi tiết về toolbar [tại đây](https://github.com/vpietri/magento2-developer-quickdevbar)

Cài đặt với composer
Tại thư mục root của source magento
```
composer require vpietri/adm-quickdevbar
php bin/magento module:enable ADM_QuickDevBar 
php bin/magento setup:upgrade
```

Cấu hình debug mysql query
Thêm cấu hình 'profiler' => 1 vào file env.php
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

Nếu thành công góc phía trên bên phải màn hình sẽ xuất hiện icon debug. Thử xem tab Queries thu duoc ket qua tuong tu: queries
![queries](https://github.com/vpietri/magento2-developer-quickdevbar/raw/master/doc/images/qdb_screen_queries.png)
