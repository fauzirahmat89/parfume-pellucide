<h1 align="center">Pellucide – Website E‑Commerce Skincare</h1>

<p align="center">
  Website brand skincare <b>Pellucide</b> berbasis Laravel + Blade + Tailwind dengan katalog produk, landing page, admin panel, dan chatbot GLM.
</p>

---

## 1. Ringkasan Proyek

- **Brand:** Pellucide – skincare premium untuk iklim tropis Indonesia.
- **Fitur utama:**
  - Landing page dengan hero section, cerita brand, dan CTA ke katalog.
  - Katalog produk (grid + detail produk).
  - Section **Hot Products** (maks. 4 produk unggulan).
  - Link pembelian ke **Shopee**, **Tokopedia**, dan **WhatsApp** tiap produk.
  - Admin panel untuk kelola produk (CRUD, upload gambar, toggle HOT/aktif).
  - Widget chatbot **Pellucide AI** yang menjawab pertanyaan seputar produk.
- **Teknologi:** Laravel 12, Blade, Tailwind CSS, Alpine.js, Vite, MySQL/SQLite, GLM Chat API.

Untuk detail story brand, daftar produk, dan requirement desain/UX, lihat dokumen lengkap di `INSTRUKSI-WEBSITE-PELLUCIDE.md`.

---

## 2. URL Penting

- **Landing page:** `GET /`
- **Daftar produk:** `GET /products`
- **Detail produk:** `GET /products/{slug}`
- **Endpoint chatbot (AJAX):** `POST /chat`
- **Halaman login admin (hidden URL):** `GET /pellucide-admin-secret`
- **Dashboard admin:** `GET /admin/dashboard`
- **Kelola produk admin:** prefix `admin/products` dengan route name `admin.products.*`

> Catatan: Link ke halaman login admin tidak ditampilkan di frontend. URL hanya diketahui developer/owner.

---

## 3. Kredensial Default Admin

Jika seed database dijalankan, akan dibuat akun admin default:

```text
Email   : admin@pellucide.com
Password: pellucide2024
Role    : admin
```

Akun ini memiliki akses penuh ke admin panel (`/admin/dashboard`). Segera ganti password di lingkungan produksi.

---

## 4. Prasyarat

Pastikan environment lokal sudah terpasang:

- **PHP** `^8.2`
- **Composer** (manajer dependency PHP)
- **Node.js** `>= 20` (disarankan) + **npm**
- **Database:**
  - Default: **SQLite** (file `database/database.sqlite` sudah disertakan)
  - Alternatif: **MySQL** (jika ingin pakai server database sendiri)
- **Git** (opsional, untuk clone repo)

> Jika menggunakan Windows, disarankan memakai **Laravel Herd**, **XAMPP**, atau WSL2 untuk PHP + ekstensi yang lengkap.

---

## 5. Konfigurasi Environment (`.env`)

1. Salin file contoh:

   ```bash
   cp .env.example .env
   # Atau di Windows PowerShell:
   copy .env.example .env
   ```

2. Generate application key:

   ```bash
   php artisan key:generate
   ```

3. Atur konfigurasi dasar di `.env`:

   ```env
   APP_NAME=Pellucide
   APP_ENV=local
   APP_URL=http://localhost

   # Pilih salah satu konfigurasi database di bawah ini
   ```

### 5.1. Opsi A – Pakai SQLite (paling sederhana)

`.env` (default dari project ini sudah mengarah ke SQLite):

```env
DB_CONNECTION=sqlite
```

File `database/database.sqlite` sudah ada di repository. Jika ingin mengosongkan database, cukup hapus file tersebut lalu buat file kosong baru dengan nama yang sama.

### 5.2. Opsi B – Pakai MySQL

Jika ingin menggunakan MySQL, ubah bagian database di `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=parfumepellucide
DB_USERNAME=root
DB_PASSWORD=
```

Jangan lupa:

- Buat database `parfumepellucide` terlebih dahulu di MySQL.
- Sesuaikan `DB_USERNAME` dan `DB_PASSWORD` dengan user MySQL di komputer Anda.

---

## 6. Setup Chatbot GLM

Chatbot menggunakan layanan **GLM Chat API** (Zhipu / BigModel / Z.ai). Endpoint ini diproxy oleh backend melalui route `POST /chat` (`App\Http\Controllers\ChatController`).

