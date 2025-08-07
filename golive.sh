#!/bin/bash

# === VARIABEL ===
LARAVEL_PATH="/home/trianuge/tas-web/public"
PUBLIC_HTML="/home/trianuge/public_html"

echo "🚀 Memulai proses go-live..."

# Backup isi public_html lama (opsional)
TIMESTAMP=$(date +%Y%m%d%H%M%S)
BACKUP_DIR="/home/trianuge/public_html_backup_$TIMESTAMP"
mkdir "$BACKUP_DIR"
mv "$PUBLIC_HTML"/* "$BACKUP_DIR"/

# Hapus symlink/file lama jika ada
rm -rf "$PUBLIC_HTML"/*

# Buat symlink baru ke folder public Laravel
ln -s "$LARAVEL_PATH"/* "$PUBLIC_HTML"

echo "✅ Symlink selesai dibuat."

# (Opsional) Set permission
chmod -R 755 "$PUBLIC_HTML"
echo "✅ Permission di-set."

# (Opsional) Jalankan command artisan
cd /home/trianuge/laravel_project
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "🎉 Go-live selesai!"