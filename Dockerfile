FROM php:8.1.1-fpm

RUN apt-get update && apt-get install git -y

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/
