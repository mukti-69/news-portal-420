#!/bin/sh
set -e

if [ -z "$APP_KEY" ]; then
    echo "FATAL: APP_KEY is not set."
    echo "Generate one locally (or use the value from the deployment notes)"
    echo "and set it as an environment variable in Render - do not let this"
    echo "script generate one, since a new key on every restart would break"
    echo "every existing session and any encrypted data."
    exit 1
fi

php artisan config:clear

if [ -n "$CLOUDINARY_CLOUD_NAME" ]; then
    masked_key=$(echo "$CLOUDINARY_API_KEY" | sed -E 's/^(.{3}).*(.{3})$/\1...\2/')
    echo "Cloudinary configured: cloud_name='${CLOUDINARY_CLOUD_NAME}' api_key='${masked_key}'"
    echo "(cloud_name is not secret - if this doesn't exactly match the 'Cloud"
    echo "name' shown on your Cloudinary dashboard, fix the CLOUDINARY_CLOUD_NAME"
    echo "env var in Render before anything below this line is worth debugging.)"
else
    echo "CLOUDINARY_CLOUD_NAME is not set - uploads will use local disk storage."
fi

echo "Running database migrations..."
if [ "$MIGRATE_FRESH" = "true" ]; then
    echo "MIGRATE_FRESH=true - wiping all tables and re-running migrations from"
    echo "scratch. This is a one-time escape hatch for a database left in a"
    echo "partial/broken state by an earlier failed deploy - it destroys all"
    echo "data. Remove the MIGRATE_FRESH env var in Render right after this"
    echo "deploy succeeds, before any real content/users exist, or the next"
    echo "redeploy will wipe them too."
    php artisan migrate:fresh --force
else
    php artisan migrate --force
fi

echo "Seeding roles/admin account/site defaults (idempotent, safe to re-run)..."
php artisan db:seed --class="Database\Seeders\ProductionSeeder" --force

echo "Linking storage (used when Cloudinary env vars aren't set)..."
php artisan storage:link || true

echo "Caching config/routes/views..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

PORT="${PORT:-10000}"
echo "Starting server on 0.0.0.0:${PORT}..."
exec php artisan serve --host=0.0.0.0 --port="${PORT}"
