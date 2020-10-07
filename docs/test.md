

sudo -u www-data php bin/magento setup:install --admin-firstname=Fight --admin-lastname=Light --admin-email=i.am.m.cuong@gmail.com --admin-user=admin --admin-password='1234aA@' --base-url=http://mage.to.vn --base-url-secure=https://mage.to.vn --backend-frontname=admin --db-host=127.0.0.1 --db-name=magento --db-user=magentouser --db-password=new_password_here --use-rewrites=1 --language=en_US --currency=USD --timezone=Asia/Ho_Chi_Minh --use-secure-admin=0 --admin-use-security-key=0 --session-save=files --use-sample-data


sudo -u www-data php bin/magento setup:install --base-url-secure=https://mage.com/ --db-host=localhost --db-name=magento --db-user=magentouser --db-password=new_password_here --admin-firstname=Admin --admin-lastname=User --admin-email=i.am.m.cuong@gmail.com --admin-user=admin --admin-password=admin123 --language=en_US --currency=USD --timezone=Asia/Ho_Chi_Minh --use-rewrites=1
/admin_chu9dj

sudo certbot certonly --manual --preferred-challenges=dns --email i.am.m.cuong@gmail.com --server https://acme-v02.api.letsencrypt.org/directory --agree-tos -d mage.com -d *.mage.com

vi /var/log/letsencrypt/letsencrypt.log


openssl x509 -req -in test-ssl.local.csr -CA rootCA.pem -CAkey rootCA.key -CAcreateserial \
-out test-ssl.local.crt -days 1825 -sha256 -extfile test-ssl.local.ext
