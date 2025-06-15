FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
 && docker-php-ext-install zip mysqli \
 && docker-php-ext-enable zip mysqli
