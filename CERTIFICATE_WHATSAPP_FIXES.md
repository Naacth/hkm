# Perbaikan Fitur Sertifikat dan Grup WhatsApp

## Masalah yang Diperbaiki

### 1. Masalah Nama Peserta Kosong pada Sertifikat
**Masalah:** Saat user download sertifikat, nama peserta masih kosong atau tidak muncul.

**Solusi:**
- Menambahkan fallback untuk nama peserta di `CertificateGeneratorService.php`
- Jika `participant_name` kosong, akan menggunakan `user->name`
- Jika keduanya kosong, akan menggunakan "Peserta Event" sebagai fallback
- Menambahkan validasi untuk memastikan nama tidak kosong sebelum menambahkan ke sertifikat

### 2. Masalah GD Extension Tidak Tersedia
**Masalah:** Error "GD PHP extension must be installed to use this driver" saat generate sertifikat.

**Solusi:**
- Menambahkan deteksi otomatis ekstensi yang tersedia (Imagick atau GD)
- Membuat fallback method `generateCertificateBasic()` yang menggunakan basic PHP GD functions
- Sistem akan otomatis menggunakan method yang tersedia
- Jika tidak ada ekstensi image processing, akan memberikan error yang jelas

### 3. Support Format File Template
**Fitur Baru:** Sistem sekarang mendukung berbagai format file template:
- **JPG/JPEG:** Template gambar dengan kualitas tinggi
- **PNG:** Template dengan transparansi
- **GIF:** Template animasi (akan diambil frame pertama)
- **PDF:** Template PDF (akan dikonversi ke gambar sederhana)

**Catatan PDF:**
- Untuk template PDF, sistem akan membuat sertifikat sederhana dengan border dan teks
- Tidak memerlukan library PDF khusus, menggunakan basic GD functions
- Hasil akhir tetap berupa file PNG untuk konsistensi

### 4. Perbaikan Kualitas Tulisan Sertifikat
**Fitur Baru:** Tulisan sertifikat sekarang lebih bagus dan mudah dibaca:
- **Font size lebih besar** - Nama peserta menggunakan font 80px+ (sebelumnya 60px)
- **Posisi lebih optimal** - Nama di 35% dari atas, event di 50%, tanggal di 60%
- **Text bold** - Nama peserta dan judul event menggunakan font bold
- **Spacing lebih baik** - Jarak antar elemen lebih proporsional
- **Fallback robust** - Jika advanced method gagal, otomatis ke basic method

### 5. Sistem Pembayaran QRIS dan Manual Approval
**Fitur Baru:** Sistem pembayaran QRIS dengan approval manual oleh admin:

#### **A. Pembayaran QRIS untuk Event:**
- **QRIS Image Upload** - Admin bisa upload gambar QRIS untuk event berbayar
- **QRIS Display** - User melihat QRIS di halaman success registration
- **Payment Details** - Menampilkan detail pembayaran lengkap dengan diskon voucher
- **Manual Approval** - Admin bisa approve/tolak pembayaran secara manual

#### **B. Pembayaran QRIS untuk Produk:**
- **QRIS Image Upload** - Admin bisa upload gambar QRIS untuk produk
- **Order Management** - Admin bisa approve/tolak pesanan produk
- **Status Tracking** - Tracking status pembayaran real-time

#### **C. Admin Payment Management:**
- **Dashboard Menu** - Menu "Kelola Pembayaran" di admin dashboard
- **Payment List** - Daftar pembayaran pending untuk event dan produk
- **One-Click Approval** - Tombol approve/tolak dengan konfirmasi
- **Real-time Updates** - Status pembayaran update real-time

**File yang diubah untuk sistem QRIS:**
- `app/Http/Controllers/Admin/PaymentController.php` (BARU)
  - Method `index()` - daftar pembayaran pending
  - Method `approveEventPayment()` - approve pembayaran event
  - Method `approveProductPayment()` - approve pembayaran produk
  - Method `rejectPayment()` - tolak pembayaran
- `app/Models/Event.php`
  - Method `getQrisUrlAttribute()` - URL QRIS untuk event
- `app/Models/Produk.php`
  - Method `getQrisUrlAttribute()` - URL QRIS untuk produk
