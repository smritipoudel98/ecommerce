# Dockerfile-	Builds the PHP container with Laravel dependencies

FROM php:8.2-fpm
#- This tells Docker: **Use the official PHP 8.2 FPM image** as the base for our Laravel app.
# - FPM (FastCGI Process Manager) is used with web servers like **Nginx**.


# Install dependencies -This installs system dependencies your Laravel app may need.
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    curl \
    git \
    npm \
    netcat-openbsd \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*
 
    #apt-get update= Updates the list of available packages in the system.
    # apt-get install -y \build-essential \=(y=yes) (build-essential=Build certain PHP extensions (like pdo_mysql, gd(graphics), etc.))
    # libonig-dev \=Helps PHP find patterns in text, which Laravel uses for things like form validation.
    #libxml2-dev \= Required for PHP to work with XML.
    # curl \=Like a robot that talks to the internet.
    # curl \=It helps your app download files or connect to APIs.
    # npm=It’s used for frontend stuff — like CSS, JavaScript, and Bootstrap.
    # libpng-dev \,libjpeg-dev \=These are image tools.Laravel needs them if you want to resize, crop, or edit images in your app.
    #unzip \=Allows you to open .zip files.Composer sometimes downloads zipped packages, so you need this to unpack them.    

# PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd
# - Installs **required PHP extensions** for Laravel:
    # - `pdo_mysql` – database connection.
    # - `mbstring` – multi-byte string support.
    # - `gd` – for image handling.
    # - `bcmath` – for precise math calculations.
    # - `exif` – to read image metadata.
    # - `pcntl` – useful for queue workers.[Lets PHP handle system signals/processes]
  

# Install Redis
RUN pecl install -o -f redis \
    && rm -rf /tmp/pear \
    && docker-php-ext-enable redis
# pecl install redis =downloads and installs the Redis extension for PHP.
#docker-php-ext-enable redis= This command enables the Redis extension in PHP.

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
# This copies the Composer binary (composer) from the official Composer image into your container.
# So now your container can use Composer without you having to install it manually. 

WORKDIR /var/www
# This sets the working directory inside the Docker container to /var/www.
# All the next commands in the Dockerfile will run inside this directory.

# Copy composer files first
COPY composer.json composer.lock ./

# Install dependencies
RUN composer install --no-dev --no-interaction --optimize-autoloader --no-scripts

# Copy application
COPY . .

# Run post-install scripts
RUN composer run post-autoload-dump

COPY ./docker/entrypoint.sh /usr/local/bin/entrypoint.sh
# 📥 This copies your script file entrypoint.sh
# ➤ from the folder ./docker/ (inside your Laravel project)
# ➤ into the Docker image, at the path: /usr/local/bin/entrypoint.sh

RUN chmod +x /usr/local/bin/entrypoint.sh
# 🛠️ This makes the script executable.(giving permission to run the file.)
# Without this, the script is just a text file and cannot be run. 



  ### ```Dockerfile
 

COPY ./docker/php/php.ini /usr/local/etc/php/conf.d/php.ini
# Take your custom php.ini file from your local folder (docker/php/php.ini) and place it inside the container at the path where PHP expects to find configuration files.

COPY ./docker/php/php-fpm.conf /usr/local/etc/php-fpm.d/zz-docker.conf
# It copies a file named php-fpm.conf from your local project folder at ./docker/php/php-fpm.conf into the Docker container at /usr/local/etc/php-fpm.d/zz-docker.conf

# COPY .env.docker .env
# Copies the file named .env.docker from your local project folder (where you run Docker build) into the Docker image’s filesystem as a file named .env inside the container



# Set permissions
RUN chown -R www-data:www-data /var/www/storage \
    && chown -R www-data:www-data /var/www/bootstrap/cache \
    && chmod -R 775 /var/www/storage \
    && chmod -R 775 /var/www/bootstrap/cache

    EXPOSE 9000

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
# This tells Docker:  “When the container starts, run this script.”


CMD ["php-fpm"]



# 🔹 Dockerfile
#- Defines how to build a container image.
# -Think of it as the recipe: which OS to use, which software to install (PHP, Composer, extensions), etc.
# -Output: a custom image for your app.