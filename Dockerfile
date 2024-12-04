# Utiliser une image officielle d'Apache avec PHP préinstallé
FROM php:8.1-apache

# Mettre à jour le système et installer les extensions nécessaires
RUN apt-get update && apt-get install -y \
    mariadb-client \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libzip-dev \
    zip \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql mysqli gd zip

# Activer les modules Apache requis
RUN a2enmod rewrite

# Copier le code source de votre application dans le conteneur
COPY ./src /var/www/html

# Définir les droits pour le dossier contenant l'application
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Exposer le port 80
EXPOSE 80

# Commande par défaut pour démarrer Apache
CMD ["apache2-foreground"]
