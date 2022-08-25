FROM node:12.14.0-alpine as node
FROM php:7.4-fpm-alpine

# install packages
RUN apk add -U --no-cache \
    bash \
    git \
    curl-dev \
    libxml2-dev \
    postgresql-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    zip \
    libzip-dev \
    unzip \
    gmp-dev \
    autoconf \
    make \
    gcc \
    g++ \
    freetype-dev \
    oniguruma-dev

# install PHP extensions
RUN docker-php-source extract
RUN cp /usr/src/php/ext/openssl/config0.m4 /usr/src/php/ext/openssl/config.m4
RUN docker-php-ext-configure gd --with-freetype=/usr/include --with-jpeg=/usr/include
RUN docker-php-ext-install pdo\
    pdo_mysql \
    mysqli \
    pdo_pgsql \
    pgsql \
    mbstring \
    curl \
    ctype \
    xml \
    json \
    tokenizer \
    openssl \
    gd \
    zip \
    gmp \
    bcmath \ 
    exif 

RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

#RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"
RUN mv "/usr/local/etc/php/php.ini-development" "$PHP_INI_DIR/php.ini"
COPY ./00-settings.ini "$PHP_INI_DIR/conf.d/00-settings.ini"

# ---------------------------------------

RUN mkdir -p /var/www/html
RUN chown -R www-data.www-data /var/www/html
WORKDIR /var/www/html

# マルチステージビルドでphp-fpmコンテナにnodeとnpmを追加する
RUN apk add --no-cache --virtual g++
RUN apk add --no-cache libstdc++ && apk add --no-cache libgcc

COPY --from=node /usr/local/bin/node /usr/local/bin/
COPY --from=node /usr/local/lib/node_modules/ /usr/local/lib/node_modules/
RUN ln -s /usr/local/bin/node /usr/local/bin/nodejs \
    && ln -s /usr/local/lib/node_modules/npm/bin/npm-cli.js /usr/local/bin/npm \
    && ln -s /usr/local/lib/node_modules/npm/bin/npx-cli.js /usr/local/bin/npx
