# ✅ Fix Composer Platform PHP 8.4

## 🔧 Perubahan yang Sudah Dilakukan

### 1. Update `composer.json`

**Sebelum:**
```json
"require": {
    "php": "^8.1|^8.2|^8.3",
    ...
},
"config": {
    "platform": {
        "php": "8.1.0"  ❌
    }
}
```

**Sesudah:**
```json
"require": {
    "php": "^8.1|^8.2|^8.3|^8.4",  ✅
    ...
},
"config": {
    "platform": {
        "php": "8.4.0"  ✅
    }
}
```

## 🚀 Langkah-Langkah di Hosting (SSH)

### Step 1: Masuk ke Folder Project

```bash
cd public_html
# atau
cd ~/public_html
```

### Step 2: Hapus Vendor dan Composer Lock (Fresh Start)

```bash
rm -rf vendor composer.lock
```

### Step 3: Update Composer dengan PHP 8.4

```bash
/opt/alt/php84/usr/bin/php /usr/local/bin/composer update
```

**Atau jika path berbeda:**
```bash
# Cek path PHP 8.4 dulu
which php84
# atau
/usr/bin/php84 /usr/local/bin/composer update
```

### Step 4: Install untuk Production

```bash
/opt/alt/php84/usr/bin/php /usr/local/bin/composer install --no-dev --optimize-autoloader
```

### Step 5: Clear Cache Laravel

```bash
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear
```

### Step 6: Test

```bash
php artisan --version
php -v
```

## 📤 Push ke GitHub (Jika Menggunakan Git)

```bash
git add composer.json composer.lock
git commit -m "Fix composer platform to PHP 8.4"
git push origin main
```

## 🔍 Verifikasi

### Cek PHP Version

```bash
php -v
# Harus menunjukkan: PHP 8.4.x
```

### Cek Composer Platform

```bash
composer show --platform
# Harus menunjukkan: php 8.4.0
```

### Test Laravel

```bash
php artisan --version
# Harus berjalan tanpa error
```

## 🚨 Troubleshooting

### Masalah: Composer masih pakai PHP 8.1

**Solusi:**
```bash
# Hapus cache composer
rm -rf ~/.composer/cache

# Gunakan PHP 8.4 secara eksplisit
/opt/alt/php84/usr/bin/php /usr/local/bin/composer update
```

### Masalah: Path PHP 8.4 tidak ditemukan

**Cek path yang benar:**
```bash
# Coba beberapa path ini:
which php84
ls -la /opt/alt/php84/usr/bin/php
ls -la /usr/bin/php84
ls -la /usr/local/bin/php84

# Setelah ketemu, gunakan path yang benar
```

### Masalah: Masih error dependency

**Solusi:**
```bash
# Hapus semua dan install ulang
rm -rf vendor composer.lock
/opt/alt/php84/usr/bin/php /usr/local/bin/composer install --no-dev --optimize-autoloader
```

## ✅ Checklist

Setelah selesai, pastikan:
- [ ] `composer.json` sudah diupdate (platform: 8.4.0)
- [ ] `vendor/` dan `composer.lock` sudah dihapus
- [ ] Composer update berhasil tanpa error
- [ ] `php -v` menunjukkan PHP 8.4
- [ ] `php artisan --version` berjalan normal
- [ ] Auto deploy Hostinger berhasil

## 📝 Catatan

1. **Platform config** memaksa Composer menggunakan versi PHP tertentu
2. **Sebelum:** Dipaksa PHP 8.1 → konflik dengan Laravel 11/12
3. **Sesudah:** Dipaksa PHP 8.4 → kompatibel dengan Laravel 11/12
4. **Require PHP** juga ditambahkan `^8.4` untuk support versi terbaru

---

**Good luck! 🚀**

*HIMAKOM UYM - Komdigi Division*

