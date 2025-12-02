# Perbaikan Fitur Custom Sertifikat

## Ringkasan Perbaikan

Fitur custom sertifikat telah diperbaiki dan ditingkatkan dengan fitur-fitur berikut:

### 1. Preview Real-time
- **Fitur Baru**: Preview sertifikat custom yang menampilkan hasil real-time
- **Toggle View**: Tombol untuk beralih antara template asli dan preview custom
- **Auto-update**: Preview otomatis terupdate saat pengguna mengubah pengaturan
- **Debouncing**: Preview diupdate dengan delay 500ms untuk performa yang lebih baik

### 2. Endpoint Preview
- **Route Baru**: `/events/preview-certificate/{registration}`
- **Method**: `EventController@previewCustomCertificate`
- **Fungsi**: Menampilkan preview sertifikat tanpa download

### 3. Validasi Input
- **Validasi Real-time**: Input divalidasi saat pengguna mengetik
- **Validasi Form**: Validasi lengkap sebelum generate sertifikat
- **Error Messages**: Pesan error yang jelas untuk setiap field
- **Range Validation**: Posisi X/Y (0-2000), Font size (20-200)

### 4. UI/UX Improvements
- **Loading States**: Indikator loading saat generate sertifikat
- **Button States**: Tombol disabled saat processing
- **Responsive Design**: UI yang responsif untuk mobile
- **Visual Feedback**: Border merah untuk input yang invalid

### 5. Perbaikan Backend
- **Parameter Validation**: Validasi dan sanitasi parameter input
- **Error Handling**: Error handling yang lebih baik
- **Logging**: Logging detail untuk debugging
- **Fallback Methods**: Fallback ke method basic jika advanced gagal

## Cara Penggunaan

1. **Akses Halaman Custom**: Klik tombol "Custom Sertifikat" di halaman sertifikat
2. **Atur Posisi**: Gunakan slider atau input manual untuk posisi X dan Y
3. **Atur Font**: Sesuaikan ukuran font (20-200)
4. **Pilih Warna**: Pilih warna teks menggunakan color picker
5. **Preview**: Klik "Preview Custom" untuk melihat hasil real-time
6. **Generate**: Klik "Generate & Download" untuk download sertifikat

## Preset Posisi

- **Tengah**: X=700, Y=500, Font=64
- **Atas**: X=700, Y=300, Font=64  
- **Bawah**: X=700, Y=700, Font=64

## Technical Details

### File yang Dimodifikasi:
- `app/Http/Controllers/EventController.php` - Method preview dan generate
- `app/Services/CertificateGeneratorService.php` - Logic generate sertifikat
- `resources/views/certificates/custom.blade.php` - UI dan JavaScript
- `routes/web.php` - Route baru untuk preview

### Dependencies:
- Intervention Image (Imagick/GD)
- Bootstrap 5 untuk UI
- JavaScript vanilla untuk interaksi

### Error Handling:
- Validasi input di frontend dan backend
- Fallback method jika advanced generation gagal
- Logging detail untuk debugging
- User-friendly error messages

## Testing

Untuk test fitur ini:
1. Pastikan ada event dengan template sertifikat
2. Pastikan user sudah terdaftar dan status "attended"
3. Akses halaman custom sertifikat
4. Test preview real-time
5. Test generate dan download
6. Test validasi input

## Notes

- Sertifikat custom hanya menambahkan nama peserta ke template
- Preview menggunakan endpoint terpisah untuk performa yang lebih baik
- File sertifikat disimpan di `storage/app/public/certificates/generated/`
- Sertifikat yang sudah di-custom akan didownload oleh user yang bersangkutan
