FROM php:latest

RUN apt update
RUN apt install unzip curl -y

RUN curl -sS https://getcomposer.org/installer -o /usr/local/composer-setup.php

RUN php /usr/local/composer-setup.php --install-dir=/usr/local/bin --filename=composer

RUN rm /usr/local/composer-setup.php
