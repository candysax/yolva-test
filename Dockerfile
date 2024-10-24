FROM php:8.3-fpm

RUN mkdir -p /var/www/
WORKDIR /var/www/

COPY . /var/www/
COPY --from=composer:2.7 /usr/bin/composer /usr/local/bin/composer

RUN apt-get update
RUN apt-get install libzip-dev libcurl3-dev -y
RUN docker-php-ext-configure zip \
  && docker-php-ext-install zip pdo pdo_mysql curl

ENV COMPOSER_ALLOW_SUPERUSER=1

RUN composer install
RUN composer dump-autoload
