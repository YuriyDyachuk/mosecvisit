FROM phpdockerio/php74-fpm:latest
WORKDIR /application


# Fix debconf warnings upon build
ARG DEBIAN_FRONTEND=noninteractive
#ENV COMPOSER_ALLOW_SUPERUSER 1



# Install selected extensions and other stuff
RUN apt-get update \
    && apt-get -y --no-install-recommends install php7.4-memcached php7.4-mysql php7.4-gd php7.4-redis php7.4-imagick \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

# Install git
RUN apt-get update \
    && apt-get -y install git \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

