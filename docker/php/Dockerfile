FROM php:8.1-fpm-alpine as php-service

ARG APP_ENV=dev
ENV APP_ENV=$APP_ENV

COPY ./docker/scripts/ /usr/local/bin/

RUN apk add --no-cache linux-headers

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy the php config file
COPY ./docker/php/php-fpm.conf /usr/local/etc/php-fpm.d/www.conf

# Copy the application code
COPY ./app /app

RUN mkdir /app/var && chown -R www-data:www-data /app/var
RUN cd /app && composer install --prefer-dist --no-progress --no-interaction --no-scripts --no-dev
RUN chown -R www-data:www-data /app

WORKDIR /app

EXPOSE 9000