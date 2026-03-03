# Website Posyandu

Sistem informasi manajemen Posyandu untuk pengelolaan data ibu, anak, imunisasi, dan laporan kegiatan posyandu.

## Tech Stack

[![Laravel](https://img.shields.io/badge/Laravel-10.x-orange?style=flat&logo=laravel)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.1+-777BB4?style=flat&logo=php)](https://www.php.net)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-5-7952B3?style=flat&logo=bootstrap)](https://getbootstrap.com)
[![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=flat&logo=mysql)](https://www.mysql.com)
[![Dompdf](https://img.shields.io/badge/Dompdf-3.0-blue)](https://github.com/dompdf/dompdf)
[![Sanctum](https://img.shields.io/badge/Sanctum-3.3-red?style=flat)](https://laravel.com/docs/sanctum)

## Fitur

### 1. Manajemen Data Ibu/orang Tua
- Tambah, edit, hapus data ibu/orang tua
- Pencarian data
- Detail informasi orang tua

### 2. Manajemen Data Anak
- Tambah, edit, hapus data anak
- Pencarian data anak
- Relasi data anak dengan orang tua

### 3. Manajemen Imunisasi
- Data vaksin/imunisasi
- Riwayat imunisasi anak

### 4. Penimbangan & Posyandu
- Pencatatan penimbangan anak
- Pencarian data posyandu
- Data posyandu terlambat

### 5. Jadwal Posyandu
- Pengaturan jadwal posyandu
- Jadwal buka/tutup

### 6. Edukasi/Artikel
- Artikel kesehatan ibu dan anak
- Pencarian artikel

### 7. Laporan
- Laporan data posyandu
- Export PDF laporan

### 8. API Mobile
- Register/Login
- Data imunisasi
- Data anak
- Data grafik
- Profil pengguna
- Jadwal posyandu
- Artikel edukasi

## Instalasi

```bash
# Install dependencies
composer install

# Copy environment file
cp .env.example .env

# Generate key
php artisan key:generate

# Database migration
php artisan migrate

# Link storage
php artisan storage:link

# Run server
php artisan serve
```

## Konfigurasi Production

```bash
# Install production dependencies
composer install --optimize-autoloader --no-dev

# Cache config
php artisan config:cache

# Cache routes
php artisan route:cache

# Clear and rebuild cache
php artisan cache:clear
php artisan view:clear
```

## Default Credentials

```
Email: admin@admin.com
Password: password
```

## Struktur Folder

```
app/
├── Http/
│   └── Controllers/
│       ├── Api/          # API Controllers
│       ├── Auth/         # Authentication Controllers
│       └── *.php         # Main Controllers
└── Models/
    ├── DataAnak.php
    ├── DataIbu.php
    ├── DataImunisasi.php
    ├── DataPosyandu.php
    ├── JadwalModel.php
    ├── DetailPosyandu.php
    └── Artikel.php
```

## Route List

- `/login` - Halaman login
- `/home` - Dashboard
- `/data-anak` - Data anak
- `/data-ibu` - Data ibu/orang tua
- `/data-imunisasi` - Data imunisasi
- `/data-posyandu` - Data penimbangan
- `/jadwal-posyandu` - Jadwal posyandu
- `/edukasi` - Artikel edukasi
- `/pengaturan-akun` - Pengaturan akun
- `/data-laporan` - Laporan posyandu
- `/cetak-pdf` - Export PDF

## API Endpoints

```
POST /api/auth/register
POST /api/auth/login
POST /api/auth/check-email
POST /api/auth/change-password
GET  /api/auth/dataImunisasi
GET  /api/auth/dataAnak
GET  /api/auth/dataGrafik
GET  /api/auth/dataProfile
PUT  /api/auth/updateProfile
GET  /api/edukasi
GET  /api/jadwal-posyandu
```

## Lisensi

MIT License
