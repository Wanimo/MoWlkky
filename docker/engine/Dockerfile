FROM php:7.0-fpm

RUN usermod -u 1000 www-data
RUN usermod -G staff www-data

ENV PATH "/docker/vendor/bin:$PATH"

WORKDIR /docker
