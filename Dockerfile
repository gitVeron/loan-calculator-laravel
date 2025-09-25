FROM php:8.3-cli

# Установка системных пакетов
RUN apt-get update && apt-get install -y \
    git \
    curl \
    unzip

# Установка Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Рабочая директория
WORKDIR /var/www/html

# Копирование файлов проекта
COPY . .

# Установка зависимостей
RUN composer install --no-interaction --optimize-autoloader

# Открываем порт
EXPOSE 8000

# Команда запуска
CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]