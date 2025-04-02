FROM php:8.2-apache

RUN apt-get update && apt-get install -y libpq-dev

RUN docker-php-ext-install pdo pdo_mysql pdo_pgsql

RUN a2enmod rewrite

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|' /etc/apache2/sites-available/000-default.conf \
    && sed -i 's|<Directory /var/www/html>|<Directory /var/www/html/public>|' /etc/apache2/sites-available/000-default.conf \
    && sed -i 's|AllowOverride None|AllowOverride All|' /etc/apache2/apache2.conf
    
WORKDIR /var/www/html

COPY ProjetX_CREPON_ROB_STAPLETON_TROUBA/ /var/www/html

RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

EXPOSE 80

CMD ["sh", "-c", "sleep 0.5 && cd /var/www/html/ && php artisan migrate --force && apache2-foreground"]