Di `.env`, set nilai berikut:

```env
GLM_API_KEY=isi_dengan_api_key_anda
GLM_MODEL=glm-4-flash
GLM_API_ENDPOINT=https://open.bigmodel.cn/api/paas/v4/chat/completions
```

Atau sesuaikan dengan provider yang Anda gunakan, misal:

```env
GLM_MODEL=glm-4.6
GLM_API_ENDPOINT=https://api.z.ai/api/paas/v4/chat/completions
```

Catatan penting:

- Jika `GLM_API_KEY` kosong, endpoint `/chat` akan mengembalikan HTTP `503` dengan pesan "Chat service is not configured yet."
- Widget chatbot ada di frontend sebagai bubble chat mengambang, dan berkomunikasi hanya lewat AJAX ke backend (API key aman di server).

---

## 7. Instalasi & Menjalankan Proyek (Local)

Di bawah ini contoh alur paling umum untuk development lokal.

### 7.1. Clone repository

```bash
git clone <URL_REPOSITORY_ANDA> parfumepellucide
cd parfumepellucide
```

> Jika Anda tidak menggunakan Git, cukup download ZIP proyek ini lalu ekstrak dan buka foldernya.

### 7.2. Install dependency PHP

```bash
composer install
```

Jika ada masalah terkait ekstensi PHP yang kurang, pastikan ekstensi tersebut diaktifkan di `php.ini` (misalnya `pdo`, `openssl`, `mbstring`, `fileinfo`, dll.).

### 7.3. Konfigurasi `.env` & app key

Jika belum dilakukan di langkah sebelumnya:

```bash
cp .env.example .env      # atau copy .env.example .env (Windows)
php artisan key:generate
```

Lalu sesuaikan konfigurasi database dan GLM di `.env` sesuai kebutuhan Anda.

### 7.4. Migrasi database & seeder

Jalankan migrasi dan seeder untuk membuat struktur tabel dan data awal (admin + produk Pellucide):

```bash
php artisan migrate --seed
```

Perintah ini akan:

- Membuat tabel `users`, `products`, `product_images`, dan tabel lain yang dibutuhkan.
- Mengisi data:
  - 1 user admin (`admin@pellucide.com` / `pellucide2024`).
  - 9 produk utama Pellucide lengkap dengan benefit dan link dummy marketplace/WhatsApp.

Jika terjadi error, cek kembali konfigurasi database di `.env` dan pastikan server database aktif.

### 7.5. Storage symlink

Agar gambar yang diupload bisa diakses dari `public/storage`, jalankan:

```bash
php artisan storage:link
```

Ini akan membuat symbolic link dari `public/storage` ke `storage/app/public`.

### 7.6. Install dependency frontend

```bash
npm install
```

Dependency ini mencakup Vite, Tailwind CSS, Axios, dan tools development lain.

### 7.7. Menjalankan server untuk development

Ada dua cara utama untuk menjalankan proyek:

#### Cara 1 – Manual (dua terminal)

Terminal 1 – jalankan server Laravel:

```bash
php artisan serve
```

Terminal 2 – jalankan dev server Vite:

```bash
npm run dev
```

Secara default, aplikasi bisa diakses di:

- `http://127.0.0.1:8000` (Laravel)
- Vite akan otomatis terhubung dengan konfigurasi di `vite.config.js`.

#### Cara 2 – Script dev all-in-one (opsional)

Di `composer.json` tersedia script `dev` yang menggunakan `concurrently` untuk menjalankan beberapa proses sekaligus (server, queue, log, Vite):

```bash
composer run dev
```

Script ini akan menjalankan:

- `php artisan serve`
- `php artisan queue:listen --tries=1`
- `php artisan pail --timeout=0`
- `npm run dev`

Pastikan `npx` dan dependency JS sudah terinstall (`npm install`) sebelum menjalankan script ini.

### 7.8. Build aset untuk produksi

Untuk build aset statis (CSS/JS) tanpa dev server:

```bash
npm run build
```

Output akan disimpan di `public/build` dan digunakan saat `APP_ENV=production` atau ketika Vite dev server tidak berjalan.

---

## 8. Admin Panel & Manajemen Konten

### 8.1. Login admin

1. Akses URL login rahasia:

   ```text
   /pellucide-admin-secret
   ```

