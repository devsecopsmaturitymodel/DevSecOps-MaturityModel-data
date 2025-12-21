FROM php:apache-bullseye

ARG DSOMM_VERSION=dev
ARG GITHUB_REPOSITORY=DevSecOpsMaturityModel-data

RUN  apt-get update && apt-get -y install apt-utils libyaml-dev wget unzip && wget -O composer-setup.php https://getcomposer.org/installer && php composer-setup.php --install-dir=/usr/local/bin --filename=composer
COPY yaml-generation /var/www/html/yaml-generation
COPY generated /var/www/html/generated
COPY src /var/www/html/src
RUN cd /var/www/html/yaml-generation && composer install \
--ignore-platform-reqs \
--no-interaction \
--no-plugins \
--no-scripts \
--prefer-dist

RUN pecl channel-update pecl.php.net && pecl install yaml && docker-php-ext-enable yaml
RUN cd /var/www/html && GITHUB_REPOSITORY="${GITHUB_REPOSITORY}" php yaml-generation/generateDimensions.php && sed -i "s/__VERSION_PLACEHOLDER__/${DSOMM_VERSION}/g" /var/www/html/generated/model.yaml
workdir /var/www/html
CMD php yaml-generation/generateDimensions.ph

