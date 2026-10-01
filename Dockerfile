FROM php:8.2-cli-bookworm

# System packages:
#   - build/image libs needed by the gd/zip/intl PHP extensions below
#   - ffmpeg: required by pbmedia/laravel-ffmpeg (the native video-upload
#     feature) even though the site primarily uses YouTube/Facebook embeds -
#     installed so that feature doesn't hard-crash if it's ever used
#   - unzip/git: needed by Composer
#   - default-mysql-client: handy for debugging DB connectivity from a shell
RUN apt-get update && apt-get install -y --no-install-recommends \
        git \
        unzip \
        ffmpeg \
        default-mysql-client \
        libpng-dev \
        libjpeg62-turbo-dev \
        libfreetype6-dev \
        libzip-dev \
        libicu-dev \
        libonig-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j"$(nproc)" \
        pdo_mysql \
        mbstring \
        exif \
        pcntl \
        bcmath \
        gd \
        zip \
        intl \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

# composer.lock does not yet include yoelpc4/laravel-cloudinary (added to
# composer.json in a sandbox with no access to packagist.org, so the lock
# file couldn't be regenerated there - see that PR for details). A full
# `composer update` here resolves everything fresh against composer.json,
# rather than `composer install`, which would refuse to run against a lock
# file that's out of sync. This trades lock-file reproducibility between
# deploys for a build that actually succeeds; revisit if that ever matters
# more than it does for a small news site.
RUN composer update --no-dev --no-interaction --optimize-autoloader --no-ansi

# storage/ and bootstrap/cache/ must be writable by the web server process
RUN chmod -R 775 storage bootstrap/cache

EXPOSE 10000

COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

ENTRYPOINT ["entrypoint.sh"]
