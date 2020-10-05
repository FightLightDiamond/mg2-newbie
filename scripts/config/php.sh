#!/bin/bash

timezone="Asia/Ho_Chi_Minh"

echo "Config php.ini"

echo "
file_uploads = On
allow_url_fopen = On
short_open_tag = On
memory_limit = -1
cgi.fix_pathinfo = 0
upload_max_filesize = 100M
max_execution_time = 360
date.timezone = $timezone
"

sudo vi /etc/php/7.4/fpm/php.ini
