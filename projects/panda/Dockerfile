FROM php:7.2-fpm-alpine

RUN apk add --update --no-cache \
    freetype \
    libjpeg-turbo \
    libpng \
    rabbitmq-c \
    && apk add --no-cache --virtual build-deps \
    $PHPIZE_DEPS \
    libpng-dev \
    freetype-dev \
    libjpeg-turbo-dev \
    rabbitmq-c-dev \
    && docker-php-ext-configure \
    gd \
    --with-png-dir=/usr/include \
    --with-freetype-dir=/usr/include \
    --with-jpeg-dir=/usr/include \
    && docker-php-ext-install \
    gd \
    pdo_mysql \
    && pecl install \
    amqp \
    igbinary \
    mongodb \
    && docker-php-ext-enable \
    amqp \
    igbinary \
    mongodb \
    && apk del --purge build-deps \
    && rm -rf /var/cache/apk/* \
    && rm -rf /tmp/*

COPY . .

WORKDIR /var/www/monkey