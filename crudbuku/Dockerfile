# Gunakan image PHP resmi dengan Apache
FROM php:8.1-apache

# Copy file kode PHP ke dalam container
COPY . /var/www/html

# Install ekstensi PHP yang diperlukan
RUN docker-php-ext-install mysqli pdo pdo_mysql && \
    docker-php-ext-enable mysqli pdo_mysql

# Atur izin untuk folder kerja
RUN chown -R www-data:www-data /var/www/html && \
    chmod -R 755 /var/www/html

# Expose port 80
EXPOSE 80
