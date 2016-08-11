FROM php:7.0-fpm

RUN apt-get update && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN usermod -u 1000 www-data
RUN usermod -G staff www-data

WORKDIR /app
