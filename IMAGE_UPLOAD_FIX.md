# Fix Gambar Event Tidak Muncul di Hosting

## Masalah
Gambar event tidak muncul di hosting karena:
1. Folder `public/uploads` tidak ada atau tidak writable
2. Path gambar masih menggunakan symlink `storage/app/public`
3. Permission folder salah

## ✅ Solusi Lengkap

### 1. Buat Folder Upload di Hosting

Via **SSH** atau **File Manager Hostinger**:

```bash
# Masuk ke folder public_html
cd public_html

# Buat folder uploads dan subfolder
mkdir -p public/uploads/events
mkdir -p public/uploads/products
mkdir -p public/uploads/qris
mkdir -p public/uploads/certificates/manual
mkdir -p public/uploads/certificates/generated
mkdir -p public/uploads/certificates/batch
mkdir -p public/uploads/proof_of_payment

# Set permission
chmod -R 775 public/uploads
```

### 2. Verifikasi Struktur Folder

Pastikan struktur folder seperti ini:

```
public_html/
├── public/
│   └── uploads/           ← Folder ini harus ada!
│       ├── events/        ← Gambar event disimpan di sini
│       ├── products/      ← Gambar produk
│       ├── qris/          ← Gambar QRIS
│       ├── certificates/  ← Sertifikat
│       └── proof_of_payment/
├── app/
├── config/
└── ...
```

### 3. Cek Konfigurasi Filesystem

File: `config/filesystems.php`

Pastikan ada konfigurasi ini:

```php
'default' => env('FILESYSTEM_DISK', 'public_direct'),

'disks' => [
    'public_direct' => [
        'driver' => 'local',
        'root' => public_path('uploads'),
        'url' => env('APP_URL').'/uploads',
        'visibility' => 'public',
    ],
],
```

### 4. Cek File .env di Hosting

Pastikan `APP_URL` sudah benar:

```env
APP_URL=https://yourdomain.com
```

**JANGAN** ada trailing slash!

### 5. Upload Gambar Test

1. Login ke admin panel
2. Buat event baru
3. Upload gambar
4. Cek apakah file masuk ke `public/uploads/events/`

### 6. Verifikasi Path Gambar

Gambar harus bisa diakses via URL:
```
https://yourdomain.com/uploads/events/nama-file.jpg
```

Buka URL tersebut di browser, jika gambar muncul = berhasil!

---

## 🔧 Troubleshooting

### Gambar Masih Tidak Muncul

#### A. Cek Permission Folder

```bash
# Via SSH
ls -la public/uploads/

# Seharusnya:
# drwxrwxr-x  events
# drwxrwxr-x  products
# dll
```

Jika permission salah:
```bash
chmod -R 775 public/uploads
chown -R username:username public/uploads
```

#### B. Cek Path di Database

```sql
-- Cek path gambar di database
SELECT id, title, image FROM events LIMIT 5;

-- Path yang BENAR:
-- events/nama-file.jpg

-- Path yang SALAH:
-- storage/events/nama-file.jpg
-- /uploads/events/nama-file.jpg
```

#### C. Update Path Gambar Lama

Jika ada gambar lama dengan path salah:

```sql
-- Hapus prefix 'storage/' jika ada
UPDATE events 
SET image = REPLACE(image, 'storage/', '') 
WHERE image LIKE 'storage/%';

-- Hapus prefix '/uploads/' jika ada
UPDATE events 
SET image = REPLACE(image, '/uploads/', '') 
WHERE image LIKE '/uploads/%';
```

#### D. Clear Cache

```bash
php artisan config:clear
php artisan cache:clear
php artisan view:clear
```

#### E. Cek Error Log

File: `storage/logs/laravel.log`

Cari error terkait file upload atau permission.

---

## 📋 Checklist

- [ ] Folder `public/uploads/events` sudah dibuat
- [ ] Permission folder 775 atau 755
- [ ] File `.env` APP_URL sudah benar
- [ ] Config `filesystems.php` menggunakan `public_direct`
- [ ] Test upload gambar baru berhasil
- [ ] Gambar bisa diakses via URL langsung
- [ ] Path di database tidak ada prefix `storage/`
- [ ] Cache sudah di-clear

---

## 🎯 Quick Fix Script

Jalankan script ini via SSH:

```bash
#!/bin/bash

echo "=== Fix Image Upload ==="

# Buat folder
mkdir -p public/uploads/events
mkdir -p public/uploads/products
mkdir -p public/uploads/qris
mkdir -p public/uploads/certificates/manual
mkdir -p public/uploads/certificates/generated
mkdir -p public/uploads/certificates/batch

# Set permission
chmod -R 775 public/uploads

# Clear cache
php artisan config:clear
php artisan cache:clear
php artisan view:clear

echo "=== Done! ==="
echo "Test upload gambar baru di admin panel"
```

---

## 📸 Cara Upload Gambar yang Benar

### Via Admin Panel:
1. Login ke admin
2. Events > Tambah Event
3. Upload gambar (max 2MB, format: jpg, png, jpeg)
4. Simpan
5. Cek di halaman event apakah gambar muncul

### Via FTP/File Manager:
1. Upload gambar ke `public/uploads/events/`
2. Rename file (contoh: `workshop-ml-2024.jpg`)
3. Update database:
   ```sql
   UPDATE events 
   SET image = 'events/workshop-ml-2024.jpg' 
   WHERE id = 1;
   ```

---

## ⚠️ PENTING!

1. **JANGAN** gunakan `php artisan storage:link` di hosting
2. **JANGAN** simpan gambar di `storage/app/public`
3. **SELALU** simpan di `public/uploads`
4. **Path di database** harus relatif: `events/file.jpg` bukan `/uploads/events/file.jpg`

---

## 📞 Masih Bermasalah?

1. Screenshot error yang muncul
2. Cek `storage/logs/laravel.log`
3. Cek permission folder dengan `ls -la`
4. Pastikan APP_URL di .env sudah benar
5. Test akses gambar langsung via URL
