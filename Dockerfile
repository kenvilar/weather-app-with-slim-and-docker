FROM php:apache

RUN docker-php-source extract && docker-php-ext-install mysqli && docker-php-source delete
