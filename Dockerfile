# Stage 1: PHP avec Composer
FROM php:8.2-fpm-alpine AS php-base

# Installer les dépendances système
RUN apk add --no-cache \
    build-base \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    zip \
    unzip \
    git \
    curl \
    sqlite \
    npm

# Installer les extensions PHP
RUN docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install -j$(nproc) \
    gd \
    pdo \
    pdo_sqlite \
    bcmath \
    ctype \
    json \
    mbstring \
    tokenizer

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Définir le répertoire de travail
WORKDIR /app

# Copier les fichiers du projet
COPY . .

# Installer les dépendances PHP
RUN composer install --no-dev --no-interaction --no-progress

# Installer les dépendances npm
RUN npm install

# Compiler les assets
RUN npm run build

# Créer le fichier .env s'il n'existe pas
RUN if [ ! -f .env ]; then cp .env.example .env; fi

# Générer la clé d'application
RUN php artisan key:generate

# Créer les répertoires de storage
RUN mkdir -p storage/framework/cache \
    storage/framework/sessions \
    storage/framework/views \
    storage/logs \
    bootstrap/cache

# Définir les permissions
RUN chown -R www-data:www-data /app && \
    chmod -R 755 storage bootstrap/cache

# Exposer le port
EXPOSE 8000

# Commande de démarrage
CMD php artisan serve --host=0.0.0.0 --port=8000
