# --------------------------------------------------------------------------
# PHP-FPM Image for Laravel (optimized)
# Based on cyberduck/php-fpm-laravel but heavily improved
# --------------------------------------------------------------------------
FROM php:8.4-alpine

# Variables de entorno (opcional)
ENV COMPOSER_MEMORY_LIMIT='-1'
COPY --from=composer:2.8 /usr/bin/composer /usr/local/bin/composer

# Copiar configuración personalizada de PHP (antes de los RUN para cachear)
COPY ./docker/php-fpm/laravel.ini /usr/local/etc/php/conf.d/

# --- Capa única: instalación de paquetes, extensiones y limpieza ---
SHELL ["/bin/ash", "-eo", "pipefail", "-c"]
RUN set -eux; \
    # Paquetes permanentes del sistema
    apk add --no-cache \
        dcron~=4 \
        freetype-dev~=2 \
        gmp-dev~=6 \
        imagemagick-dev~=7 \
        jpeg-dev~=9f \
        libmemcached-dev~=1 \
        libpng-dev~=1 \
        libxml2-dev~=2 \
        libzip-dev~=1 \
        mariadb-client~=11 \
        openssl-dev~=3 \
        postgresql18-dev \
        readline-dev~=8 \
        shadow~=4 \
        unzip~=6 \
        zlib-dev~=1; \
    \
    # Dependencias de compilación (temporales)
    apk add --no-cache --virtual .build-deps \
        $PHPIZE_DEPS \
        linux-headers~=7; \

    \
    # Configurar GD antes de compilar
    docker-php-ext-configure gd --with-freetype --with-jpeg; \
    \
    # Extensiones nativas (compilación paralela)
    docker-php-ext-install -j"$(nproc)" \
        soap exif pcntl zip pdo_mysql pdo_pgsql bcmath intl gmp gd; \
    \
    # Extensiones PECL (instalación y habilitación inmediata)
    pecl install imagick memcached redis; \
    docker-php-ext-enable imagick memcached redis; \
    \
    # Eliminar dependencias de compilación y limpiar cachés
    apk del .build-deps; \
    rm -rf /var/cache/apk/* /tmp/* /var/tmp/*

# --- Copiar solo archivos de Composer para aprovechar caché ---
WORKDIR /var/www/html
COPY composer.json composer.lock ./

# --- Instalar dependencias de Composer (capa cacheable) ---
RUN composer install \
    --no-dev \
    --prefer-dist \
    --no-interaction \
    --no-scripts \
    --no-autoloader

# --- Copiar el resto del código de la aplicación ---
COPY . .

RUN composer dump-autoload \
    --optimize \
    --classmap-authoritative \
    --no-dev \
 && php artisan package:discover --ansi

# --- Capa final: permisos, aliases, cron, dump-autoload ---
RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R ug+rwx storage bootstrap/cache
RUN set -eux; \
    # Aliases útiles (art, migrate, fresh, t, d, dep)
    printf '#!/bin/bash\n/usr/local/bin/php /var/www/html/artisan "$@"' > /usr/bin/art && chmod +x /usr/bin/art; \
    printf '#!/bin/bash\n/usr/local/bin/php /var/www/html/artisan migrate "$@"' > /usr/bin/migrate && chmod +x /usr/bin/migrate; \
    printf '#!/bin/bash\n/usr/local/bin/php /var/www/html/artisan migrate:fresh --seed' > /usr/bin/fresh && chmod +x /usr/bin/fresh; \
    printf '#!/bin/bash\n/usr/local/bin/php /var/www/html/vendor/bin/dep "$@"' > /usr/bin/dep && chmod +x /usr/bin/dep; \
    printf '#!/bin/bash\n/usr/local/bin/php /var/www/html/artisan config:clear && /var/www/html/vendor/bin/phpunit -d memory_limit=2G --stop-on-error --stop-on-failure --testdox-text=tests/report.txt "$@"' > /usr/bin/t && chmod +x /usr/bin/t; \
    printf '#!/bin/bash\n/usr/local/bin/php /var/www/html/artisan config:clear && /var/www/html/vendor/bin/phpunit -d memory_limit=2G --stop-on-error --stop-on-failure --testdox-text=tests/report-dusk.txt "$@"' > /usr/bin/d && chmod +x /usr/bin/d; \
    # Añadir el cron job de Laravel (se ejecuta como www-data)
    printf '* * * * * www-data /usr/local/bin/php /var/www/html/artisan schedule:run >> /dev/null 2>&1' >> /etc/cron.d/laravel-scheduler; \
    chmod 0644 /etc/cron.d/laravel-scheduler

# Copiar script de entrada y establecer permisos
COPY ./docker/php-fpm/docker-entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-entrypoint.sh && ln -s /usr/local/bin/docker-entrypoint.sh /
RUN addgroup -g 1000 laravel \
 && adduser -D -u 1000 -G laravel laravel
 RUN mkdir -p \
    storage \
    storage/framework/cache \
    storage/framework/sessions \
    storage/framework/views \
    storage/logs \
    bootstrap/cache \
 && chown -R laravel:laravel storage bootstrap/cache \
 && chmod -R ug+rwx storage bootstrap/cache

# Punto de entrada y comando
ENTRYPOINT ["/usr/local/bin/docker-entrypoint.sh"]
EXPOSE 9000
CMD ["php-fpm"]

HEALTHCHECK --interval=30s \
            --timeout=5s \
            --start-period=20s \
            --retries=3 \
CMD php-fpm -t || exit 1
USER laravel