FROM php:8.2-fpm

COPY wait-for-it.sh /usr/bin/wait-for-it

RUN chmod +x /usr/bin/wait-for-it

RUN apt-get update && \
    apt-get install -y --no-install-recommends libssl-dev zlib1g-dev curl git unzip libxml2-dev libzip-dev libpq-dev && \
    pecl install apcu xdebug && \
    docker-php-ext-install -j$(nproc) zip opcache intl && \
    docker-php-ext-enable apcu sodium xdebug && \
    apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

RUN docker-php-ext-install pdo pdo_mysql

COPY --from=composer /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

CMD composer i -o ; wait-for-it db:3306 -- php bin/console doctrine:migrations:migrate -n;  php-fpm

EXPOSE 9000 9003