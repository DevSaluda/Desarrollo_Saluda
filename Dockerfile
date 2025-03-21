# Usar una imagen base de PHP con Apache
FROM php:8.2-apache

# Instalar extensiones de PHP necesarias
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Copiar los archivos de la aplicación al contenedor
COPY app/ /var/www/html/
COPY public/ /var/www/html/public/

# Habilitar el módulo de Apache rewrite (para URLs amigables)
RUN a2enmod rewrite

# Establecer permisos adecuados
RUN chown -R www-data:www-data /var/www/html

# Exponer el puerto 80
EXPOSE 80