# Debug Gambar Tidak Muncul di Hosting

## Masalah yang Teridentifikasi

Berdasarkan screenshot, gambar event tidak muncul di hosting tapi normal di lokal. Ini biasanya disebabkan oleh:

1. **APP_URL salah di .env hosting**
2. **Folder `public/uploads` tidak ada atau permission salah**
3. **Path gambar di database salah**
4. **File gambar tidak ter-upload ke hosting**

---

## ✅ Langkah-Langkah Debugging

### 1. Cek APP_URL di Hosting

**Via SSH atau File Manager**, buka file `.env` di hosting dan pastikan:

```env
APP_URL=https://himakomyatsi.web.id
```

**PENTING:**
- Harus HTTPS jika hosting pakai SSL
- JANGAN ada trailing slash (/)
- Harus sesuai dengan domain hosting

### 2. Cek Struktur Folder di Hosting

Via **File Manager Hostinger**, pastikan struktur seperti ini:

```
public_html/
├── public/
│   ├── uploads/           ← HARUS ADA!
│   │   ├── events/        ← Gambar event di sini
│   │   ├── qris/
│   │   ├── certificates/
│   │   └── proof_of_payment/
│   ├── index.php
│   └── .htaccess
├── app/
├── config/
└── ...
```

**Jika folder `public/uploads` tidak ada**, buat via SSH:

```bash
cd public_html/public
mkdir -p uploads/events
mkdir -p uploads/qris
mkdir -p uploads/certificates
mkdir -p uploads/proof_of_payment
chmod -R 775 uploads
```

### 3. Cek Permission Folder

Via SSH:

```bash
cd public_html/public
ls -la uploads/
```

Output yang benar:

```
drwxrwxr-x  uploads
drwxrwxr-x  events
drwxrwxr-x  qris
```

Jika permission salah:

```bash
chmod -R 775 uploads
chown -R username:username uploads
```

### 4. Cek Path Gambar di Database

Via **phpMyAdmin** atau **MySQL CLI**:

```sql
-- Cek path gambar di database
SELECT id, title, image FROM events LIMIT 10;
```

**Path yang BENAR:**
```
events/event-1733123456.jpg
```

**Path yang SALAH:**
```
storage/events/event-1733123456.jpg
/uploads/events/event-1733123456.jpg
uploads/events/event-1733123456.jpg
```

Jika path salah, fix dengan:

```sql
-- Hapus prefix 'storage/' jika ada
UPDATE events 
SET image = REPLACE(image, 'storage/', '') 
WHERE image LIKE 'storage/%';

-- Hapus prefix '/uploads/' jika ada
UPDATE events 
SET image = REPLACE(image, '/uploads/', '') 
WHERE image LIKE '/uploads/%';

-- Hapus prefix 'uploads/' jika ada
UPDATE events 
SET image = REPLACE(image, 'uploads/', '') 
WHERE image LIKE 'uploads/%' AND image NOT LIKE 'events/%';
```

### 5. Test Akses Gambar Langsung

Buka browser dan akses:

```
https://himakomyatsi.web.id/uploads/events/nama-file.jpg
```

**Jika gambar muncul** = Path benar, masalah di blade template
**Jika 404 Not Found** = File tidak ada atau path salah
**Jika 403 Forbidden** = Permission salah

### 6. Cek File .htaccess di public/

Pastikan ada file `.htaccess` di folder `public/` dengan isi:

```apache
<IfModule mod_rewrite.c>
    <IfModule mod_negotiation.c>
        Options -MultiViews -Indexes
    </IfModule>

    RewriteEngine On

    # Handle Authorization Header
    RewriteCond %{HTTP:Authorization} .
    RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]

    # Redirect Trailing Slashes If Not A Folder...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_URI} (.+)/$
    RewriteRule ^ %1 [L,R=301]

    # Send Requests To Front Controller...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [L]
</IfModule>
```

### 7. Clear Cache di Hosting

Via SSH:

```bash
cd public_html
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear
```

### 8. Upload Gambar Test

1. Login ke admin panel di hosting
2. Buat event baru
3. Upload gambar test
4. Cek apakah file masuk ke `public/uploads/events/`
5. Cek apakah gambar muncul di halaman event

---

## 🔍 Debugging Script

Buat file `debug-images.php` di folder `public/`:

