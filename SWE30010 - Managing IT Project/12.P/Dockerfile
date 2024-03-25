FROM php:7.4-apache

# Update package lists and upgrade existing packages
RUN apt-get update && apt-get upgrade -y

# Install mysqli extension
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# Add a group and user inside the container
RUN groupadd -r app && useradd -r -g app -s /bin/bash app

# Set permissions for the app user
RUN chown -R app:app /var/www/html/

# Switch to the app user
USER app

# Set the working directory
WORKDIR /var/www/html/

# Copy your application files into the container
COPY assign2_LD/ /var/www/html/

EXPOSE 80

CMD ["apachectl", "-D", "FOREGROUND"]

