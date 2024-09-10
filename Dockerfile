FROM php:8.1-apache
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    && docker-php-ext-install pdo pdo_mysql
WORKDIR /var/www/html
COPY . /var/www/html
RUN chown -R www-data:www-data /var/www/html
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer update
RUN composer dumpautoload
EXPOSE 80
CMD ["apache2-foreground"]