FROM php:8.3-fpm-alpine

ARG user=acessorias
ARG uid=1000

  # Install system dependencies
RUN apk update && apk add --no-cache \
git \
curl \
libpng-dev \
libxml2-dev \
zip \
unzip \
libzip-dev \
bash \
supervisor \
netcat-openbsd \
autoconf \
g++ \
make \
oniguruma-dev \
linux-headers

  # Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd sockets

  # Install redis extension
RUN pecl install -o -f redis && \
rm -rf /tmp/pear && \
docker-php-ext-enable redis

  # Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

  # Create system user to run Composer and Artisan Commands
RUN adduser -D -u $uid -g 'www' $user && \
mkdir -p /home/$user/.composer && \
chown -R $user:$user /home/$user

  # Set working directory
WORKDIR /var/www

  # Copy application code
COPY api /var/www

  # Copy the environment configuration file
COPY ./api/.env.dev .env

# List files to confirm .env is copied
RUN ls -la /var/www

  # Set permissions for Laravel
RUN find /var/www -type d -exec chmod 0755 {} \; && \
find /var/www -type f -exec chmod 0644 {} \; && \
chmod -R 777 /var/www/storage /var/www/bootstrap/cache && \
chown -R www-data:www-data /var/www

  # Install Laravel dependencies including development dependencies
RUN composer install --prefer-dist --no-interaction --no-scripts

  # Generate Laravel key and cache configurations
RUN php artisan key:generate && \
php artisan config:cache && \
php artisan route:cache && \
php artisan view:cache && \
php artisan storage:link

  # Copy custom configurations PHP
COPY api/docker/php/custom.ini /usr/local/etc/php/conf.d/custom.ini

  # Entrypoint script
COPY api/docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

  # Set user
USER $user

  # Run entrypoint script
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]

  # Default command
CMD ["php-fpm"]
