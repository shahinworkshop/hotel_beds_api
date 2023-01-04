FROM nginx:1.17.8-alpine as nginx-service

ARG APP_ENV=dev
ENV APP_ENV=$APP_ENV

# Copy the nginx config file
COPY ./docker/nginx/nginx.$APP_ENV.conf /etc/nginx/conf.d/default.conf

# Copy the public directory
COPY ./app /app

WORKDIR /app

EXPOSE 80