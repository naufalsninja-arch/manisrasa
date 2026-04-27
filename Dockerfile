# 1. Gunakan image PHP 8.3 dengan Apache
FROM php:8.3-apache

# 2. Install extension yang dibutuhkan Laravel & TiDB
RUN apt-get update && apt-get install -y \
    libpng-dev libonig-dev libxml2-dev zip unzip libpq-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# 3. Arahkan Apache ke folder /public agar Laravel bisa terbuka
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# 4. Aktifkan mod_rewrite Apache untuk routing Laravel
RUN a2enmod rewrite

# 5. Set folder kerja dan copy file project
WORKDIR /var/www/html
COPY . .

# 6. Install Composer dan library Laravel
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# 7. Berikan izin akses folder storage dan cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# 8. Buka port 80
EXPOSE 80

# 9. JALANKAN MIGRASI OTOMATIS & NYALAKAN SERVER
# Ini akan membuat tabel di TiDB setiap kali aplikasi dijalankan
CMD php artisan migrate --force && apache2-foreground
