FROM alpine:3.7

# Install PHP extensions
RUN apk --no-cache --update add \
        curl \
        libpng-dev \
        php7 \
        php7-ctype \
        php7-curl \
        php7-dom \
        php7-fpm \
        php7-gd \
        php7-iconv \
        php7-json \
        php7-mbstring \
        php7-openssl \
        php7-pdo \
        php7-pdo_mysql \
        php7-pdo_sqlite \
        php7-phar \
        php7-session \
        php7-tokenizer \
        php7-xml \
        php7-xmlwriter \
    && curl -s https://getcomposer.org/installer | php \
    && chmod a+x composer.phar \
    && mv composer.phar /usr/local/bin/composer \
    && echo "#!/usr/bin/env sh" > phpunit \
    && echo "/application/vendor/bin/phpunit \"\$@\"" >> phpunit \
    && chmod a+x phpunit \
    && mv phpunit /usr/local/bin/phpunit \
    && addgroup application \
    && adduser -G application -D application

WORKDIR "/application"

USER application

CMD ["php-fpm7", "-F"]
