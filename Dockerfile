# Use a PHP FPM image with Alpine-based configuration
FROM php:8.2-fpm-alpine

# Install dependencies
RUN apk --no-cache add \
    libpng-dev \
    libjpeg-turbo-dev \
    libwebp-dev \
    libxpm-dev \
    libxml2-dev \
    libzip-dev \
    freetype-dev \
    zlib-dev \
    libssh-dev \
    supervisor \
    nodejs \
    npm \
    && apk add --no-cache --virtual .build-deps \
    gcc \
    g++ \
    make \
    autoconf \
    libc-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp --with-xpm \
    && docker-php-ext-install gd pdo pdo_mysql zip pcntl \
    && docker-php-ext-enable pcntl \
    && pecl install redis \
    && docker-php-ext-enable redis \
    && rm -rf /var/cache/apk/* /tmp/* \
    && npm install -g npm@latest \
    && apk del .build-deps

# Set working directory
WORKDIR /var/www/html

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

EXPOSE 9000

CMD ["php-fpm"]