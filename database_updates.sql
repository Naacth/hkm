-- ============================================
-- SQL Script untuk Update Database di Hosting
-- ============================================

-- 1. Tambah kolom registration_start_date dan registration_end_date ke tabel events
ALTER TABLE `events` 
ADD COLUMN `registration_start_date` DATETIME NULL AFTER `date`,
ADD COLUMN `registration_end_date` DATETIME NULL AFTER `registration_start_date`;

-- 2. Tambah kolom certificate_path ke tabel event_registrations (jika belum ada)
-- Cek dulu apakah kolom sudah ada, jika belum jalankan query ini:
ALTER TABLE `event_registrations` 
ADD COLUMN `certificate_path` VARCHAR(255) NULL AFTER `payment_method`;

-- ============================================
-- Verifikasi Kolom Sudah Ditambahkan
-- ============================================

-- Cek struktur tabel events
DESCRIBE `events`;

-- Cek struktur tabel event_registrations
DESCRIBE `event_registrations`;

-- ============================================
-- Query untuk Cek Data (Optional)
-- ============================================

-- Lihat semua events dengan registration dates
SELECT id, title, date, registration_start_date, registration_end_date, status 
FROM events 
ORDER BY date DESC;

-- Lihat event registrations dengan certificate_path
SELECT id, registration_number, participant_name, certificate_path, status 
FROM event_registrations 
ORDER BY created_at DESC 
LIMIT 10;
