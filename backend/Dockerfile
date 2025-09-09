# Usa PHP 8.2 con estensioni
FROM php:8.2-cli

# Installa dipendenze necessarie
RUN apt-get update && apt-get install -y \
    unzip \
    git \
    curl \
    libonig-dev \
    libzip-dev \
    zip \
    && docker-php-ext-install pdo pdo_mysql

# Installa Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Imposta la cartella di lavoro
WORKDIR /var/www

# Copia il progetto
COPY . .

# Installa le dipendenze Laravel
RUN composer install --no-interaction --optimize-autoloader

# Espone la porta
EXPOSE 8000

# Avvia Laravel con artisan serve
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
