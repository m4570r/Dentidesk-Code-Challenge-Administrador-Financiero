# Usa una imagen base de PHP y Apache
FROM php:8.2.4-apache

# Expone el puerto 80
EXPOSE 80

# Establece el directorio de trabajo en la carpeta raíz del servidor web
WORKDIR /var/www/html

# Copia la API a la carpeta api en el servidor web
COPY ./api/v1/2023/ /var/www/html/api

# Copia la aplicación web a la carpeta app en el servidor web
COPY ./app/ /var/www/html/app

# Instala las extensiones PHP necesarias para MySQL
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Configura el acceso a la base de datos MySQL
ENV DB_HOST=192.168.1.139  
ENV DB_USER=docker
ENV DB_PASSWORD=171279879
ENV DB_NAME=codechallenge

# Comando para iniciar Apache
CMD ["apache2-foreground"]
