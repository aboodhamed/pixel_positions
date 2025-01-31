# استخدم صورة PHP كقاعدة
FROM php:8.1-fpm

# تعيين الدليل الأساسي
WORKDIR /var/www

# تثبيت المتطلبات الأساسية لنظام التشغيل وإضافات PHP
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libpq-dev

# تثبيت إضافات PHP المطلوبة
RUN docker-php-ext-install pdo pdo_mysql pdo_pgsql mbstring exif pcntl bcmath gd

# تثبيت Composer لإدارة الحزم
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# نسخ ملفات المشروع إلى الحاوية
COPY . .

# تثبيت مكتبات Laravel
RUN composer install --no-dev --optimize-autoloader

# تثبيت npm ومكتبات Tailwind CSS
RUN npm install && npm run build

# إعداد الأذونات الصحيحة
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# فضح المنفذ 80
EXPOSE 80

# الأوامر الافتراضية لتشغيل التطبيق
CMD ["php-fpm"]
