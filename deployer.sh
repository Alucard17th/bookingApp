set -e

echo "Deploying..."

(php artisan down --message="Deploy in progress. Please try again in a minute.") || true

git pull

php artisan up