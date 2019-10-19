FROM php:7.2-fpm-alpine

# Workaround for issue https://github.com/phpearth/docker-php/issues/3
RUN apk add --no-cache --repository http://dl-3.alpinelinux.org/alpine/edge/community gnu-libiconv
ENV LD_PRELOAD /usr/lib/preloadable_libiconv.so php

RUN apk add --update --no-cache --virtual persistent-deps \
    make \
    git \
    icu-libs \
    zlib \
    && apk add --no-cache --virtual build-deps \
    $PHPIZE_DEPS \
    icu-dev \
    zlib-dev \
    && docker-php-ext-install \
    bcmath \
    intl \
    opcache \
    sockets \
    zip \
    && pecl install \
    apcu \
    xdebug \
    && docker-php-ext-enable \
    apcu \
    xdebug \
    && apk del --purge build-deps \
    && rm -rf /var/cache/apk/* \
    && rm -rf /tmp/*

# Install composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN mkdir /var/composer

ENV COMPOSER_HOME /var/composer
ENV COMPOSER_ALLOW_SUPERUSER 1
ENV COMPOSER_MEMORY_LIMIT -1

COPY php-fpm.d/pool.conf /usr/local/etc/php-fpm.d/www.conf

CMD ["php-fpm", "-F", "-R"]

EXPOSE 9000