- `resources/views/event-registrations/success.blade.php`
  - QRIS payment section dengan detail pembayaran
- `resources/views/admin/payments/index.blade.php` (BARU)
  - Halaman admin untuk kelola pembayaran
- `resources/views/admin-dashboard.blade.php`
  - Menu "Kelola Pembayaran"
- `routes/web.php`
  - Route untuk admin payment management

**File yang diubah:**
- `app/Services/CertificateGeneratorService.php`
  - Method `generateCertificate()`
  - Method `generateCertificateWithCustomPositioning()`
  - Method `testFontGeneration()`

### 2. Fitur Bergabung ke Grup WhatsApp untuk Peserta yang Sudah Bayar
**Masalah:** Semua peserta bisa bergabung ke grup WhatsApp tanpa mempertimbangkan status pembayaran dan pendaftaran.

**Solusi:**
- Menambahkan method `canAccessWhatsAppGroup()` di model `EventRegistration`
- Menambahkan method `joinWhatsAppGroup()` di `EventController`
- Menambahkan route untuk akses grup WhatsApp
- Memperbarui view untuk menampilkan tombol WhatsApp dengan validasi pendaftaran dan pembayaran

**Logika Akses:**
- **Belum Login:** Tombol disabled dengan pesan "Login dan daftar event terlebih dahulu"
- **Sudah Login tapi belum daftar:** Tombol disabled dengan pesan "Daftar event terlebih dahulu"
- **Sudah daftar tapi belum bayar (event berbayar):** Tombol disabled dengan pesan "Selesaikan pembayaran terlebih dahulu"
- **Sudah daftar dan bayar (atau event gratis):** Tombol aktif untuk bergabung ke grup

**File yang diubah:**
- `app/Models/EventRegistration.php` - Method `canAccessWhatsAppGroup()`
- `app/Models/Event.php` - Method `isFree()` diperbaiki
- `app/Http/Controllers/EventController.php` - Method `joinWhatsAppGroup()`
- `routes/web.php` - Route untuk akses grup WhatsApp
- `resources/views/event.blade.php` - Tombol WhatsApp dengan validasi
- `resources/views/event-registrations/history.blade.php` - Tombol WhatsApp dengan validasi
- `resources/views/event-registrations/show.blade.php` - Section grup WhatsApp

## Fitur Baru

### 1. Validasi Pembayaran untuk Grup WhatsApp
- **Event Gratis:** Semua peserta bisa bergabung ke grup WhatsApp
- **Event Berbayar:** Hanya peserta yang sudah membayar yang bisa bergabung
- Tombol WhatsApp akan disabled dengan pesan informatif jika peserta belum membayar

### 2. Fallback Nama Peserta
- Sistem akan otomatis menggunakan nama dari akun user jika `participant_name` kosong
- Jika keduanya kosong, akan menggunakan "Peserta Event" sebagai fallback
- Memastikan sertifikat selalu memiliki nama yang valid

## Cara Penggunaan

### Untuk Admin:
1. Upload template sertifikat saat membuat event
2. Set link grup WhatsApp di form event
3. Pastikan peserta mengisi nama lengkap saat pendaftaran

### Untuk User:
1. Daftar event dengan mengisi nama lengkap
2. Untuk event berbayar, selesaikan pembayaran terlebih dahulu
3. Setelah pembayaran dikonfirmasi, tombol "Grup WhatsApp" akan aktif
4. Download sertifikat setelah event selesai atau status pembayaran dikonfirmasi

## Testing

### Test Sertifikat:
1. Buat event dengan template sertifikat
2. Daftar event dengan nama kosong
3. Download sertifikat - harus menampilkan nama fallback

### Test Grup WhatsApp:
1. Buat event berbayar dengan link grup WhatsApp
2. Daftar event tanpa membayar
3. Cek tombol WhatsApp - harus disabled
4. Setelah pembayaran dikonfirmasi, tombol harus aktif

## Catatan Penting

- Pastikan font tersedia di sistem untuk rendering teks pada sertifikat
- Link grup WhatsApp harus valid dan dapat diakses
- Status pembayaran harus dikonfirmasi oleh admin untuk mengaktifkan akses grup
