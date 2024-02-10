# Utilise l'image officielle de PHP 8.0 avec Apache comme image de base.
FROM php:8.0-apache

# le nom du maintener du systeme
LABEL maintainer="Issa Oumar Ache Fadoul "

#Définit le répertoire de travail à /var/www/html dans le conteneur.
WORKDIR /var/www/html


# Copie le contenu du répertoire courant (où se trouve le Dockerfile) dans le répertoire de travail du conteneur 
COPY . /var/www/html

#Installe et active l'extension pdo_mysql pour PHP.
RUN docker-php-ext-install pdo_mysql && docker-php-ext-enable pdo_mysql

#Met à jour et met à niveau le système de paquets dans le conteneur.
RUN apt-get update && apt-get upgrade -y


# start application : docker compose up -d
# stop application : docker compose down

