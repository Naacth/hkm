-- ============================================
-- Fix Image Paths in Database
-- HIMAKOM UYM - Hosting Image Path Fix
-- ============================================

-- Backup data sebelum update (optional)
-- CREATE TABLE events_backup AS SELECT * FROM events;

-- ============================================
-- 1. CHECK CURRENT IMAGE PATHS
-- ============================================

-- Lihat semua path gambar yang ada
SELECT id, title, image, 
    CASE 
        WHEN image IS NULL THEN 'NO IMAGE'
        WHEN image LIKE 'storage/%' THEN 'WRONG: storage/'
        WHEN image LIKE '/uploads/%' THEN 'WRONG: /uploads/'
        WHEN image LIKE 'uploads/%' AND image NOT LIKE 'events/%' THEN 'WRONG: uploads/'
        WHEN image LIKE 'events/%' THEN 'CORRECT'
        ELSE 'UNKNOWN'
    END AS path_status
FROM events
ORDER BY id DESC
LIMIT 20;

-- ============================================
-- 2. FIX IMAGE PATHS
-- ============================================

-- Fix path yang dimulai dengan 'storage/'
UPDATE events 
SET image = REPLACE(image, 'storage/', '') 
WHERE image LIKE 'storage/%';

-- Fix path yang dimulai dengan '/uploads/'
UPDATE events 
SET image = REPLACE(image, '/uploads/', '') 
WHERE image LIKE '/uploads/%';

-- Fix path yang dimulai dengan 'uploads/' tapi bukan 'events/'
UPDATE events 
SET image = REPLACE(image, 'uploads/', '') 
WHERE image LIKE 'uploads/%' 
AND image NOT LIKE 'events/%';

-- Fix path yang dimulai dengan 'public/uploads/'
UPDATE events 
SET image = REPLACE(image, 'public/uploads/', '') 
WHERE image LIKE 'public/uploads/%';

-- ============================================
-- 3. FIX QRIS IMAGE PATHS
-- ============================================

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
-- 4. FIX CERTIFICATE TEMPLATE PATHS
-- ============================================

UPDATE events 
SET certificate_template = REPLACE(certificate_template, 'storage/', '') 
WHERE certificate_template LIKE 'storage/%';

UPDATE events 
SET certificate_template = REPLACE(certificate_template, '/uploads/', '') 
WHERE certificate_template LIKE '/uploads/%';

UPDATE events 
SET certificate_template = REPLACE(certificate_template, 'uploads/', '') 
WHERE certificate_template LIKE 'uploads/%' 
AND certificate_template NOT LIKE 'certificates/%';

-- ============================================
-- 5. FIX PRODUCT IMAGE PATHS (if exists)
-- ============================================

-- Check if products table exists
-- SELECT COUNT(*) FROM information_schema.tables 
-- WHERE table_schema = DATABASE() 
-- AND table_name = 'products';

-- If products table exists, run these:
UPDATE products 
SET image = REPLACE(image, 'storage/', '') 
WHERE image LIKE 'storage/%';

UPDATE products 
SET image = REPLACE(image, '/uploads/', '') 
WHERE image LIKE '/uploads/%';

UPDATE products 
SET image = REPLACE(image, 'uploads/', '') 
WHERE image LIKE 'uploads/%' 
AND image NOT LIKE 'products/%';

-- ============================================
-- 6. FIX GALLERY IMAGE PATHS (if exists)
-- ============================================

UPDATE galleries 
SET image = REPLACE(image, 'storage/', '') 
WHERE image LIKE 'storage/%';

UPDATE galleries 
SET image = REPLACE(image, '/uploads/', '') 
WHERE image LIKE '/uploads/%';

UPDATE galleries 
SET image = REPLACE(image, 'uploads/', '') 
WHERE image LIKE 'uploads/%' 
AND image NOT LIKE 'galleries/%';

-- ============================================
-- 7. FIX EVENT REGISTRATION CERTIFICATE PATHS
-- ============================================

UPDATE event_registrations 
SET certificate_path = REPLACE(certificate_path, 'storage/', '') 
WHERE certificate_path LIKE 'storage/%';

UPDATE event_registrations 
SET certificate_path = REPLACE(certificate_path, '/uploads/', '') 
WHERE certificate_path LIKE '/uploads/%';

UPDATE event_registrations 
SET certificate_path = REPLACE(certificate_path, 'uploads/', '') 
WHERE certificate_path LIKE 'uploads/%' 
AND certificate_path NOT LIKE 'certificates/%';

-- ============================================
-- 8. FIX PROOF OF PAYMENT PATHS
-- ============================================

UPDATE event_registrations 
SET proof_of_payment = REPLACE(proof_of_payment, 'storage/', '') 
WHERE proof_of_payment LIKE 'storage/%';

UPDATE event_registrations 
SET proof_of_payment = REPLACE(proof_of_payment, '/uploads/', '') 
WHERE proof_of_payment LIKE '/uploads/%';

UPDATE event_registrations 
SET proof_of_payment = REPLACE(proof_of_payment, 'uploads/', '') 
WHERE proof_of_payment LIKE 'uploads/%' 
AND proof_of_payment NOT LIKE 'proof_of_payment/%';

-- ============================================
-- 9. VERIFY RESULTS
-- ============================================

-- Check events table
SELECT 'EVENTS' as table_name, 
    COUNT(*) as total_records,
    COUNT(image) as with_image,
    SUM(CASE WHEN image LIKE 'events/%' THEN 1 ELSE 0 END) as correct_path,
    SUM(CASE WHEN image LIKE 'storage/%' OR image LIKE '/uploads/%' OR image LIKE 'uploads/%' THEN 1 ELSE 0 END) as wrong_path
FROM events

UNION ALL

-- Check products table
SELECT 'PRODUCTS' as table_name,
    COUNT(*) as total_records,
    COUNT(image) as with_image,
    SUM(CASE WHEN image LIKE 'products/%' THEN 1 ELSE 0 END) as correct_path,
    SUM(CASE WHEN image LIKE 'storage/%' OR image LIKE '/uploads/%' OR image LIKE 'uploads/%' THEN 1 ELSE 0 END) as wrong_path
FROM products

UNION ALL

-- Check galleries table
SELECT 'GALLERIES' as table_name,
    COUNT(*) as total_records,
    COUNT(image) as with_image,
    SUM(CASE WHEN image LIKE 'galleries/%' THEN 1 ELSE 0 END) as correct_path,
    SUM(CASE WHEN image LIKE 'storage/%' OR image LIKE '/uploads/%' OR image LIKE 'uploads/%' THEN 1 ELSE 0 END) as wrong_path
FROM galleries;

-- ============================================
-- 10. SAMPLE CORRECT PATHS
-- ============================================

-- Events should look like this:
-- image: 'events/event-1733123456.jpg'
-- qris_image_path: 'qris/qris-1733123456.jpg'
-- certificate_template: 'certificates/cert-1733123456.jpg'

-- Products should look like this:
-- image: 'products/product-1733123456.jpg'

-- Galleries should look like this:
-- image: 'galleries/gallery-1733123456.jpg'

-- Event Registrations should look like this:
-- certificate_path: 'certificates/generated/cert-123.png'
-- proof_of_payment: 'proof_of_payment/payment-123.jpg'

-- ============================================
-- NOTES:
-- ============================================
-- 1. Path di database HARUS relatif tanpa prefix /uploads/
-- 2. Di blade template gunakan: asset('uploads/' . $event->image)
-- 3. Hasil URL: https://domain.com/uploads/events/event-123.jpg
-- 4. File fisik ada di: public/uploads/events/event-123.jpg
-- ============================================
