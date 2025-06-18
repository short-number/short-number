FROM php:8.1-cli

RUN apt-get update && apt-get install -y \
    unzip \
    git \
    && rm -rf /var/lib/apt/lists/*

# Installing Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

# Copy composer files first for better cache usage
COPY composer.json composer.lock* ./

RUN composer install --no-interaction --prefer-dist --no-progress && \
    composer clear-cache

COPY . .

ENTRYPOINT [ "bash" ]