FROM php:7.1-fpm-alpine

RUN echo "version=1.0.0"

RUN apk update \
    && apk add libmcrypt-dev libzip-dev zip \
    && apk add --no-cache $PHPIZE_DEPS \
    && pecl install xdebug-2.5.0 \
    && docker-php-ext-enable xdebug \
    && docker-php-ext-configure zip \
    && docker-php-ext-install mcrypt mysqli pdo_mysql zip \
    && rm /var/cache/apk/*

RUN curl --silent --show-error https://getcomposer.org/installer | php
