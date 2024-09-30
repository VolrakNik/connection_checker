FROM php:8.2-cli-alpine

WORKDIR /app

COPY ./composer.json .
COPY ./docker/crontab /etc/crontabs/root

RUN apk update
RUN apk add --no-cache --virtual .build-deps composer
RUN composer install --no-ansi --no-interaction

CMD ["/bin/sh", "/app/docker/php-entrypoint.sh"]