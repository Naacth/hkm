# 🚨 Solusi: File Gambar Event Hilang (404 Error)

## 🔍 Masalah yang Terjadi

URL sudah benar: `https://himakomuym.web.id/uploads/events/event-1765162704.jpg`
Tapi masih **404 Not Found** karena **file tidak ada di server hosting**.

## ✅ Langkah-Langkah Perbaikan

### Step 1: Cek File yang Hilang

**Via Browser:**
1. Upload file `public/check-event-images.php` ke hosting
2. Edit file tersebut, isi kredensial database:
   ```php
   $dbname = 'nama_database_anda';
   $username = 'username_database';
   $password = 'password_database';
   ```
3. Akses: `https://himakomuym.web.id/check-event-images.php`
4. Lihat daftar file yang hilang

**Via SSH (Alternatif):**
```bash
cd public_html/public/uploads/events
ls -la
```

### Step 2: Upload File Gambar ke Hosting

**Opsi A: Via FTP (FileZilla)**
1. Buka FileZilla
2. Connect ke hosting
3. Navigate ke: `public_html/public/uploads/events/`
4. Upload semua file dari folder lokal: `public/uploads/events/`

**Opsi B: Via File Manager Hostinger**
1. Login ke Hostinger
2. Buka File Manager
3. Navigate ke: `public_html/public/uploads/events/`
4. Klik **Upload**
5. Pilih semua file gambar dari folder lokal
6. Upload

**Opsi C: Via SSH (scp)**
```bash
# Dari komputer lokal
scp public/uploads/events/*.jpg username@hosting:/path/to/public_html/public/uploads/events/
scp public/uploads/events/*.png username@hosting:/path/to/public_html/public/uploads/events/
```

### Step 3: Pastikan Folder Ada dan Permission Benar

**Via SSH:**
```bash
cd public_html/public
mkdir -p uploads/events
chmod -R 775 uploads
```

**Via File Manager:**
1. Pastikan folder `public/uploads/events/` ada
2. Set permission folder ke **775**

### Step 4: Fix .htaccess (SUDAH DIPERBAIKI)

File `public/.htaccess` sudah diperbaiki untuk memastikan folder `uploads` bisa diakses langsung.

**Jika masih error, cek apakah ada rule lain yang memblokir:**

```apache
# Pastikan ada rule ini di .htaccess
RewriteCond %{REQUEST_URI} ^/uploads/ [NC]
RewriteCond %{REQUEST_FILENAME} -f
RewriteRule ^ - [L]
```

### Step 5: Fix Path di Database (Jika Perlu)

Jika path di database tidak lengkap, jalankan SQL:

```sql
-- Cek path saat ini
SELECT id, title, image FROM events WHERE image IS NOT NULL;

-- Fix path yang tidak lengkap
UPDATE events 
SET image = CONCAT('events/', image)
WHERE image IS NOT NULL 
  AND image NOT LIKE 'events/%' 
  AND image LIKE 'event-%';
```

Atau jalankan file: `FIX_EVENT_IMAGE_PATHS.sql`

### Step 6: Clear Cache

```bash
cd public_html
php artisan config:clear
php artisan cache:clear
php artisan view:clear
```

### Step 7: Test

1. Buka: `https://himakomuym.web.id/event`
2. Cek apakah gambar muncul
3. Inspect element (F12) → Network tab
4. Pastikan request gambar mengembalikan **200 OK**

## 🔍 Verifikasi

### 1. Test URL Langsung
Buka browser, akses:
```
https://himakomuym.web.id/uploads/events/event-1765162704.jpg
```

**Jika gambar muncul** = ✅ File ada!
**Jika 404** = ❌ File belum di-upload

### 2. Cek File di Server
```bash
cd public_html/public/uploads/events
ls -la | grep event-1765162704
```

**Jika file ada** = ✅
**Jika tidak ada** = ❌ Perlu upload

### 3. Cek Permission
```bash
ls -la public/uploads/events/
```

**Harus terlihat:**
```
drwxrwxr-x  events/
-rw-r--r--  event-xxx.jpg
```

## 🛠️ Troubleshooting

### Masalah: File Sudah Di-upload Tapi Masih 404

**Penyebab:**
- Path salah
- Permission salah
- .htaccess memblokir

**Solusi:**
```bash
# Cek file benar-benar ada
ls -la public/uploads/events/event-1765162704.jpg

# Cek permission
chmod 644 public/uploads/events/event-1765162704.jpg
chmod 755 public/uploads/events/

# Test akses langsung
curl -I https://himakomuym.web.id/uploads/events/event-1765162704.jpg
```

### Masalah: Upload Gagal

**Penyebab:**
- Folder tidak writable
- Disk space penuh
- PHP upload limit

**Solusi:**
```bash
# Set permission
chmod -R 775 public/uploads
chown -R username:username public/uploads

# Cek disk space
df -h

# Cek PHP limits
php -i | grep upload_max_filesize
```

### Masalah: File Ada Tapi Tidak Bisa Diakses

**Penyebab:**
- .htaccess salah
- Web server config salah

**Solusi:**
1. Cek `.htaccess` di folder `public/`
2. Pastikan rule untuk `uploads/` ada
3. Test dengan file lain (misal: `logo-himakom.png`)

## 📋 Checklist

Sebelum selesai, pastikan:
- [ ] File gambar sudah di-upload ke `public/uploads/events/` di hosting
- [ ] Folder `public/uploads/events/` ada dan permission 775
- [ ] File `.htaccess` sudah diperbaiki (rule untuk uploads/)
- [ ] Path di database sudah benar (format: `events/event-xxx.jpg`)
- [ ] Cache Laravel sudah di-clear
- [ ] Test URL langsung gambar berhasil (200 OK)
- [ ] Gambar muncul di halaman event
- [ ] File `check-event-images.php` sudah dihapus (keamanan)

## 🎯 Quick Fix Command

```bash
# 1. Buat folder jika belum ada
mkdir -p public/uploads/events

# 2. Set permission
chmod -R 775 public/uploads

# 3. Upload file (via FTP atau scp)
# ... upload semua file dari public/uploads/events/ ...

# 4. Clear cache
php artisan config:clear
php artisan cache:clear
php artisan view:clear

# 5. Test
curl -I https://himakomuym.web.id/uploads/events/event-1765162704.jpg
```

## ⚠️ Catatan Penting

1. **File harus ada di server**: Accessor hanya memperbaiki URL, tidak membuat file
2. **Upload semua file**: Pastikan semua file gambar dari lokal di-upload ke hosting
3. **Backup dulu**: Sebelum upload, backup file yang sudah ada di hosting
4. **Hapus script debug**: Setelah selesai, hapus `check-event-images.php` untuk keamanan

---

**Good luck! 🚀**

*HIMAKOM UYM - Komdigi Division*

