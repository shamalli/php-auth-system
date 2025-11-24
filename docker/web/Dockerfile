FROM php:apache
RUN docker-php-ext-install mysqli pdo pdo_mysql
WORKDIR /var/www/html
COPY . /var/www/html/
RUN a2enmod rewrite
RUN a2enmod ssl