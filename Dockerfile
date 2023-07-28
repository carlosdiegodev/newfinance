FROM php:5.6-apache

RUN echo "deb http://archive.debian.org/debian stretch main contrib non-free" > /etc/apt/sources.list

RUN apt-get update -y &&\
    apt-get upgrade -y &&\
    apt-get install -y telnet &&\
    apt-get install -y mysql-client

RUN docker-php-ext-install mysqli 

RUN apt-get install vim -y

EXPOSE 80

WORKDIR /var/www/html/

COPY . .

RUN chown -R www-data:www-data /var/www/html

#ENTRYPOINT [ "php", "index.php" ]
#CMD ["apache2-foreground"]