2. Masuk menggunakan kredensial default (jika belum diubah):

   ```text
   Email   : admin@pellucide.com
   Password: pellucide2024
   ```

3. Setelah login, Anda akan diarahkan ke `admin/dashboard`.

> Demi keamanan, ubah password admin di lingkungan produksi dan batasi akses hanya untuk tim internal.

### 8.2. Kelola produk

Di dashboard admin, menu **Products** memungkinkan Anda untuk:

- Menambah produk baru (nama, kategori, ukuran, harga, deskripsi).
- Menulis benefit produk (textarea, 1 benefit per baris; otomatis disimpan sebagai array).
- Mengatur apakah produk:
  - Ditampilkan sebagai **Hot Product**.
  - Aktif / nonaktif di katalog.
- Menambahkan gambar produk:
  - Upload file (disimpan di `storage/app/public/products`).
  - Menyimpan URL gambar eksternal.
- Menghapus gambar tertentu, dan menentukan urutan gambar (sort order).
- Mengatur link pembelian:
  - `shopee_link`
  - `tokopedia_link`
  - `whatsapp_number` (format internasional, tanpa `+`, misal `6281234567890`)

Pastikan Anda sudah menjalankan `php artisan storage:link` agar gambar yang diupload dapat tampil di frontend.

---

## 9. Struktur Folder Singkat

Hanya beberapa folder penting yang sering disentuh saat pengembangan:

- `app/Models`
  - `Product.php` – model produk + accessor harga terformat, link WhatsApp, gambar utama.
  - `ProductImage.php` – model untuk galeri gambar setiap produk.
- `app/Http/Controllers`
  - `HomeController.php` – logic landing page + list produk.
  - `ProductController.php` – halaman katalog dan detail produk public.
  - `ChatController.php` – endpoint chatbot GLM (`POST /chat`).
- `app/Http/Controllers/Admin`
  - `AuthController.php` – login/logout admin + rate limiting.
  - `DashboardController.php` – ringkasan untuk admin.
  - `ProductController.php` – CRUD produk di admin.
- `database/migrations` – skema tabel database (users, products, product_images, dsb.).
- `database/seeders/DatabaseSeeder.php` – seeding admin dan produk default.
- `resources/views`
  - `home.blade.php` – halaman utama / landing.
  - `products/*.blade.php` – tampilan katalog & detail produk (public).
  - `admin/*.blade.php` – tampilan admin panel.
- `public` – aset publik (favicon, placeholder image, dll.).

---

## 10. Testing

Untuk menjalankan test otomatis:

```bash
php artisan test
```

Atau melalui composer script:

```bash
composer test
```

Pastikan database testing Anda dikonfigurasi dengan benar jika menambahkan test yang memodifikasi data.

---

## 11. Troubleshooting Umum

- **Halaman putih / error 500 setelah `php artisan serve`:**
  - Cek file log di `storage/logs/laravel.log`.
  - Pastikan `APP_KEY` sudah di-generate (`php artisan key:generate`).
  - Pastikan database terkoneksi dan migration sudah dijalankan.

- **Gambar produk tidak muncul:**
  - Pastikan sudah menjalankan `php artisan storage:link`.
  - Cek apakah path gambar di database benar (contoh: `products/...` atau URL lengkap `https://...`).

- **Chatbot tidak berfungsi / error 503:**
  - Cek apakah `GLM_API_KEY` sudah diisi di `.env`.
  - Pastikan server Anda memiliki akses outbound ke endpoint GLM.

- **Tidak bisa login admin (email/password salah):**
  - Pastikan seeder sudah berjalan (`php artisan migrate --seed`).
  - Jika lupa password, Anda bisa edit langsung di database (hash dengan `bcrypt`) atau buat user admin baru via tinker.

---

## 12. Catatan Tambahan

- Dokumen teknis dan deskripsi produk yang lebih lengkap tersedia di `INSTRUKSI-WEBSITE-PELLUCIDE.md`.
- Proyek ini menggunakan Laravel 12; untuk fitur framework lebih lanjut, silakan lihat dokumentasi resmi di https://laravel.com/docs.

Jika Anda mengikuti langkah di atas, proyek Pellucide seharusnya dapat berjalan di environment lokal tanpa konfigurasi tambahan yang rumit. Selamat mengembangkan!

