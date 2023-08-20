FROM php:8.2-fpm-bullseye

WORKDIR /workspace

ENV TZ=UTC \
    LANG=en_US.UTF-8 \
    LANGUAGE=en_US:en \
    LC_ALL=en_US.UTF-8 \
    COMPOSER_ALLOW_SUPERUSER=1 \
    COMPOSER_HOME=/composer

COPY --from=composer:2.5 /usr/bin/composer /usr/bin/composer

RUN apt-get update \
    && apt-get -y install --no-install-recommends \
    locales \
    git \
    unzip \
    libzip-dev \
    libicu-dev \
    libonig-dev \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* \
    && locale-gen en_US.UTF-8 \
    && localedef -f UTF-8 -i en_US en_US.UTF-8 \
    && docker-php-ext-install \
    intl \
    pdo_mysql \
    zip \
    bcmath \
    && composer config -g process-timeout 3600 \
    && composer config -g repos.packagist composer https://packagist.org

COPY ./infra/docker/php/php.ini /usr/local/etc/php/php.ini
