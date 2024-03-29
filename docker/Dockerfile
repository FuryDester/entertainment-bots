FROM php:8.3-fpm AS base_app

# Copy composer.lock and composer.json
COPY composer.lock composer.json /var/www/

# Set working directory
WORKDIR /var/www

# Install dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libzip-dev \
    libpng-dev \
    libpq-dev \
    libcurl4-openssl-dev \
    libxml2-dev \
    libcap2-bin \
    libonig-dev \
    libjpeg62-turbo-dev \
    libwebp-dev libjpeg62-turbo-dev libpng-dev libxpm-dev \
    libfreetype6 \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    libonig-dev \
    curl

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install extensions
RUN docker-php-ext-install -j$(nproc) \
    iconv \
    mbstring \
    pdo \
    pdo_pgsql \
    xml \
    soap \
    zip \
    opcache \
    curl

# Install redis
RUN pecl install redis

# Enable redis and curl
RUN docker-php-ext-enable \
    redis \
    curl

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Add user for laravel application
RUN groupadd --force -g 1000 www
RUN useradd -u 1000 --no-user-group -ms /bin/bash -g www www

# Copy existing application directory contents
COPY . /var/www

# Copy existing application directory permissions
COPY --chown=www:www . /var/www

# Change current user to www
USER www

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]

FROM base_app AS supervisor_app

# Change to root user to install supervisor
USER root

# Install supervisor
RUN apt-get update && apt-get install -y supervisor

RUN mkdir -p "/var/log/supervisor"

# Copy the supervisord configuration file
COPY ./docker/supervisor/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]

