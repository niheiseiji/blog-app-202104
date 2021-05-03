FROM php:8.0-fpm

#composerをインストール
COPY --from=composer:2.0 /usr/bin/composer /usr/bin/composer

#npmインストール
COPY --from=node:14.16.1 /usr/local/bin /usr/local/bin
COPY --from=node:14.16.1 /usr/local/lib /usr/local/lib

RUN apt-get update \
&& apt-get install -y \
git \
zip \
unzip \
vim \
&& docker-php-ext-install pdo_mysql bcmath

WORKDIR /var/www/