# 🎓 KampuStore

![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![TailwindCSS](https://img.shields.io/badge/Tailwind_CSS-3.x-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)
![License](https://img.shields.io/badge/License-MIT-green?style=for-the-badge)

**KampuStore** adalah platform e-commerce berbasis web yang dirancang khusus untuk memfasilitasi transaksi jual beli di lingkungan kampus. Platform ini mempertemukan mahasiswa yang ingin menjual produk mereka dengan pembeli di sekitar kampus, dilengkapi dengan sistem verifikasi toko untuk keamanan dan fitur pelaporan yang lengkap.

---

## 🚀 Fitur Utama

### 👤 Pengguna & Pembeli (User/Buyer)
*   **Katalog Produk Lengkap**: Jelajahi produk berdasarkan kategori dan lokasi (Provinsi/Kota).
*   **Pencarian Canggih**: Fitur pencarian produk yang responsif.
*   **Ulasan & Rating**: Memberikan ulasan pada produk yang telah dibeli (mendukung *Guest Review*).
*   **Autentikasi**: Login dan Register yang terintegrasi (Satu akun untuk User & Seller).

### 🏪 Penjual (Seller)
*   **Registrasi Mudah**: Mendaftar sebagai penjual langsung dari akun user.
*   **Manajemen Produk**: Tambah, edit, dan kelola stok produk dengan mudah.
*   **Dashboard Penjual**: Ringkasan performa toko.
*   **Laporan Toko**:
    *   Laporan Stok & Restock.
    *   Laporan Penjualan.
    *   **Export**: Unduh laporan dalam format PDF dan Excel.

### 🛡️ Admin
*   **Dashboard Admin**: Monitoring aktivitas platform.
*   **Verifikasi Toko**: Sistem persetujuan (Approve/Reject) untuk toko baru guna menjaga keamanan platform.
*   **Notifikasi Email**: Otomatis mengirim email notifikasi saat toko disetujui atau ditolak beserta alasannya.
*   **Laporan Platform**:
    *   Ranking Produk Terlaris.
    *   Sebaran Lokasi Penjual.
    *   Export laporan global ke PDF/Excel.

---

## 🛠️ Teknologi yang Digunakan

*   **Framework**: [Laravel 12](https://laravel.com)
*   **Language**: PHP ^8.2
*   **Frontend**: Blade Templates, Tailwind CSS
*   **Database**: MySQL
*   **Libraries**:
    *   `barryvdh/laravel-dompdf` (Cetak PDF)
    *   `maatwebsite/excel` (Export Excel)

---

## ⚙️ Persyaratan Sistem

Sebelum memulai, pastikan sistem Anda memiliki:
*   PHP >= 8.2
*   Composer
*   Node.js & NPM
*   MySQL

---

## 📥 Instalasi

Ikuti langkah-langkah berikut untuk menjalankan projek di komputer lokal Anda:

1.  **Clone Repositori**
    ```bash
    git clone https://github.com/apeeapee/KampuStore.git
    cd KampuStore
    ```

2.  **Install Dependencies**
    ```bash
    composer install
    npm install
    ```

3.  **Konfigurasi Environment**
    Salin file contoh `.env` dan sesuaikan konfigurasi database Anda.
    ```bash
    cp .env.example .env
    ```
    *Buka file `.env` dan atur `DB_DATABASE`, `DB_USERNAME`, dan `DB_PASSWORD` sesuai database lokal Anda.*

4.  **Generate App Key**
    ```bash
    php artisan key:generate
    ```

5.  **Migrasi Database & Seeding**
    Jalankan migrasi dan isi database dengan data dummy (termasuk akun Admin default).
    ```bash
    php artisan migrate --seed
    ```

6.  **Jalankan Aplikasi**
    Buka dua terminal terpisah untuk menjalankan server Laravel dan Vite (untuk assets).
    
    *Terminal 1:*
    ```bash
    php artisan serve
    ```
    
    *Terminal 2:*
    ```bash
    npm run dev
    ```

    Atau gunakan perintah gabungan (jika dikonfigurasi):
    ```bash
    composer run dev
    ```

---

## 🔑 Akun Default (Seeder)

Gunakan akun berikut untuk pengujian setelah menjalankan `php artisan migrate --seed`:

| Role | Email | Password | Keterangan |
| :--- | :--- | :--- | :--- |
| **Admin** | `admin@kampustore.com` | `admin123` | Akses penuh dashboard admin & verifikasi |
| **Verifikator 1** | `verifikator1@kampustore.com` | `verifikator123` | Admin tambahan |
| **User Test** | `test@example.com` | *password default* | User biasa (cek `UserFactory`) |

> **Catatan**: Password default untuk user factory biasanya adalah `password` (tergantung konfigurasi Laravel default).

---

## 🧪 Pengujian & Laporan

*   **Akses Laporan Admin**: Login sebagai Admin -> Menu Laporan.
*   **Coba Fitur Export**: Di halaman laporan, klik tombol "Export PDF" atau "Export Excel" untuk menguji fungsi library tambahan.

---

## 📄 Lisensi

Projek ini dilisensikan di bawah [MIT license](https://opensource.org/licenses/MIT).
