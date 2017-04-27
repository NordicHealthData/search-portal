FROM php:7.0-apache

RUN apt-get update &&\ 
    apt-get install -yq git &&\ 
    apt-get install -y zlib1g-dev &&\ 
    apt-get install -y libxslt-dev &&\ 
    rm -rf /var/lib/apt/lists/* &&\ 
    docker-php-ext-install zip &&\ 
    docker-php-ext-install xsl

RUN echo "short_open_tag = Off" > /usr/local/etc/php/conf.d/short_tags_off.ini

COPY . /var/www/html/

# Register the COMPOSER_HOME environment variable
ENV COMPOSER_HOME /composer

ENV PATH /composer/vendor/bin:$PATH
ENV COMPOSER_VERSION 1.1.2

RUN php -r "readfile('https://getcomposer.org/installer');" > /tmp/composer-setup.php &&\
    export PATH="$HOME/.composer/vendor/bin:$PATH" &&\
    php /tmp/composer-setup.php --no-ansi --install-dir=/usr/local/bin --filename=composer --version=${COMPOSER_VERSION} && rm -rf /tmp/composer-setup.php

RUN composer install