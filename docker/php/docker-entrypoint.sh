#!/bin/sh
set -e

cd /app

# Dev only: vendor/ lives in a named volume (see compose.override.yaml) so the
# bind-mounted source tree doesn't shadow it. Re-run composer install whenever
# the lockfile changed since the volume was last populated.
if [ "$APP_ENV" = "dev" ] && [ -f composer.json ]; then
    if [ ! -f vendor/autoload.php ] || [ composer.lock -nt vendor/autoload.php ]; then
        composer install --no-interaction --prefer-dist
    fi
fi

mkdir -p var/cache var/log

exec "$@"
