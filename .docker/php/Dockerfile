#syntax=docker/dockerfile:1.4
FROM php:8.3.0-cli-alpine3.17 AS backend

WORKDIR /var/www/html

RUN set -eux && \
    apk update && \
    apk add --no-cache patch make bash && \
    apk del && \
    rm -rf /var/lib/apt/lists/* && \
    mkdir /root/history && \
    echo 'alias sf="php bin/console"' >> ~/.bashrc

ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
RUN chmod +x /usr/local/bin/install-php-extensions && \
    install-php-extensions @composer opcache pdo_pgsql pgsql intl pcntl pcov sockets amqp && \
    ln -s composer /usr/local/bin/c

RUN cp "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"
COPY --link .docker/php/php.ini $PHP_INI_DIR/conf.d/

COPY --from=spiralscout/roadrunner:2024.2 --chown=www-data:www-data /usr/bin/rr /usr/bin/rr
RUN chmod +x /usr/bin/rr

USER www-data
COPY --chown=www-data:www-data ./composer.json ./composer.lock ./symfony.lock /var/www/html/
ARG composer=nodev  # nodev/full
RUN if [[ "$composer" == "nodev" ]]; then composer install --no-dev --optimize-autoloader --no-scripts; \
	elif [[ "$composer" == "full" ]]; then composer install --optimize-autoloader --no-scripts; fi

COPY --chown=www-data:www-data . /var/www/html/

CMD php bin/console cache:clear && /usr/bin/rr serve -c .rr.yaml
