FROM php:8.2-fpm

WORKDIR /usr

# install imagick
RUN apt-get update; \
	apt-get install -y imagemagick libmagickwand-dev libmagickcore-dev; \
	pecl install imagick; \
	docker-php-ext-enable imagick; \
	apt-get install -y xvfb libxrender1 libxtst6 libxi6 default-jre curl; \
	curl --location https://github.com/benfry/processing4/releases/download/processing-1293-4.3/processing-4.3-linux-x64.tgz | tar xz; \
	chown www-data:www-data /var/www;