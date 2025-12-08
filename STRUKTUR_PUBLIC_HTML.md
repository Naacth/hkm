# 📁 Struktur Folder public_html di Hosting

## 🎯 Struktur Umum Laravel di Hosting

Biasanya di hosting shared (seperti Hostinger), struktur folder Laravel di `public_html` adalah:

```
public_html/
├── .env                          # File konfigurasi environment
├── .htaccess                     # Apache rewrite rules (root)
├── index.php                     # Entry point Laravel
├── favicon.ico                   # Favicon
├── robots.txt                    # Robots.txt
│
├── public/                       # Folder public (bisa juga semua file langsung di root)
│   ├── .htaccess                 # Apache rewrite rules untuk public
│   ├── index.php                 # Entry point (jika struktur berbeda)
│   ├── favicon.ico
│   ├── robots.txt
│   │
│   ├── uploads/                  # ⭐ FOLDER UPLOAD GAMBAR
│   │   ├── events/               # ⭐ GAMBAR EVENT ADA DI SINI
│   │   │   ├── event-1765162704.jpg
│   │   │   ├── event-1764696907.jpg
│   │   │   └── ...
│   │   ├── qris/
│   │   ├── certificates/
│   │   ├── products/
│   │   ├── galeris/
│   │   └── ...
│   │
│   ├── build/                    # Assets yang di-compile (Vite)
│   │   ├── assets/
│   │   └── manifest.json
│   │
│   └── logo-himakom.png          # File static lainnya
│
├── app/                          # Application code
├── bootstrap/                    # Bootstrap files
├── config/                       # Configuration files
├── database/                     # Database migrations, seeders
├── resources/                    # Views, CSS, JS source
├── routes/                       # Route definitions
├── storage/                      # Storage (logs, cache, etc)
├── vendor/                       # Composer dependencies
└── ...
```

## 🔍 Dua Kemungkinan Struktur

### **Struktur 1: Semua File di Root public_html**

Ini yang paling umum di Hostinger:

```
public_html/
├── .env
├── .htaccess
├── index.php                     # Entry point
├── favicon.ico
│
├── uploads/                      # ⭐ GAMBAR ADA DI SINI
│   ├── events/                   # ⭐ GAMBAR EVENT
│   │   ├── event-1765162704.jpg
│   │   └── ...
│   ├── qris/
│   └── ...
│
├── build/
├── app/
├── bootstrap/
├── config/
├── database/
├── resources/
├── routes/
├── storage/
└── vendor/
```

**URL untuk gambar:**
```
https://himakomuym.web.id/uploads/events/event-xxx.jpg
```

### **Struktur 2: Ada Folder public/**

Beberapa hosting menggunakan struktur ini:

```
public_html/
├── .env
├── .htaccess
│
├── public/                       # Public folder
│   ├── .htaccess
│   ├── index.php
│   │
│   ├── uploads/                  # ⭐ GAMBAR ADA DI SINI
│   │   ├── events/               # ⭐ GAMBAR EVENT
│   │   │   ├── event-1765162704.jpg
│   │   │   └── ...
│   │   └── ...
│   │
│   └── build/
│
├── app/
├── bootstrap/
├── config/
├── database/
├── resources/
├── routes/
├── storage/
└── vendor/
```

**URL untuk gambar:**
```
https://himakomuym.web.id/public/uploads/events/event-xxx.jpg
```

## 🔍 Cara Cek Struktur di Hosting Anda

### **Via File Manager Hostinger:**

1. Login ke Hostinger
2. Buka **File Manager**
3. Navigate ke `public_html`
4. Lihat apakah ada folder `public/` atau tidak

**Jika ada folder `public/`:**
- Gambar ada di: `public_html/public/uploads/events/`

**Jika TIDAK ada folder `public/`:**
- Gambar ada di: `public_html/uploads/events/`

### **Via SSH:**

```bash
# Masuk ke public_html
cd public_html

# Lihat struktur
ls -la

# Cek apakah ada folder public
ls -la public/

# Cek folder uploads
ls -la uploads/events/        # Jika tidak ada folder public
ls -la public/uploads/events/ # Jika ada folder public
```

## 📍 Lokasi File Gambar Event

Berdasarkan URL yang muncul di browser:
```
https://himakomuym.web.id/uploads/events/event-1765162704.jpg
```

Ini berarti struktur kemungkinan adalah **Struktur 1** (tanpa folder public/):

```
public_html/
└── uploads/
    └── events/
        └── event-1765162704.jpg  ← File harus ada di sini
```

## ✅ Checklist: Pastikan Struktur Benar

### 1. Cek Folder uploads/events

