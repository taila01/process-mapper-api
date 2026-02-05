FROM php:8.4-cli

# Instala dependências do sistema
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    && docker-php-ext-install zip

# Copia o Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# 1️⃣ Copia só composer.json e composer.lock
COPY composer.json composer.lock ./

# 2️⃣ Instala dependências sem rodar scripts (evita erro do artisan)
RUN composer install --no-interaction --prefer-dist --no-scripts

# 3️⃣ Copia o restante do projeto
COPY . .

# 4️⃣ Agora roda scripts pós-autoload (artisan já existe)
RUN composer run-script post-autoload-dump

# Porta e comando padrão
EXPOSE 8000
CMD ["php", "artisan", "serve", "--host=0.0.0.0"]
