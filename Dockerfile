# Gunakan image PHP dengan Apache
FROM php:8.2-apache

# Aktifkan mod_rewrite untuk mendukung routing dinamis (.htaccess)
RUN a2enmod rewrite

# Salin semua file project ke direktori web default Apache
COPY . /var/www/html/

# Set working directory
WORKDIR /var/www/html

# Atur izin agar Apache bisa membaca semua file
RUN chown -R www-data:www-data /var/www/html

# Pastikan port 80 terbuka untuk web server
EXPOSE 80

# Jalankan Apache
CMD ["apache2-foreground"]