**Via SSH:**
```bash
cd public_html
ls -la uploads/events/
```

**Via File Manager:**
- Navigate ke: `public_html/uploads/events/`
- Pastikan folder ada

### 2. Cek File Gambar

**Via SSH:**
```bash
cd public_html/uploads/events
ls -la | grep event-1765162704
```

**Via File Manager:**
- Buka folder `public_html/uploads/events/`
- Cek apakah file `event-1765162704.jpg` ada

### 3. Cek Permission

**Via SSH:**
```bash
cd public_html
ls -la uploads/
# Harus terlihat: drwxrwxr-x (755 atau 775)

ls -la uploads/events/
# Harus terlihat: drwxrwxr-x (755 atau 775)

ls -la uploads/events/*.jpg
# Harus terlihat: -rw-r--r-- (644) atau -rw-rw-r-- (664)
```

**Jika permission salah, fix dengan:**
```bash
chmod -R 775 uploads
chmod 644 uploads/events/*.jpg
```

## 🗂️ Struktur Lengkap yang Disarankan

```
public_html/
├── .env
├── .htaccess
├── index.php
│
├── uploads/                      # ⭐ FOLDER UPLOAD
│   ├── events/                   # ⭐ GAMBAR EVENT
│   │   ├── event-1765162704.jpg
│   │   ├── event-1764696907.jpg
│   │   └── ...
│   │
│   ├── qris/                     # QRIS images
│   │   └── qris-xxx.jpg
│   │
│   ├── certificates/             # Certificate templates
│   │   ├── cert-xxx.jpg
│   │   └── generated/
│   │
│   ├── products/                 # Product images
│   │   └── product-xxx.jpg
│   │
│   ├── galeris/                  # Gallery images
│   │   └── gallery-xxx.jpg
│   │
│   ├── divisis/                  # Division photos
│   ├── divisi-members/          # Member photos
│   ├── kabinets/                 # Cabinet photos
│   ├── abouts/                   # About images
│   ├── proof_of_payments/        # Payment proofs
│   └── qris/                     # QRIS images
│
├── build/                        # Compiled assets
│   ├── assets/
│   └── manifest.json
│
├── app/
├── bootstrap/
├── config/
├── database/
├── resources/
├── routes/
├── storage/
└── vendor/
```

## 🔧 Command untuk Setup Struktur

### **Buat Folder Struktur Lengkap:**

```bash
cd public_html

# Buat folder uploads dan subfolder
mkdir -p uploads/events
mkdir -p uploads/qris
mkdir -p uploads/certificates/generated
mkdir -p uploads/certificates/batch
mkdir -p uploads/products
mkdir -p uploads/galeris
mkdir -p uploads/divisis
mkdir -p uploads/divisi-members
mkdir -p uploads/kabinets
mkdir -p uploads/abouts
mkdir -p uploads/proof_of_payments

# Set permission
chmod -R 775 uploads
find uploads -type f -exec chmod 644 {} \;

# Verify
ls -la uploads/
```

### **Cek Struktur Saat Ini:**

```bash
cd public_html

# Lihat struktur root
tree -L 2 -d

# Atau
find . -maxdepth 2 -type d | sort

# Cek folder uploads
ls -la uploads/
ls -la uploads/events/
```

## 📝 Catatan Penting

1. **Path di Database:**
   - Format: `events/event-xxx.jpg` (tanpa prefix `uploads/`)
   - Accessor otomatis menambahkan `uploads/` saat generate URL

2. **URL yang Dihasilkan:**
   - `https://himakomuym.web.id/uploads/events/event-xxx.jpg`
   - Berarti file harus ada di: `public_html/uploads/events/event-xxx.jpg`

3. **Jika Struktur Berbeda:**
   - Jika ada folder `public/`, sesuaikan path
   - Atau ubah konfigurasi `.htaccess`

4. **Permission:**
   - Folder: `775` (rwxrwxr-x)
   - File: `644` (rw-r--r--)

## 🚨 Troubleshooting

### Masalah: Folder uploads tidak ada

```bash
cd public_html
mkdir -p uploads/events
chmod -R 775 uploads
```

### Masalah: Permission denied

```bash
chmod -R 775 uploads
chown -R username:username uploads  # Ganti username dengan user hosting
```

### Masalah: File tidak bisa diakses via URL

1. Cek `.htaccess` di root `public_html`
2. Pastikan ada rule untuk allow access ke `uploads/`
3. Test dengan file lain (misal: `logo-himakom.png`)

---

**Struktur ini untuk Hostinger shared hosting. Jika hosting berbeda, struktur mungkin sedikit berbeda.**

*HIMAKOM UYM - Komdigi Division*

