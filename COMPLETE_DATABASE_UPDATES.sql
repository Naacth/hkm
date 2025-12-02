-- ============================================
-- COMPLETE DATABASE UPDATES FOR HOSTING
-- Script ini berisi semua update database yang diperlukan
-- Jalankan di phpMyAdmin atau MySQL client di hosting
-- ============================================

-- ============================================
-- 1. UPDATE TABEL EVENTS
-- ============================================

-- Tambah kolom registration dates
ALTER TABLE `events` 
ADD COLUMN `registration_start_date` DATETIME NULL AFTER `date`,
ADD COLUMN `registration_end_date` DATETIME NULL AFTER `registration_start_date`;

-- Tambah kolom certificate settings (jika belum ada)
ALTER TABLE `events` 
ADD COLUMN `cert_x` INT NULL AFTER `certificate_template`,
ADD COLUMN `cert_y` INT NULL AFTER `cert_x`,
ADD COLUMN `cert_font_size` INT NULL AFTER `cert_y`,
ADD COLUMN `cert_color` VARCHAR(7) NULL DEFAULT '#003399' AFTER `cert_font_size`;

-- Tambah kolom event_type (jika belum ada)
ALTER TABLE `events` 
ADD COLUMN `event_type` ENUM('free', 'paid', 'public') DEFAULT 'free' AFTER `status`;

-- ============================================
-- 2. UPDATE TABEL EVENT_REGISTRATIONS
-- ============================================

-- Tambah kolom certificate_path
ALTER TABLE `event_registrations` 
ADD COLUMN `certificate_path` VARCHAR(255) NULL AFTER `payment_method`;

-- Tambah kolom certificate_downloaded (jika belum ada)
ALTER TABLE `event_registrations` 
ADD COLUMN `certificate_downloaded` TINYINT(1) DEFAULT 0 AFTER `certificate_path`;

-- ============================================
-- 3. UPDATE TABEL PRODUCTS (jika ada)
-- ============================================

-- Tambah kolom status ke products (jika belum ada)
ALTER TABLE `produks` 
ADD COLUMN `status` ENUM('active', 'inactive') DEFAULT 'active' AFTER `description`;

-- ============================================
-- 4. VERIFIKASI STRUKTUR TABEL
-- ============================================

-- Cek struktur tabel events
SHOW COLUMNS FROM `events`;

-- Cek struktur tabel event_registrations
SHOW COLUMNS FROM `event_registrations`;

-- Cek struktur tabel produks
SHOW COLUMNS FROM `produks`;

-- ============================================
-- 5. QUERY UNTUK CEK DATA
-- ============================================

-- Lihat events terbaru dengan registration dates
SELECT 
    id, 
    title, 
    date, 
    registration_start_date, 
    registration_end_date, 
    status,
    event_type,
    created_at 
FROM events 
ORDER BY created_at DESC 
LIMIT 10;

-- Lihat event registrations dengan certificate
SELECT 
    id, 
    registration_number, 
    participant_name, 
    status,
    certificate_path,
    certificate_downloaded,
    created_at 
FROM event_registrations 
ORDER BY created_at DESC 
LIMIT 10;

-- ============================================
-- 6. OPTIONAL: SET DEFAULT VALUES
-- ============================================

-- Set default event_type untuk events yang sudah ada
UPDATE `events` 
SET `event_type` = 'free' 
WHERE `event_type` IS NULL AND (`is_paid` = 0 OR `price` IS NULL OR `price` = 0);

UPDATE `events` 
SET `event_type` = 'paid' 
WHERE `event_type` IS NULL AND `is_paid` = 1 AND `price` > 0;

-- ============================================
-- 7. BACKUP REMINDER
-- ============================================
-- PENTING: Backup database sebelum menjalankan script ini!
-- Di phpMyAdmin: Export > Quick > Go
-- ============================================

-- ============================================
-- NOTES:
-- ============================================
-- 1. Jalankan query satu per satu atau semua sekaligus
-- 2. Jika ada error "Duplicate column name", berarti kolom sudah ada (skip query tersebut)
-- 3. Pastikan backup database sudah dilakukan
-- 4. Test di local dulu sebelum apply ke production
-- ============================================
