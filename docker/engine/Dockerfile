FROM php:7.0-fpm

RUN usermod -u 1000 www-data
RUN usermod -G staff www-data

RUN docker-php-ext-install pdo pdo_mysql

ENV PATH "/docker/vendor/bin:$PATH"

WORKDIR /docker
