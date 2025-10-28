FROM php:8.3-fpm

# Instala dependências do sistema e extensões do PHP
RUN apt-get update && apt-get install -y \
    zip unzip git curl libpng-dev libonig-dev libxml2-dev libpq-dev \
    && docker-php-ext-install pdo_pgsql mbstring exif pcntl bcmath gd

# Instala o Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Define diretório de trabalho
WORKDIR /var/www/html

# Copia o código do projeto
COPY . .
RUN git config --global --add safe.directory /var/www/html
RUN composer install

# Permissões (importante para o storage e cache)
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
