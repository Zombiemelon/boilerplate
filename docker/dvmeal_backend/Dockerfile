FROM composer:1.7.2 as build-stage
COPY ./dvmeal_backend /app
RUN composer update

FROM php:7.3-fpm
RUN apt-get update; \
    apt-get install -y libpng-dev; \
    docker-php-ext-install gd \
    pdo \
    pdo_mysql
RUN apt-get -y install nginx \
    supervisor
COPY ./docker/nginx/sites-enabled-back /etc/nginx/conf.d/default.conf
COPY --from=build-stage /app /home/dvmeal/dvmeal_backend
COPY ./docker/nginx/nginx.conf /etc/nginx/nginx.conf
COPY ./docker/supervisor/supervisord.conf /etc/supervisor/supervisord.conf

RUN chown -R :www-data /home/dvmeal/dvmeal_backend/storage/logs/
RUN chown -R :www-data /home/dvmeal/dvmeal_backend/storage/
RUN chmod -R g+w /home/dvmeal/dvmeal_backend/storage
RUN cd /home/dvmeal/dvmeal_backend; php artisan key:generate

EXPOSE 80

CMD ["service", "supervisor", "start"]