FROM php:8.0-apache

# Installer les extensions PHP nécessaires
RUN docker-php-ext-install pdo pdo_mysql

# Copier l'application de l'utilisateur dans le conteneur
COPY . /var/www/html

# Définir le répertoire de travail
WORKDIR /var/www/html

# Installer les dépendances avec Composer
RUN composer install --no-interaction

# Lancer le serveur PHP-FPM
CMD ["php-fpm"]
