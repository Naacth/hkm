# 🔧 Panduan Lengkap Fix Gambar Tidak Muncul di Hosting

## 📋 Daftar Isi
1. [Identifikasi Masalah](#identifikasi-masalah)
2. [Persiapan](#persiapan)
3. [Langkah-Langkah Fix](#langkah-langkah-fix)
4. [Verifikasi](#verifikasi)
5. [Troubleshooting](#troubleshooting)

---

## 🔍 Identifikasi Masalah

Gambar tidak muncul di hosting bisa disebabkan oleh:

✅ **Sudah Benar di Lokal** → Gambar muncul normal
❌ **Error di Hosting** → Gambar tidak muncul (broken image icon)

### Kemungkinan Penyebab:

1. **APP_URL salah** di file `.env`
2. **Folder `public/uploads` tidak ada** atau permission salah
3. **Path gambar di database salah** (ada prefix `storage/` atau `/uploads/`)
4. **File gambar tidak ter-upload** ke hosting

---

## 🛠️ Persiapan

### Tools yang Dibutuhkan:

1. **Akses SSH** ke hosting (via Hostinger terminal atau PuTTY)
2. **Akses File Manager** Hostinger
3. **Akses phpMyAdmin** untuk database
4. **FTP Client** (FileZilla) - optional

### File yang Sudah Dibuat:

- ✅ `public/debug-images.php` - Script debugging
- ✅ `fix-images-hosting.sh` - Bash script auto-fix
- ✅ `FIX_IMAGE_PATHS_HOSTING.sql` - SQL untuk fix database
- ✅ `DEBUG_IMAGE_ISSUE.md` - Dokumentasi lengkap

---

## 🚀 Langkah-Langkah Fix

### Step 1: Upload File Debug ke Hosting

**Via File Manager Hostinger:**

1. Login ke Hostinger
2. Buka **File Manager**
3. Navigate ke `public_html/public/`
4. Upload file `debug-images.php`

**Via FTP:**

```bash
# Upload via FTP ke folder public/
public_html/public/debug-images.php
```

### Step 2: Jalankan Debug Script

1. Buka browser
2. Akses: `https://himakomyatsi.web.id/debug-images.php`
3. **Catat semua error/warning** yang muncul

**Yang Harus Dicek:**

- ✅ APP_URL match dengan current URL?
- ✅ Semua folder uploads ada?
- ✅ Permission folder benar (775)?
- ✅ Path gambar di database benar?
- ✅ File gambar ada di server?

### Step 3: Fix APP_URL (Jika Salah)

**Via File Manager:**

1. Buka file `.env` di root folder
2. Cari baris `APP_URL=`
3. Ubah menjadi:
   ```env
   APP_URL=https://himakomyatsi.web.id
   ```
4. **PENTING:** Tanpa trailing slash `/`
5. Save file

**Via SSH:**

```bash
cd public_html
nano .env

# Edit APP_URL, lalu save (Ctrl+X, Y, Enter)
```

### Step 4: Buat Folder & Set Permission

**Via SSH (Recommended):**

```bash
# Masuk ke folder project
cd public_html

# Jalankan script auto-fix
chmod +x fix-images-hosting.sh
./fix-images-hosting.sh
```

**Via File Manager (Manual):**

1. Navigate ke `public_html/public/`
2. Buat folder baru: `uploads`
3. Masuk ke folder `uploads`
4. Buat subfolder:
   - `events`
   - `qris`
   - `certificates`
   - `proof_of_payment`
   - `products`
5. Set permission semua folder ke **775**

**Via SSH (Manual):**

```bash
cd public_html/public

# Buat folder
mkdir -p uploads/events
mkdir -p uploads/qris
mkdir -p uploads/certificates/manual
mkdir -p uploads/certificates/generated
mkdir -p uploads/certificates/batch
mkdir -p uploads/proof_of_payment
mkdir -p uploads/products

# Set permission
chmod -R 775 uploads
chmod -R 775 ../storage
chmod -R 775 ../bootstrap/cache

# Verify
ls -la uploads/
```

### Step 5: Fix Path Gambar di Database

**Via phpMyAdmin:**

1. Login ke phpMyAdmin
2. Pilih database project
3. Klik tab **SQL**
4. Copy-paste isi file `FIX_IMAGE_PATHS_HOSTING.sql`
5. Klik **Go** / **Jalankan**

**Via SSH (MySQL CLI):**

```bash
# Login ke MySQL
mysql -u username -p database_name

# Paste SQL queries dari FIX_IMAGE_PATHS_HOSTING.sql
# Atau import file:
mysql -u username -p database_name < FIX_IMAGE_PATHS_HOSTING.sql
```

**SQL Quick Fix:**

```sql
-- Fix events table
UPDATE events 
SET image = REPLACE(image, 'storage/', '') 
WHERE image LIKE 'storage/%';

UPDATE events 
SET image = REPLACE(image, '/uploads/', '') 
WHERE image LIKE '/uploads/%';

-- Verify
SELECT id, title, image FROM events LIMIT 10;
```

### Step 6: Clear Cache Laravel

**Via SSH:**

```bash
cd public_html

php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear
```

**Via File Manager (Manual):**

1. Delete folder `bootstrap/cache/*.php` (kecuali `.gitignore`)
2. Delete folder `storage/framework/cache/*`
3. Delete folder `storage/framework/views/*`

### Step 7: Upload Gambar yang Hilang

**Jika file gambar tidak ada di hosting:**

**Via FTP:**

1. Buka FileZilla
2. Connect ke hosting
3. Navigate ke `public_html/public/uploads/events/`
4. Upload semua gambar dari lokal: `public/uploads/events/`

**Via File Manager:**

1. Navigate ke `public/uploads/events/`
2. Klik **Upload**
3. Pilih semua file gambar
4. Upload

---

## ✅ Verifikasi

### 1. Test Debug Script Lagi

Akses: `https://himakomyatsi.web.id/debug-images.php`

**Harus semua hijau (✓):**

- ✅ APP_URL match
- ✅ Semua folder ada
- ✅ Permission benar
- ✅ Path database benar
- ✅ Gambar test muncul

### 2. Test Akses Gambar Langsung

Buka browser, akses:

```
https://himakomyatsi.web.id/uploads/events/nama-file.jpg
```

**Jika gambar muncul** = ✅ Path benar!

### 3. Test di Halaman Event

1. Buka: `https://himakomyatsi.web.id/event`
2. Cek apakah gambar event muncul
3. Inspect element (F12) jika masih broken
4. Lihat URL gambar di Network tab

### 4. Test Upload Gambar Baru

1. Login ke admin panel
2. Buat event baru
3. Upload gambar
4. Save
5. Cek apakah gambar muncul
6. Verify file ada di `public/uploads/events/`

---

## 🔧 Troubleshooting

### Masalah 1: Gambar Masih 404 Not Found

**Penyebab:**
- File tidak ada di server
- Path salah

**Solusi:**

```bash
# Cek apakah file ada
cd public_html/public/uploads/events
ls -la

# Jika tidak ada, upload dari lokal via FTP
```

### Masalah 2: Gambar 403 Forbidden

**Penyebab:**
- Permission folder salah

**Solusi:**

```bash
cd public_html/public
chmod -R 775 uploads
chown -R username:username uploads
```

### Masalah 3: Gambar Broken (Icon X)

**Penyebab:**
- APP_URL salah
- Path di database salah

**Solusi:**

1. Fix APP_URL di `.env`
2. Run SQL fix di phpMyAdmin
3. Clear cache

```bash
php artisan config:clear
php artisan cache:clear
```

### Masalah 4: Upload Gagal

**Penyebab:**
- Folder tidak writable
- PHP upload limit terlalu kecil

**Solusi:**

```bash
# Set permission
chmod -R 775 public/uploads

# Check PHP settings
php -i | grep upload_max_filesize
php -i | grep post_max_size

# Edit php.ini (via Hostinger panel)
upload_max_filesize = 10M
post_max_size = 10M
```

### Masalah 5: Gambar Muncul di Lokal, Tidak di Hosting

**Penyebab:**
- APP_URL berbeda
- Symlink `storage:link` tidak work di hosting

**Solusi:**

✅ **JANGAN gunakan** `php artisan storage:link` di hosting!

✅ **GUNAKAN** folder `public/uploads` langsung

```php
// ✅ BENAR
<img src="{{ asset('uploads/' . $event->image) }}">

// ❌ SALAH
<img src="{{ asset('storage/' . $event->image) }}">
```

---

## 📊 Checklist Final

Sebelum selesai, pastikan semua ini sudah ✅:

- [ ] APP_URL di `.env` benar (https://himakomyatsi.web.id)
- [ ] Folder `public/uploads/events` ada
- [ ] Permission folder 775
- [ ] Path di database format: `events/nama-file.jpg`
- [ ] File gambar ada di `public/uploads/events/`
- [ ] Gambar bisa diakses via URL langsung
- [ ] Cache Laravel sudah di-clear
- [ ] Test upload gambar baru berhasil
- [ ] Gambar muncul di halaman event
- [ ] File `debug-images.php` sudah dihapus (untuk keamanan)

---

## 🎯 Quick Command Reference

```bash
# Navigate to project
cd public_html

# Create folders
mkdir -p public/uploads/{events,qris,certificates,proof_of_payment,products}

# Set permissions
chmod -R 775 public/uploads
chmod -R 775 storage
chmod -R 775 bootstrap/cache

# Clear cache
php artisan config:clear
php artisan cache:clear
php artisan view:clear

# Check structure
ls -la public/uploads/

# Test PHP
php -v
php artisan --version
```

---

## 📞 Support

Jika masih ada masalah:

1. Screenshot error yang muncul
2. Screenshot hasil `debug-images.php`
3. Cek `storage/logs/laravel.log`
4. Kirim info untuk debugging

---

## 🔒 Keamanan

**Setelah selesai debugging:**

1. **Hapus file `debug-images.php`** dari server
2. Set permission `.env` ke 600
3. Pastikan folder `storage/` tidak bisa diakses public

```bash
# Hapus debug file
rm public/debug-images.php

# Set .env permission
chmod 600 .env
```

---

## 📝 Notes

1. **Path di database** harus relatif: `events/file.jpg`
2. **Di blade template** gunakan: `asset('uploads/' . $event->image)`
3. **URL hasil**: `https://domain.com/uploads/events/file.jpg`
4. **File fisik** ada di: `public/uploads/events/file.jpg`
5. **JANGAN** gunakan `storage:link` di hosting shared

---

**Good luck! 🚀**

*HIMAKOM UYM - Komdigi Division*
