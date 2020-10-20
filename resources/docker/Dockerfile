FROM php:7.4-apache
MAINTAINER Tim de Wit

COPY ./resources/docker/apache.conf /etc/apache2/sites-enabled/000-default.conf
RUN a2enmod rewrite

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && ln -s $(composer config --global home) /root/composer

WORKDIR /app
