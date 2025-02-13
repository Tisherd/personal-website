FROM php:8.4-cli

RUN apt-get update && apt-get install -y \
    supervisor \
    libpq-dev \
    zip unzip \
    git \
    && docker-php-ext-install pdo pdo_pgsql bcmath pcntl opcache

# Check and install Redis extension only if not already installed
RUN if ! php -m | grep -q redis; then \
        PHP_PEAR_PHP_BIN=php pecl install redis && docker-php-ext-enable redis; \
    fi

WORKDIR /var/www

COPY ./docker/supervisor/conf/supervisord.conf /etc/supervisor/supervisord.conf
COPY ./docker/supervisor/conf/laravel-scheduler.conf /etc/supervisor/conf.d/laravel-scheduler.conf

COPY . .

ARG USER=laravel_user_supervisor
ARG UID=1000

RUN useradd -ms /bin/bash -u ${UID} ${USER}

RUN chown -R ${USER}:${UID} storage bootstrap/cache

USER ${USER}

CMD ["supervisord", "-c", "/etc/supervisor/supervisord.conf"]