```php
<?php
// File: public/debug-images.php

echo "<h1>Debug Image Upload</h1>";

// 1. Cek APP_URL
echo "<h2>1. APP_URL</h2>";
echo "<pre>";
echo "APP_URL: " . env('APP_URL', 'NOT SET') . "\n";
echo "Current URL: " . (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
echo "</pre>";

// 2. Cek folder uploads
echo "<h2>2. Folder Structure</h2>";
echo "<pre>";
$uploadsPath = __DIR__ . '/uploads';
echo "Uploads path: $uploadsPath\n";
echo "Exists: " . (file_exists($uploadsPath) ? 'YES' : 'NO') . "\n";
echo "Writable: " . (is_writable($uploadsPath) ? 'YES' : 'NO') . "\n";
echo "Permission: " . substr(sprintf('%o', fileperms($uploadsPath)), -4) . "\n";
echo "</pre>";

// 3. List files in events folder
echo "<h2>3. Files in events/</h2>";
echo "<pre>";
$eventsPath = $uploadsPath . '/events';
if (file_exists($eventsPath)) {
    $files = scandir($eventsPath);
    foreach ($files as $file) {
        if ($file != '.' && $file != '..') {
            echo "$file\n";
        }
    }
} else {
    echo "Folder events/ tidak ada!";
}
echo "</pre>";

// 4. Test image URL
echo "<h2>4. Test Image URL</h2>";
$testImage = 'events/test.jpg'; // Ganti dengan nama file yang ada
$imageUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]/uploads/$testImage";
echo "<p>Test URL: <a href='$imageUrl' target='_blank'>$imageUrl</a></p>";
echo "<img src='$imageUrl' style='max-width: 300px;' onerror='this.style.display=\"none\"; this.nextElementSibling.style.display=\"block\"'>";
echo "<p style='display:none; color:red;'>❌ Gambar tidak bisa dimuat!</p>";
?>
```

Akses via browser:
```
https://himakomyatsi.web.id/debug-images.php
```

---

## 🎯 Quick Fix Script

Jalankan script ini via SSH untuk fix semua masalah sekaligus:

```bash
#!/bin/bash

echo "=== Fix Image Upload Issues ==="

# 1. Buat folder jika belum ada
echo "1. Creating folders..."
mkdir -p public/uploads/events
mkdir -p public/uploads/qris
mkdir -p public/uploads/certificates/manual
mkdir -p public/uploads/certificates/generated
mkdir -p public/uploads/certificates/batch
mkdir -p public/uploads/proof_of_payment

# 2. Set permission
echo "2. Setting permissions..."
chmod -R 775 public/uploads
chown -R $USER:$USER public/uploads

# 3. Clear cache
echo "3. Clearing cache..."
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

# 4. Check structure
echo "4. Checking structure..."
ls -la public/uploads/

echo "=== Done! ==="
echo "Test upload gambar baru di admin panel"
```

Save sebagai `fix-images.sh`, lalu jalankan:

```bash
chmod +x fix-images.sh
./fix-images.sh
```

---

## 📋 Checklist Debugging

- [ ] APP_URL di .env sudah benar (https://himakomyatsi.web.id)
- [ ] Folder `public/uploads/events` sudah ada
- [ ] Permission folder 775 atau 755
- [ ] Path di database format: `events/nama-file.jpg`
- [ ] File gambar ada di `public/uploads/events/`
- [ ] Gambar bisa diakses via URL langsung
- [ ] Cache sudah di-clear
- [ ] Test upload gambar baru berhasil

---

## 🚨 Masalah Umum & Solusi

### Masalah 1: Gambar 404 Not Found

**Penyebab:**
- File tidak ada di server
- Path salah

**Solusi:**
1. Upload ulang gambar via admin panel
2. Atau copy file dari lokal ke hosting via FTP

### Masalah 2: Gambar 403 Forbidden

**Penyebab:**
- Permission folder salah

**Solusi:**
```bash
chmod -R 775 public/uploads
```

### Masalah 3: Gambar Broken (Icon X)

**Penyebab:**
- APP_URL salah
- Path di database salah

**Solusi:**
1. Fix APP_URL di .env
2. Fix path di database dengan SQL di atas
3. Clear cache

### Masalah 4: Upload Gagal

**Penyebab:**
- Folder tidak writable
- PHP upload_max_filesize terlalu kecil

**Solusi:**
```bash
chmod -R 775 public/uploads

# Edit php.ini
upload_max_filesize = 10M
post_max_size = 10M
```

---

## 📞 Jika Masih Bermasalah

1. Screenshot error yang muncul
2. Cek `storage/logs/laravel.log`
3. Jalankan `debug-images.php`
4. Kirim hasil debugging

---

## 💡 Tips Pencegahan

1. **Selalu gunakan `asset()` helper** di blade:
   ```php
   <img src="{{ asset('uploads/' . $event->image) }}">
   ```

2. **Jangan simpan path lengkap** di database:
   ```
   ✅ BENAR: events/event-123.jpg
   ❌ SALAH: /uploads/events/event-123.jpg
   ```

3. **Backup folder uploads** sebelum deploy:
   ```bash
   tar -czf uploads-backup.tar.gz public/uploads/
   ```

4. **Set permission yang benar** setelah deploy:
   ```bash
   chmod -R 775 public/uploads
   ```
