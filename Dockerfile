FROM dunglas/frankenphp:php8.2

RUN install-php-extensions \
    pdo_mysql \
    mbstring \
    bcmath \
    intl \
    zip \
    opcache

RUN apt-get update && apt-get install -y nodejs npm

WORKDIR /app

COPY . .

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

RUN composer install --no-dev --optimize-autoloader

RUN npm install

RUN npm run build

EXPOSE 8080

CMD php artisan serve --host=0.0.0.0 --port=8080