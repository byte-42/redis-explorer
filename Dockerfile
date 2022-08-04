FROM php:7.3-cli

RUN apt-get update -y && apt-get install -y libmcrypt-dev zip unzip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN docker-php-ext-install pdo mbstring

WORKDIR /app
COPY . /app

# remove copied vendor files and run a clean install
RUN rm -rf vendor
RUN composer install

ENV APP_ENV docker

EXPOSE 8000
CMD php -S 0.0.0.0:8000 -t public