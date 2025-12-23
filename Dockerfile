# Dockerfile untuk Laravel App
FROM php:8.2-fpm

# Set working directory
WORKDIR /var/www

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev \
    default-mysql-client \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install Node.js (untuk build assets)
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

# Create non-root user
RUN useradd -m -s /bin/bash -u 1000 appuser
RUN chown -R appuser:appuser /var/www

# Copy existing application directory contents
COPY --chown=appuser:appuser . /var/www

# Switch to non-root user
USER appuser

# Expose port
EXPOSE 9000

CMD ["php-fpm"]