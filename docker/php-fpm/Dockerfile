FROM php:7.4-fpm-alpine


RUN apk add --no-cache tzdata
ENV TZ Europe/Berlin

RUN docker-php-ext-install mysqli

RUN chmod -R 777 /var/www/src/static

CMD ["php-fpm"]

EXPOSE 9000