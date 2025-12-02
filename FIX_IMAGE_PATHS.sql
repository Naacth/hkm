-- ============================================
-- SQL Script untuk Fix Path Gambar
-- Jalankan di phpMyAdmin jika gambar tidak muncul
-- ============================================

-- ============================================
-- 1. CEK PATH GAMBAR SAAT INI
-- ============================================

-- Lihat path gambar events
SELECT id, title, image, qris_image_path, certificate_template 
FROM events 
WHERE image IS NOT NULL 
LIMIT 10;

-- Lihat path gambar products
SELECT id, name, image 
FROM produks 
WHERE image IS NOT NULL 
LIMIT 10;

-- ============================================
-- 2. FIX PATH EVENTS
-- ============================================

-- Hapus prefix 'storage/' jika ada
UPDATE events 
SET image = REPLACE(image, 'storage/', '') 
WHERE image LIKE 'storage/%';

UPDATE events 
SET qris_image_path = REPLACE(qris_image_path, 'storage/', '') 
WHERE qris_image_path LIKE 'storage/%';

UPDATE events 
SET certificate_template = REPLACE(certificate_template, 'storage/', '') 
WHERE certificate_template LIKE 'storage/%';

-- Hapus prefix '/uploads/' jika ada
UPDATE events 
SET image = REPLACE(image, '/uploads/', '') 
WHERE image LIKE '/uploads/%';

UPDATE events 
SET qris_image_path = REPLACE(qris_image_path, '/uploads/', '') 
WHERE qris_image_path LIKE '/uploads/%';

UPDATE events 
SET certificate_template = REPLACE(certificate_template, '/uploads/', '') 
WHERE certificate_template LIKE '/uploads/%';

-- Tambah prefix 'events/' jika belum ada (untuk gambar event)
UPDATE events 
SET image = CONCAT('events/', image) 
WHERE image IS NOT NULL 
  AND image NOT LIKE 'events/%' 
  AND image NOT LIKE 'storage/%'
  AND image != '';

-- ============================================
-- 3. FIX PATH PRODUCTS
-- ============================================

-- Hapus prefix 'storage/' jika ada
UPDATE produks 
SET image = REPLACE(image, 'storage/', '') 
WHERE image LIKE 'storage/%';

UPDATE produks 
SET qris_image_path = REPLACE(qris_image_path, 'storage/', '') 
WHERE qris_image_path LIKE 'storage/%';

-- Hapus prefix '/uploads/' jika ada
UPDATE produks 
SET image = REPLACE(image, '/uploads/', '') 
WHERE image LIKE '/uploads/%';

UPDATE produks 
SET qris_image_path = REPLACE(qris_image_path, '/uploads/', '') 
WHERE qris_image_path LIKE '/uploads/%';

-- Tambah prefix 'products/' jika belum ada
UPDATE produks 
SET image = CONCAT('products/', image) 
WHERE image IS NOT NULL 
  AND image NOT LIKE 'products/%' 
  AND image NOT LIKE 'storage/%'
  AND image != '';

-- ============================================
-- 4. FIX PATH GALLERY
-- ============================================

-- Hapus prefix 'storage/' jika ada
UPDATE galeris 
SET image = REPLACE(image, 'storage/', '') 
WHERE image LIKE 'storage/%';

-- Hapus prefix '/uploads/' jika ada
UPDATE galeris 
SET image = REPLACE(image, '/uploads/', '') 
WHERE image LIKE '/uploads/%';

-- Tambah prefix 'gallery/' jika belum ada
UPDATE galeris 
SET image = CONCAT('gallery/', image) 
WHERE image IS NOT NULL 
  AND image NOT LIKE 'gallery/%' 
  AND image NOT LIKE 'storage/%'
  AND image != '';

-- ============================================
-- 5. FIX PATH CERTIFICATES
-- ============================================

-- Hapus prefix 'storage/' dari certificate_path
UPDATE event_registrations 
SET certificate_path = REPLACE(certificate_path, 'storage/', '') 
WHERE certificate_path LIKE 'storage/%';

-- Hapus prefix '/uploads/' dari certificate_path
UPDATE event_registrations 
SET certificate_path = REPLACE(certificate_path, '/uploads/', '') 
WHERE certificate_path LIKE '/uploads/%';

-- ============================================
-- 6. VERIFIKASI HASIL
-- ============================================

-- Cek path events setelah fix
SELECT id, title, image, qris_image_path 
FROM events 
WHERE image IS NOT NULL 
LIMIT 10;

-- Cek path products setelah fix
SELECT id, name, image 
FROM produks 
WHERE image IS NOT NULL 
LIMIT 10;

-- Cek path gallery setelah fix
SELECT id, title, image 
FROM galeris 
WHERE image IS NOT NULL 
LIMIT 10;

-- ============================================
-- EXPECTED RESULTS:
-- ============================================
-- Events image: events/nama-file.jpg
-- Products image: products/nama-file.jpg
-- Gallery image: gallery/nama-file.jpg
-- QRIS: qris/nama-file.jpg
-- Certificate: certificates/nama-file.pdf
-- ============================================

-- ============================================
-- NOTES:
-- ============================================
-- 1. Backup database sebelum menjalankan script ini
-- 2. Path yang benar: 'events/file.jpg' BUKAN '/uploads/events/file.jpg'
-- 3. Setelah fix, clear cache Laravel:
--    php artisan config:clear
--    php artisan cache:clear
--    php artisan view:clear
-- ============================================
