# syntax=docker/dockerfile:1
#
# Multi-stage build for MathIndex (Symfony 7 / PostgreSQL / Webpack Encore).
#
#   composer        -> just the composer binary, used to seed later stages
#   php_base        -> common PHP-FPM image + extensions + non-root "app" user
#   vendor           -> composer dependencies (prod, no dev packages)
#   frontend_build   -> compiles assets/ with Webpack Encore
#   app_prod         -> production PHP-FPM runtime (immutable, non-root)
#   app_dev          -> development PHP-FPM runtime (xdebug, dev deps, runs as
#                       the bind-mounted source tree)
#   nginx_prod       -> production web server, static files baked in, no volumes
#
# Build a specific target with `docker build --target <name> .`; docker-compose
# picks the right target per environment (see compose.yaml / compose.override.yaml).

# Must satisfy whatever composer.lock actually resolved on the machine that
# last ran `composer update` (doctrine/instantiator 2.x requires PHP >=8.4) —
# bump both together if you re-lock against an older/newer PHP.
ARG PHP_VERSION=8.4

FROM composer:2 AS composer

FROM php:${PHP_VERSION}-fpm-alpine AS php_base

# Extensions required by the app: pdo_pgsql (Doctrine/PostgreSQL), intl
# (symfony/intl), zip (VichUploaderBundle), opcache (perf). `bash` is a
# convenience for `make bash` / interactive debugging, not required by PHP.
#
# The runtime shared libs (icu-libs/libpq/libzip) are installed as regular
# (non-virtual) packages so they survive the `apk del .build-deps` below —
# putting them in the virtual group too removes them along with the -dev
# headers, since apk garbage-collects a virtual group's otherwise-unused
# dependencies, leaving the compiled extensions unable to load their .so at
# runtime ("Unable to load dynamic library ... No such file or directory").
RUN apk update && apk upgrade --no-cache \
    && apk add --no-cache bash icu-libs libpq libzip \
    && apk add --no-cache --virtual .build-deps \
        icu-dev \
        libzip-dev \
        postgresql-dev \
    && docker-php-ext-install -j"$(nproc)" \
        intl \
        pdo_pgsql \
        zip \
        opcache \
    && apk del .build-deps \
    && rm -rf /var/cache/apk/*

COPY --from=composer /usr/bin/composer /usr/bin/composer
COPY docker/php/conf.d/app.ini $PHP_INI_DIR/conf.d/zz-app.ini

# Run as an unprivileged user rather than root.
RUN addgroup -g 1000 app && adduser -D -u 1000 -G app app

WORKDIR /app


# ---------------------------------------------------------------------------
# vendor: composer install, production dependencies only
# ---------------------------------------------------------------------------
FROM php_base AS vendor

COPY composer.json composer.lock symfony.lock ./
RUN composer install \
        --no-dev \
        --no-scripts \
        --no-autoloader \
        --no-interaction \
        --prefer-dist

COPY . .
RUN composer dump-autoload --optimize --no-dev --classmap-authoritative \
    && composer check-platform-reqs


# ---------------------------------------------------------------------------
# frontend_build: compile Webpack Encore assets (public/build/)
# ---------------------------------------------------------------------------
FROM node:22-alpine AS frontend_build
WORKDIR /app

COPY package.json package-lock.json ./
RUN npm ci

COPY webpack.config.js postcss.config.js tailwind.config.js ./
COPY assets/ assets/
RUN npm run build


# ---------------------------------------------------------------------------
# app_prod: production PHP-FPM runtime
# ---------------------------------------------------------------------------
FROM php_base AS app_prod

ENV APP_ENV=prod \
    APP_DEBUG=0

COPY --chown=app:app --from=vendor /app /app
COPY --chown=app:app --from=frontend_build /app/public/build /app/public/build

RUN mkdir -p var/cache var/log public/fichier/exercice \
    && chown -R app:app var public/fichier

# .env is intentionally excluded from the build context (.dockerignore) so no
# dev secret is baked into the image — but symfony/dotenv's bootEnv() still
# hard-requires the file to exist and be readable, even when every value it
# would provide is already set as a real environment variable (which always
# takes precedence over .env content). An empty file satisfies that check
# without shipping anything sensitive.
RUN touch .env && chown app:app .env

COPY --chown=app:app docker/php/docker-entrypoint.sh /usr/local/bin/docker-entrypoint
RUN chmod +x /usr/local/bin/docker-entrypoint

USER app
EXPOSE 9000
ENTRYPOINT ["docker-entrypoint"]
CMD ["php-fpm"]


# ---------------------------------------------------------------------------
# app_dev: development PHP-FPM runtime (source is bind-mounted at runtime,
# this stage only needs to provide the toolchain + an initial vendor/ copy so
# `docker compose up` works before the first `composer install` inside the
# bind mount).
# ---------------------------------------------------------------------------
FROM php_base AS app_dev

ENV APP_ENV=dev \
    APP_DEBUG=1 \
    COMPOSER_ALLOW_SUPERUSER=1

USER root
RUN apk add --no-cache --virtual .build-deps-xdebug $PHPIZE_DEPS linux-headers \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && apk del .build-deps-xdebug

COPY docker/php/conf.d/dev.ini $PHP_INI_DIR/conf.d/zz-dev.ini

COPY composer.json composer.lock symfony.lock ./
RUN composer install --no-scripts --no-interaction --prefer-dist \
    && composer clear-cache \
    && chown -R app:app /app

COPY docker/php/docker-entrypoint.sh /usr/local/bin/docker-entrypoint
RUN chmod +x /usr/local/bin/docker-entrypoint

# Deliberately stays root here (app_prod / nginx_prod, which is what actually
# ships, run non-root — see those stages). This container only ever runs
# against a bind-mounted source tree (compose.override.yaml), and Docker
# Desktop's Windows/Mac bind-mount translation does not reliably preserve
# uid 1000 write access to directories the container creates inside that
# mount (new subdirs round-trip through the host and often come back
# effectively read-only to that uid). Running as root sidesteps the whole
# class of bind-mount permission mismatches for local dev.
EXPOSE 9000
ENTRYPOINT ["docker-entrypoint"]
CMD ["php-fpm"]


# ---------------------------------------------------------------------------
# nginx_prod: static/production web server, no runtime volumes
# ---------------------------------------------------------------------------
FROM nginx:1.31-alpine AS nginx_prod

# `apk upgrade` pulls whatever patched package versions exist in this Alpine
# release *at build time*, independently of how stale the base image tag
# itself is — a Trivy scan found several HIGH/CRITICAL CVEs (libxml2, musl,
# nghttp2, zlib) in the OS packages baked into nginx:1.27-alpine; rebuilding
# regularly keeps this current instead of just fixing it once.
RUN apk update && apk upgrade --no-cache

RUN addgroup -g 1000 app 2>/dev/null; adduser -D -u 1000 -G app app 2>/dev/null || true

COPY docker/nginx/conf.d/default.conf /etc/nginx/conf.d/default.conf
COPY --from=app_prod /app/public /app/public

RUN chown -R app:app /var/cache/nginx /var/run \
    && touch /var/run/nginx.pid \
    && chown app:app /var/run/nginx.pid

USER app
EXPOSE 8080
