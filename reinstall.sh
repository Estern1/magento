#!/usr/bin/env bash

cd /var/www/magento23ee.local

echo "Cleanup environment"
rm -rf generated/metadata/*
rm -rf generated/code/*
rm -rf var/page_cache/*
rm -rf var/cache/*
rm -rf var/view_preprocessed/*

chown -R magento:www-data .

chmod -f g+s /var/www/magento23ee.local
chmod -fR g+s /var/www/magento23ee.local/pub
chmod -fR g+s /var/www/magento23ee.local/generated
chmod -fR g+s /var/www/magento23ee.local/var

echo "Flush Redis cache"
redis-cli flushall

echo "Composer install"
composer install

echo "Remove env.php"
if [[ -f "app/etc/config.php" ]]; then
    rm app/etc/env.php
else
    echo "Skipped"
fi

echo "Backup config.php"
if [[ -f "app/etc/config.php" ]]; then
    mv app/etc/config.php app/etc/config.php.bak
else
    echo "Skipped"
fi

echo "Drop and create database"
mysql -h localhost -u magento23ee -pmagento -e "DROP DATABASE IF EXISTS magento23ee; CREATE DATABASE magento23ee CHARACTER SET utf8 COLLATE utf8_unicode_ci;"

echo "Reinstall"
/usr/bin/php bin/magento setup:install \
     --admin-firstname=John \
     --admin-lastname=Doe \
     --admin-email=john.doe@gmail.com \
     --admin-user=admin \
     --admin-password=Admin12 \
     --base-url=http://magento23ee.local \
     --base-url-secure=https://magento23ee.local \
     --backend-frontname=admin \
     --db-host=localhost \
     --db-name=magento23ee \
     --db-user=magento23ee \
     --db-password=magento \
     --language="en_US" \
     --currency="USD" \
     --timezone="America/Chicago" \
     --use-rewrites=1 \
     --use-secure=1 \
     --use-secure-admin=1 \
     --admin-use-security-key=0 \
     --session-save=redis \
     --session-save-redis-host="127.0.0.1" \
     --session-save-redis-port="6379" \
     --session-save-redis-password="" \
     --session-save-redis-timeout="10" \
     --session-save-redis-persistent-id="sess-db02" \
     --session-save-redis-db="2" \
     --session-save-redis-compression-threshold="2048" \
     --session-save-redis-compression-lib="gzip" \
     --session-save-redis-log-level="4" \
     --session-save-redis-max-concurrency="10" \
     --session-save-redis-break-after-frontend="5" \
     --session-save-redis-break-after-adminhtml="30" \
     --session-save-redis-first-lifetime="600" \
     --session-save-redis-bot-first-lifetime="60" \
     --session-save-redis-bot-lifetime="7200" \
     --session-save-redis-disable-locking="1" \
     --session-save-redis-min-lifetime="1200" \
     --session-save-redis-max-lifetime="2592000" \
     --session-save-redis-sentinel-master="" \
     --session-save-redis-sentinel-servers="" \
     --session-save-redis-sentinel-verify-master="0" \
     --session-save-redis-sentinel-connect-retires="5" \
     --cache-backend="redis" \
     --cache-backend-redis-server="127.0.0.1" \
     --cache-backend-redis-db="0" \
     --cache-backend-redis-port="6379" \
     --page-cache="redis" \
     --page-cache-redis-server="127.0.0.1" \
     --page-cache-redis-db="1" \
     --page-cache-redis-port="6379" \
     --page-cache-redis-compress-data="1" \
          --amqp-host="127.0.0.1" \
     --amqp-port="5672" \
     --amqp-user="admin" \
     --amqp-password="admin" \
     --amqp-virtualhost="/" \
          --cleanup-database \
     -vv \
    || exit 1

echo "Set mode"
/usr/bin/php /var/www/magento23ee.local/bin/magento deploy:mode:set developer

if [[ -f "app/etc/config.php.bak" ]]; then
    echo "Restore confing.php"
        mv /var/www/magento23ee.local/app/etc/config.php.bak /var/www/magento23ee.local/app/etc/config.php

    chmod -fR g+s /var/www/magento23ee.local/pub
    chmod -fR g+s /var/www/magento23ee.local/generated
    chmod -fR g+s /var/www/magento23ee.local/var

    echo "Upgrade the code"
    /usr/bin/php /var/www/magento23ee.local/bin/magento app:config:import -n
    /usr/bin/php /var/www/magento23ee.local/bin/magento setup:upgrade --keep-generated
    /usr/bin/php /var/www/magento23ee.local/bin/magento cache:flush
else
    echo "Set initial configuration"
    sh ./setup_config.sh
fi


echo "Set permissions and ownership"
find /var/www/magento23ee.local -type d -exec chmod 775 {} \;
find /var/www/magento23ee.local -type f -exec chmod 664 {} \;
find /var/www/magento23ee.local/var -type d -exec chmod 777 {} \;
find /var/www/magento23ee.local/pub/media -type d -exec chmod 777 {} \;
find /var/www/magento23ee.local/pub/static -type d -exec chmod 777 {} \;
chmod 777 /var/www/magento23ee.local/app/etc
chmod 664 /var/www/magento23ee.local/app/etc/*.xml
# chcon -R -t httpd_sys_content_t .

chmod g+x /var/www/magento23ee.local/vendor/friendsofphp/php-cs-fixer/php-cs-fixer
chmod g+x /var/www/magento23ee.local/vendor/squizlabs/php_codesniffer/bin/phpcs
chmod g+x /var/www/magento23ee.local/vendor/phpmd/phpmd/src/bin/phpmd
chmod g+x /var/www/magento23ee.local/vendor/phpunit/phpunit/phpunit

chmod u+x,g+x /var/www/magento23ee.local/bin/magento
chmod u+x,g+x /var/www/magento23ee.local/fixpermissions.sh /var/www/magento23ee.local/reinstall.sh

chown -R magento:www-data /var/www/magento23ee.local

echo "Cache warmer"