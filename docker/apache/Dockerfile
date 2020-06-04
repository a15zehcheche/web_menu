FROM mattrayner/lamp:latest-1804


RUN apt-get update; \
    apt-get upgrade -y; \
    apt-get install -y php-xdebug; \
    apt-get install -y nano; \
    #cp /usr/share/zoneinfo/Europe/Madrid /etc/localtime
    cp /usr/share/zoneinfo/Europe/Berlin /etc/localtime

COPY xdebug.ini /etc/php/7.2/mods-available/xdebug.ini

EXPOSE 80
EXPOSE 3306

ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
#RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

#RUN service mysql start; bash /create_mysql_users.sh
#https://dev.to/brpaz/docker-phpstorm-and-xdebug-the-definitive-guide-14og
