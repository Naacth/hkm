# Deployment Guide untuk Hostinger

## Persiapan

1. **Pastikan PHP Version di Hostinger**
   - Minimal PHP 8.1
   - Aktifkan extension: gd, imagick, zip, mbstring, pdo_mysql

2. **Database**
   - Buat database MySQL di Hostinger
   - Catat: DB_HOST, DB_DATABASE, DB_USERNAME, DB_PASSWORD

## Langkah Deployment

### 1. Setup Git Deployment di Hostinger

1. Login ke hPanel Hostinger
2. Pergi ke **Advanced** > **Git**
3. Klik **Create New Repository**
4. Isi form:
   - Repository URL: `https://github.com/Naacth/hkm.git`
   - Branch: `main`
   - Repository Path: `/public_html` atau folder yang diinginkan

### 2. Setup Environment

Setelah clone selesai, buat file `.env`:

```bash
cp .env.example .env
```

Edit `.env` dengan konfigurasi Hostinger:

```env
APP_NAME="HIMAKOM UYM"
APP_ENV=production
APP_KEY=
APP_DEBUG=false
APP_URL=https://yourdomain.com

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password

# Sesuaikan dengan konfigurasi Hostinger
```

### 3. Generate Application Key

```bash
php artisan key:generate
```

### 4. Install Dependencies

```bash
composer install --no-dev --optimize-autoloader --ignore-platform-reqs
```

### 5. Run Migrations

```bash
php artisan migrate --force
```

### 6. Seed Database (Optional)

```bash
php artisan db:seed
```

### 7. Set Permissions

```bash
chmod -R 755 storage bootstrap/cache
chmod -R 775 storage bootstrap/cache public/uploads
```

### 8. Cache Configuration

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## Auto Deployment

Untuk auto deployment, gunakan Git Deployment di Hostinger:

1. Setiap kali push ke GitHub, pull di Hostinger
2. Atau setup webhook untuk auto pull

## Troubleshooting

### Error: "Your requirements could not be resolved"

Gunakan flag `--ignore-platform-reqs`:
```bash
composer install --no-dev --optimize-autoloader --ignore-platform-reqs
```

### Error: Permission Denied

```bash
chmod -R 775 storage bootstrap/cache public/uploads
```

### Error: 500 Internal Server Error

1. Check `.env` file
2. Run `php artisan config:clear`
3. Check error logs di Hostinger

### Upload Files Not Working

Pastikan folder `public/uploads` ada dan writable:
```bash
mkdir -p public/uploads/certificates/manual
mkdir -p public/uploads/certificates/generated
mkdir -p public/uploads/certificates/batch
chmod -R 775 public/uploads
```

## Maintenance Mode

Aktifkan maintenance mode:
```bash
php artisan down
```

Nonaktifkan:
```bash
php artisan up
```

## Update Deployment

Setelah push ke GitHub:

1. Pull di Hostinger
2. Run deployment script:
```bash
bash deploy.sh
```

Atau manual:
```bash
composer install --no-dev --optimize-autoloader --ignore-platform-reqs
php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache
```
