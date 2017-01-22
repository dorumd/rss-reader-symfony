FROM php:7.0.2-fpm

RUN \
  apt-get update && \
  apt-get install -y \
  curl \
  wget \
  git

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY php.ini        /usr/local/etc/php/conf.d/
COPY default.conf    /usr/local/etc/php-fpm.d/www.conf

EXPOSE 9000
