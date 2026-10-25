FROM php:8.2-apache

# 1. Install kebutuhan sistem & PHP untuk Laravel
RUN apt-get update && apt-get install -y \
    libpng-dev libonig-dev libxml2-dev zip unzip git curl

RUN docker-php-ext-install pdo_mysql mbstring bcmath gd

# 2. Aktifkan mod_rewrite Apache (supaya route Laravel jalan)
RUN a2enmod rewrite

# 3. Arahkan server ke folder /public milik Laravel
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/conf-available/*.conf

WORKDIR /var/www/html
COPY . .

# 4. Install dependensi Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# 5. Beri izin akses folder storage & cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 80
