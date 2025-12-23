#!/bin/bash

# Laravel Docker Setup Script
# Menjalankan setup otomatis untuk proyek Laravel dengan Docker

set -e

echo "🚀 Memulai setup Laravel dengan Docker..."

# Cek apakah Docker terinstall
if ! command -v docker &> /dev/null; then
    echo "❌ Docker tidak terinstall. Silakan install Docker terlebih dahulu."
    echo "   Ubuntu: sudo apt install docker.io"
    exit 1
fi

# Cek apakah Docker Compose terinstall
if ! command -v docker-compose &> /dev/null; then
    echo "❌ Docker Compose tidak terinstall. Silakan install Docker Compose."
    echo "   Ubuntu: sudo apt install docker-compose"
    exit 1
fi

# Cek apakah file docker-compose.yml ada
if [ ! -f "docker-compose.yml" ]; then
    echo "❌ File docker-compose.yml tidak ditemukan."
    exit 1
fi

echo "✅ Semua dependencies terinstall"

# Setup .env file jika belum ada
if [ ! -f ".env" ]; then
    echo "📝 Membuat file .env dari .env.example..."
    cp .env.example .env
    echo "✅ File .env berhasil dibuat"
else
    echo "✅ File .env sudah ada"
fi

# Build dan start containers
echo "🏗️  Building Docker images..."
docker-compose build

echo "🚀 Starting Docker containers..."
docker-compose up -d

# Tunggu container siap
echo "⏳ Menunggu container siap..."
sleep 10

# Setup Laravel di dalam container
echo "⚙️  Setting up Laravel application..."
docker exec -it parfume_app bash -c "
    echo 'Installing Composer dependencies...'
    composer install --optimize-autoloader --no-interaction

    echo 'Generating application key...'
    php artisan key:generate --force

    echo 'Creating storage link...'
    php artisan storage:link

    echo 'Running migrations...'
    php artisan migrate --force

    echo 'Caching configuration...'
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache

    echo 'Setting permissions...'
    chown -R appuser:appuser /var/www/storage
    chown -R appuser:appuser /var/www/bootstrap/cache
"

# Build frontend assets
echo "📦 Building frontend assets..."
docker exec -it parfume_app bash -c "
    if [ -f 'package.json' ]; then
        echo 'Installing npm dependencies...'
        npm install

        echo 'Building assets...'
        npm run build
    fi
"

echo ""
echo "✅ Setup selesai!"
echo ""
echo "📊 Service Status:"
docker-compose ps

echo ""
echo "🔗 Akses Aplikasi:"
echo "   Web: http://localhost:8080"
echo "   Database: localhost:3306 (user: laravel, pass: password)"
echo "   Redis: localhost:6379"
echo ""
echo "📋 Useful Commands:"
echo "   docker-compose logs -f      # Lihat logs"
echo "   docker-compose restart      # Restart services"
echo "   docker-compose down         # Stop containers"
echo "   docker exec -it parfume_app bash  # Masuk ke container"
echo ""
echo "📖 Untuk production deployment, lihat: DEPLOYMENT.md"