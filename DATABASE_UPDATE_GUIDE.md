# Panduan Update Database di Hosting

## Persiapan

### 1. Backup Database Dulu!
**PENTING:** Selalu backup database sebelum update!

Di **phpMyAdmin Hostinger**:
1. Pilih database Anda
2. Klik tab **Export**
3. Pilih **Quick** export method
4. Klik **Go**
5. Simpan file `.sql` yang didownload

---

## Cara Menjalankan SQL Script

### Metode 1: Via phpMyAdmin (Recommended)

1. **Login ke phpMyAdmin** di Hostinger
2. **Pilih database** yang digunakan aplikasi
3. Klik tab **SQL**
4. **Copy-paste** isi file `database_updates.sql` atau `COMPLETE_DATABASE_UPDATES.sql`
5. Klik **Go** untuk execute
6. Cek hasilnya di tab **Structure**

### Metode 2: Via SSH (Advanced)

```bash
# Login ke SSH Hostinger
ssh username@your-domain.com

# Masuk ke folder project
cd public_html

# Import SQL file
mysql -u username -p database_name < database_updates.sql
```

---

## Script SQL yang Perlu Dijalankan

### Update Minimal (Hanya Registration Dates)

```sql
-- Tambah kolom registration dates
ALTER TABLE `events` 
ADD COLUMN `registration_start_date` DATETIME NULL AFTER `date`,
ADD COLUMN `registration_end_date` DATETIME NULL AFTER `registration_start_date`;

-- Tambah kolom certificate_path
ALTER TABLE `event_registrations` 
ADD COLUMN `certificate_path` VARCHAR(255) NULL AFTER `payment_method`;
```

### Update Lengkap

Gunakan file `COMPLETE_DATABASE_UPDATES.sql` untuk update semua kolom yang diperlukan.

---

## Verifikasi Update Berhasil

### 1. Cek Struktur Tabel Events

```sql
DESCRIBE `events`;
```

Pastikan ada kolom:
- ✅ `registration_start_date` (datetime, NULL)
- ✅ `registration_end_date` (datetime, NULL)
- ✅ `cert_x` (int, NULL)
- ✅ `cert_y` (int, NULL)
- ✅ `cert_font_size` (int, NULL)
- ✅ `cert_color` (varchar, NULL)

### 2. Cek Struktur Tabel Event Registrations

```sql
DESCRIBE `event_registrations`;
```

Pastikan ada kolom:
- ✅ `certificate_path` (varchar, NULL)
- ✅ `certificate_downloaded` (tinyint, default 0)

### 3. Test Query

```sql
-- Test select dengan kolom baru
SELECT id, title, registration_start_date, registration_end_date 
FROM events 
LIMIT 5;
```

---

## Troubleshooting

### Error: "Duplicate column name"

**Penyebab:** Kolom sudah ada di database

**Solusi:** Skip query tersebut, lanjut ke query berikutnya

### Error: "Table doesn't exist"

**Penyebab:** Nama tabel salah atau database belum di-migrate

**Solusi:** 
1. Cek nama tabel dengan `SHOW TABLES;`
2. Jalankan migration Laravel: `php artisan migrate`

### Error: "Access denied"

**Penyebab:** User database tidak punya permission

**Solusi:** 
1. Cek user database di Hostinger panel
2. Pastikan user punya privilege ALTER TABLE

---

## Setelah Update Database

### 1. Clear Cache Laravel

```bash
php artisan config:clear
php artisan cache:clear
php artisan view:clear
```

### 2. Test Aplikasi

1. Buka halaman admin
2. Coba buat event baru
3. Cek apakah field registration dates muncul
4. Test pendaftaran event

### 3. Monitor Error Log

Cek error log di Hostinger jika ada masalah:
- File Manager > `storage/logs/laravel.log`
- Atau di Hostinger panel > Error Logs

---

## Rollback (Jika Ada Masalah)

### Hapus Kolom yang Ditambahkan

```sql
-- Rollback events table
ALTER TABLE `events` 
DROP COLUMN `registration_start_date`,
DROP COLUMN `registration_end_date`;

-- Rollback event_registrations table
ALTER TABLE `event_registrations` 
DROP COLUMN `certificate_path`;
```

### Restore dari Backup

1. Di phpMyAdmin, pilih database
2. Klik tab **Import**
3. Choose file: pilih backup `.sql` yang tadi didownload
4. Klik **Go**

---

## Checklist Update

- [ ] Backup database sudah dilakukan
- [ ] SQL script sudah di-copy
- [ ] Execute SQL di phpMyAdmin
- [ ] Verifikasi struktur tabel
- [ ] Test query berhasil
- [ ] Clear cache Laravel
- [ ] Test aplikasi berjalan normal
- [ ] Monitor error log

---

## Kontak Support

Jika ada masalah:
1. Cek error log Laravel
2. Cek error log MySQL di Hostinger
3. Restore dari backup jika perlu
