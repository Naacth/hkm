-- ============================================
-- Fix Event Image Paths - Quick Fix
-- HIMAKOM UYM - Perbaikan Path Gambar Event
-- ============================================
-- Script ini akan memperbaiki path gambar event yang tidak lengkap
-- Path yang benar: events/event-xxx.jpg
-- Path yang salah: event-xxx.jpg (tanpa folder events/)

-- ============================================
-- 1. CEK PATH SAAT INI
-- ============================================
-- Jalankan query ini dulu untuk melihat kondisi path saat ini

SELECT 
    id, 
    title, 
    image,
    CASE 
        WHEN image IS NULL THEN 'NO IMAGE'
        WHEN image LIKE 'events/%' THEN '✓ CORRECT'
        WHEN image LIKE 'event-%' THEN '✗ MISSING FOLDER (perlu fix)'
        WHEN image LIKE 'storage/%' THEN '✗ WRONG (storage/)'
        WHEN image LIKE '/uploads/%' THEN '✗ WRONG (/uploads/)'
        WHEN image LIKE 'uploads/%' THEN '✗ WRONG (uploads/)'
        ELSE '? UNKNOWN'
    END AS status_path
FROM events
WHERE image IS NOT NULL
ORDER BY id DESC;

-- ============================================
-- 2. FIX PATH GAMBAR EVENT
-- ============================================

-- Fix: Tambahkan prefix 'events/' jika path hanya nama file (tanpa folder)
-- Contoh: event-1764696907.jpg -> events/event-1764696907.jpg
UPDATE events 
SET image = CONCAT('events/', image)
WHERE image IS NOT NULL 
  AND image NOT LIKE 'events/%' 
  AND image NOT LIKE 'storage/%'
  AND image NOT LIKE '/uploads/%'
  AND image NOT LIKE 'uploads/%'
  AND image NOT LIKE 'public/%'
  AND image LIKE 'event-%';

-- Fix: Hapus prefix 'storage/' jika ada
UPDATE events 
SET image = REPLACE(image, 'storage/', '') 
WHERE image LIKE 'storage/%';

-- Fix: Hapus prefix '/uploads/' jika ada
UPDATE events 
SET image = REPLACE(image, '/uploads/', '') 
WHERE image LIKE '/uploads/%';

-- Fix: Hapus prefix 'uploads/' jika bukan 'events/'
UPDATE events 
SET image = REPLACE(image, 'uploads/', '') 
WHERE image LIKE 'uploads/%' 
  AND image NOT LIKE 'events/%';

-- Fix: Hapus prefix 'public/uploads/' jika ada
UPDATE events 
SET image = REPLACE(image, 'public/uploads/', '') 
WHERE image LIKE 'public/uploads/%';

-- ============================================
-- 3. FIX PATH QRIS IMAGE
-- ============================================

-- Fix: Tambahkan prefix 'qris/' jika path hanya nama file
UPDATE events 
SET qris_image_path = CONCAT('qris/', qris_image_path)
WHERE qris_image_path IS NOT NULL 
  AND qris_image_path NOT LIKE 'qris/%' 
  AND qris_image_path NOT LIKE 'storage/%'
  AND qris_image_path NOT LIKE '/uploads/%'
  AND qris_image_path NOT LIKE 'uploads/%'
  AND qris_image_path LIKE 'qris-%';

-- Fix: Hapus prefix yang salah
UPDATE events 
SET qris_image_path = REPLACE(qris_image_path, 'storage/', '') 
WHERE qris_image_path LIKE 'storage/%';

UPDATE events 
SET qris_image_path = REPLACE(qris_image_path, '/uploads/', '') 
WHERE qris_image_path LIKE '/uploads/%';

UPDATE events 
SET qris_image_path = REPLACE(qris_image_path, 'uploads/', '') 
WHERE qris_image_path LIKE 'uploads/%' 
  AND qris_image_path NOT LIKE 'qris/%';

-- ============================================
-- 4. VERIFIKASI HASIL
-- ============================================
-- Jalankan query ini setelah fix untuk memastikan semua path sudah benar

SELECT 
    id, 
    title, 
    image,
    CASE 
        WHEN image IS NULL THEN 'NO IMAGE'
        WHEN image LIKE 'events/%' THEN '✓ CORRECT'
        ELSE '✗ STILL WRONG'
    END AS status_path
FROM events
WHERE image IS NOT NULL
ORDER BY id DESC;

-- ============================================
-- 5. STATISTIK
-- ============================================
-- Lihat statistik path gambar

SELECT 
    'Total Events' as label,
    COUNT(*) as total,
    SUM(CASE WHEN image IS NOT NULL THEN 1 ELSE 0 END) as with_image,
    SUM(CASE WHEN image LIKE 'events/%' THEN 1 ELSE 0 END) as correct_path,
    SUM(CASE WHEN image IS NOT NULL AND image NOT LIKE 'events/%' THEN 1 ELSE 0 END) as wrong_path
FROM events;

-- ============================================
-- CATATAN PENTING:
-- ============================================
-- 1. Path di database HARUS: events/event-xxx.jpg (tanpa prefix uploads/)
-- 2. Di view gunakan: $event->image_url (accessor otomatis handle path)
-- 3. URL hasil: https://domain.com/uploads/events/event-xxx.jpg
-- 4. File fisik: public/uploads/events/event-xxx.jpg
-- ============================================

