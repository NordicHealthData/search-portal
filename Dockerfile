FROM tutum/apache-php
RUN apt-get update && apt-get install -yq git && rm -rf /var/lib/apt/lists/*
RUN rm -fr /app
ADD . /app
RUN rm -fr /var/www/html && ln -s /app/public /var/www/html && mv /app/virtualhost.example /etc/apache2/sites-enabled/000-default.conf && a2enmod rewrite
RUN composer install