# Sistem Generator Sertifikat HIMAKOM

## Fitur Baru

### 1. Status "Sudah Bayar" ✅
- **Masalah yang diperbaiki:** Status belum berubah ketika admin mengupdate ke "Sudah Bayar"
- **Solusi:** Menambahkan status `'paid'` ke validator di `EventRegistrationController`
- **Cara kerja:** Status "Sudah Bayar" muncul ketika `status = 'confirmed'` dan `payment_status = 'paid'`

### 2. Generator Sertifikat Personal ✅
- **Masalah yang diperbaiki:** Template sertifikat sama untuk semua peserta
- **Solusi:** Sistem generator sertifikat dengan nama peserta yang sesuai
- **Fitur:**
  - Nama peserta ditampilkan di sertifikat
  - Nama file download sesuai dengan nama peserta
  - Fallback ke template jika generator gagal
  - Font otomatis menggunakan sistem font yang tersedia

## Cara Penggunaan

### Untuk Admin:
1. **Upload Template Sertifikat:**
   - Buka halaman edit event
   - Upload file template sertifikat (JPG, PNG, PDF)
   - Template akan digunakan sebagai dasar untuk semua sertifikat

2. **Kelola Status Pendaftaran:**
   - Buka halaman "Kelola Pendaftaran Event"
   - Pilih peserta yang sudah dikonfirmasi dan sudah bayar
   - Ubah status ke "Sudah Bayar" dari dropdown

### Untuk Peserta:
1. **Download Sertifikat:**
   - Login ke akun peserta
   - Buka halaman "Sertifikat Saya"
   - Klik download untuk event yang sudah dihadiri
   - File akan terdownload dengan nama: `Sertifikat_[Nama]_[Event].png`

## Teknis

### File yang Diperbarui:
- `app/Http/Controllers/EventRegistrationController.php` - Validator status
- `app/Http/Controllers/EventController.php` - Generator sertifikat
- `app/Services/CertificateGeneratorService.php` - Service generator
- `app/Console/Commands/CleanupCertificatesCommand.php` - Command cleanup
- `app/Models/EventRegistration.php` - Method status efektif
- Semua view admin untuk status baru

### Library yang Digunakan:
- **Intervention Image** - Untuk manipulasi gambar dan text overlay

### Command yang Tersedia:
```bash
# Membersihkan sertifikat lama (default 7 hari)
php artisan certificates:cleanup

# Membersihkan sertifikat lebih dari 30 hari
php artisan certificates:cleanup --days=30
```

### Struktur File:
```
storage/app/public/
├── certificates/
│   ├── templates/          # Template yang diupload admin
│   └── generated/          # Sertifikat yang di-generate
```

## Troubleshooting

### Jika Font Tidak Muncul:
- Sistem akan otomatis mencari font di:
  - Windows: `C:\Windows\Fonts\arial.ttf`
  - Mac: `/System/Library/Fonts/Arial.ttf`
  - Linux: `/usr/share/fonts/truetype/dejavu/DejaVuSans.ttf`

### Jika Generator Gagal:
- Sistem akan fallback ke template asli
- Periksa log error untuk detail masalah
- Pastikan template file ada dan dapat dibaca

### Performance:
- Sertifikat di-generate on-demand saat download
- File lama otomatis dibersihkan dengan command cleanup
- Direkomendasikan menjalankan cleanup command secara berkala
