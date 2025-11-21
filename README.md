# DP3AP2KB

Aplikasi Sistem Informasi untuk Dinas Pemberdayaan Perempuan, Perlindungan Anak, Pengendalian Penduduk dan Keluarga Berencana (DP3AP2KB).

## Persyaratan Sistem (Requirements)

Pastikan perangkat Anda telah terinstal perangkat lunak berikut sebelum memulai:

- **PHP**: Versi 8.3.24 atau lebih baru
- **Laravel Framework**: Versi 12.x
- **Composer**: Dependency manager untuk PHP
- **Node.js & NPM**: Untuk mengelola aset frontend
- **Database**: MySQL / MariaDB

## Tahapan Instalasi

Ikuti langkah-langkah berikut secara berurutan untuk menyiapkan proyek di lingkungan lokal (local environment):

### 1. Clone Repository & Masuk ke Direktori
```bash
git clone <url-repository-anda>
cd DP3AP2KB
```

### 2. Install Dependensi Backend (Composer)
Install seluruh library PHP yang dibutuhkan oleh Laravel:
```bash
composer install
```

### 3. Install Dependensi Frontend (NPM)
Install library JavaScript dan CSS yang dibutuhkan:
```bash
npm install
```

### 4. Konfigurasi Environment (.env)
Salin file konfigurasi contoh `.env.example` menjadi `.env`:

**Windows (Command Prompt/PowerShell):**
```powershell
copy .env.example .env
```

**Mac/Linux:**
```bash
cp .env.example .env
```

### 5. Generate Application Key
Buat kunci enkripsi aplikasi baru:
```bash
php artisan key:generate
```

### 6. Konfigurasi Database
Buka file `.env` yang baru saja dibuat, lalu sesuaikan pengaturan database Anda. Pastikan Anda telah membuat database kosong di MySQL/MariaDB Anda.

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database_anda
DB_USERNAME=root
DB_PASSWORD=password_database_anda
```

### 7. Jalankan Migrasi Database
Buat tabel-tabel yang diperlukan ke dalam database:
```bash
php artisan migrate
```
*(Opsional: Tambahkan `--seed` jika ingin mengisi data awal)*
```bash
php artisan migrate --seed
```

### 8. Setup Storage Link (Wajib)
Perintah ini wajib dijalankan agar file yang diupload (gambar, dokumen) dapat diakses oleh publik:
```bash
php artisan storage:link
```

### 9. Generate Dokumentasi API (Swagger)
Generate file dokumentasi API menggunakan L5-Swagger:
```bash
php artisan l5-swagger:generate
```

### 10. Build Aset Frontend
Compile aset CSS dan JS menggunakan Vite:
```bash
npm run build
```

---

## Menjalankan Aplikasi

Setelah proses instalasi selesai, Anda dapat menjalankan aplikasi dengan langkah berikut:

1. **Jalankan Server Laravel:**
   ```bash
   php artisan serve
   ```
   Aplikasi dapat diakses di: [http://localhost:8000](http://localhost:8000)

2. **Jalankan Vite (Opsional untuk Development):**
   Jika Anda sedang melakukan pengembangan frontend (hot-reload):
   ```bash
   npm run dev
   ```

## Dokumentasi API

Dokumentasi API dapat diakses setelah menjalankan server di:
[http://localhost:8000/api/documentation](http://localhost:8000/api/documentation)
