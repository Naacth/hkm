# 🔧 Solusi: Gambar Event Error/Tidak Muncul di Hosting

## 📋 Masalah

Gambar event tidak muncul saat di-hosting, muncul error 404. Dari DevTools terlihat:
- Request `event-1764696907.jpg` mengembalikan **404 Not Found**
- Placeholder image juga gagal load

## 🔍 Penyebab

1. **Path di database tidak lengkap**: Path disimpan sebagai `event-xxx.jpg` tanpa folder `events/`
2. **URL yang dihasilkan salah**: Menjadi `https://domain.com/uploads/event-xxx.jpg` (seharusnya `uploads/events/event-xxx.jpg`)

## ✅ Solusi yang Sudah Diterapkan

### 1. Accessor di Model Event

Ditambahkan accessor `image_url` dan `qris_image_url` di `app/Models/Event.php` yang:
- ✅ Otomatis menambahkan folder `events/` jika path tidak lengkap
- ✅ Handle berbagai format path yang salah
- ✅ Memastikan URL selalu benar

### 2. Update View

View `event.blade.php` dan `home.blade.php` sudah diupdate untuk menggunakan:
```blade
{{ $event->image_url }}  <!-- ✅ Menggunakan accessor -->
```

Bukan lagi:
```blade
{{ asset('uploads/'.$event->image) }}  <!-- ❌ Bisa error jika path tidak lengkap -->
```

### 3. Script SQL untuk Fix Database

File `FIX_EVENT_IMAGE_PATHS.sql` berisi query untuk:
- ✅ Memperbaiki path yang tidak lengkap di database
- ✅ Menambahkan prefix `events/` pada path yang hanya nama file
- ✅ Membersihkan prefix yang salah (`storage/`, `/uploads/`, dll)

## 🚀 Langkah-Langkah Perbaikan

### Step 1: Fix Path di Database

**Via phpMyAdmin:**
1. Login ke phpMyAdmin
2. Pilih database project
3. Klik tab **SQL**
4. Copy-paste isi file `FIX_EVENT_IMAGE_PATHS.sql`
5. Klik **Go** / **Jalankan**

**Via SSH:**
```bash
mysql -u username -p database_name < FIX_EVENT_IMAGE_PATHS.sql
```

### Step 2: Pastikan File Gambar Ada di Server

**Cek apakah file ada:**
```bash
cd public_html/public/uploads/events
ls -la
```

**Jika file tidak ada, upload via FTP:**
1. Buka FileZilla atau FTP client
2. Connect ke hosting
3. Upload semua file dari `public/uploads/events/` (lokal) ke `public/uploads/events/` (hosting)

### Step 3: Pastikan Folder Ada

**Via SSH:**
```bash
cd public_html/public
mkdir -p uploads/events
chmod -R 775 uploads
```

### Step 4: Clear Cache Laravel

```bash
cd public_html
php artisan config:clear
php artisan cache:clear
php artisan view:clear
```

### Step 5: Test

1. Buka halaman event: `https://himakomuym.web.id/event`
2. Cek apakah gambar muncul
3. Inspect element (F12) → Network tab
4. Pastikan request gambar mengembalikan **200 OK**, bukan 404

## 📊 Format Path yang Benar

### Di Database:
```
events/event-1764696907.jpg  ✅ BENAR
event-1764696907.jpg         ❌ SALAH (akan otomatis diperbaiki oleh accessor)
```

### URL yang Dihasilkan:
```
https://himakomuym.web.id/uploads/events/event-1764696907.jpg  ✅
```

### File Fisik:
```
public/uploads/events/event-1764696907.jpg  ✅
```

## 🔍 Verifikasi

### 1. Cek Path di Database
```sql
SELECT id, title, image FROM events WHERE image IS NOT NULL LIMIT 10;
```

**Harus terlihat:**
```
image: events/event-xxx.jpg
```

### 2. Test URL Langsung
Buka browser, akses:
```
https://himakomuym.web.id/uploads/events/event-1764696907.jpg
```

**Jika gambar muncul** = ✅ Path benar!

### 3. Test di Halaman Event
1. Buka: `https://himakomuym.web.id/event`
2. Cek apakah semua gambar event muncul
3. Inspect element → lihat URL gambar di Network tab

## 🛠️ Troubleshooting

### Masalah: Gambar Masih 404

**Solusi:**
1. Pastikan file ada di `public/uploads/events/`
2. Pastikan path di database sudah benar (ada prefix `events/`)
3. Clear cache Laravel
4. Cek permission folder (harus 775)

### Masalah: Gambar Broken (Icon X)

**Solusi:**
1. Cek console browser (F12) untuk error
2. Pastikan APP_URL di `.env` benar
3. Pastikan menggunakan `$event->image_url` di view

### Masalah: Upload Gambar Baru Gagal

**Solusi:**
```bash
# Set permission
chmod -R 775 public/uploads
chmod -R 775 storage
```

## 📝 Catatan Penting

1. **Accessor otomatis handle path**: Sekarang tidak perlu khawatir path tidak lengkap, accessor akan otomatis memperbaikinya
2. **Gunakan `$event->image_url`**: Selalu gunakan accessor, jangan langsung `asset('uploads/'.$event->image)`
3. **Path di database**: Harus format `events/event-xxx.jpg` (tanpa prefix `uploads/`)
4. **File fisik**: Harus ada di `public/uploads/events/event-xxx.jpg`

## ✅ Checklist

Sebelum selesai, pastikan:
- [ ] Path di database sudah benar (ada prefix `events/`)
- [ ] File gambar ada di `public/uploads/events/`
- [ ] Permission folder 775
- [ ] Cache Laravel sudah di-clear
- [ ] Gambar muncul di halaman event
- [ ] Test upload gambar baru berhasil

---

**Good luck! 🚀**

*HIMAKOM UYM - Komdigi Division*

