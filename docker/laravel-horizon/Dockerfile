# --------------------------------------------------------------------------
# Image Setup for Laravel-Horizon
# --------------------------------------------------------------------------

FROM php:8.5-alpine

# Argumentos para el usuario no root
ARG PUID=1000
ENV PUID=${PUID}
ARG PGID=1000
ENV PGID=${PGID}

# Argumentos para extensiones opcionales
ARG INSTALL_BZ2=false
ARG INSTALL_GNUPG=true

# Copiar configuración de supervisord antes de los RUN (para aprovechar caché)
COPY supervisord.conf /etc/supervisord.conf

# --- Capa única de instalación y limpieza ---
RUN set -eux; \
    # Paquetes de sistema (permanentes)
    apk add --no-cache \
        curl=~8 \
        git=~2 \
        gmp-dev~=6 \
        libgsasl-dev~=2 \
        libmcrypt-dev~=2 \
        libmemcached-dev~=1 \
        libpng-dev~=1 \
        libxml2-dev~=2 \
        libzip-dev~=1 \
        oniguruma-dev~=6 \
        postgresql18-dev \
        procps=~4 \
        supervisor=~4 \
        wget=~1 \
        zlib-dev~=1 \
        freetype-dev \
        imagemagick-dev \
        jpeg-dev \
        libjpeg-turbo-dev; \
    \
    # Dependencias de compilación (temporales)
    apk add --no-cache --virtual .build-deps \
        autoconf~=2 \
        build-base~=0 \
        cyrus-sasl-dev~=2 \
        linux-headers~=7; \
    \
    # Extensiones PECL (redis, imagick, gnupg condicional)
    pecl install redis imagick; \
    docker-php-ext-enable redis imagick; \
    if [ "${INSTALL_GNUPG}" = "true" ]; then \
        apk add --no-cache gpgme gpgme-dev; \
        pecl install gnupg; \
        docker-php-ext-enable gnupg; \
    fi; \
    \
    # Extensiones PHP nativas (compilación paralela)
    docker-php-ext-install -j$(nproc) \
        gmp soap exif pcntl zip pdo_mysql pdo_pgsql bcmath intl sockets gd; \
    \
    # Configuración de GD
    docker-php-ext-configure gd --with-freetype --with-jpeg; \
    \
    # BZ2 condicional
    if [ "${INSTALL_BZ2}" = "true" ]; then \
        apk add --no-cache bzip2-dev; \
        docker-php-ext-install bz2; \
    fi; \
    \
    # Limpieza: eliminar dependencias de compilación y cachés
    apk del .build-deps; \
    rm -rf /var/cache/apk/* /tmp/* /var/tmp/*

# Crear usuario no root
RUN addgroup -g ${PGID} sail && \
    adduser -D -G sail -u ${PUID} sail

# Directorio de trabajo (por defecto para supervisord)
WORKDIR /etc/supervisor/conf.d/

# Punto de entrada
ENTRYPOINT ["/usr/bin/supervisord", "-n", "-c", "/etc/supervisord.conf"]