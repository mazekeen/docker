FROM php:7.2-fpm-alpine

RUN apk add --update --no-cache \
    nodejs \
    npm \
    make \
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

RUN npm install -g yarn
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY . .

WORKDIR /var/www/tiger

CMD make start
