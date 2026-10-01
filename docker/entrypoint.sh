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

echo "Running database migrations..."
php artisan migrate --force

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
