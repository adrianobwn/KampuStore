# 🚀 Quick Start - KampuStore

## Admin Login (untuk Verifikasi Toko)

```
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
        ADMIN CREDENTIALS
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

📧 Email    : admin@kampustore.com
🔑 Password : admin123
🌐 URL      : http://127.0.0.1:8000/login

━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
```

## Workflow Verifikasi Toko

### 1️⃣ Penjual Daftar
- Akses: `/register`
- Isi form dengan email `@students.undip.ac.id`
- Upload foto & KTP
- Submit → Status: **Pending**

### 2️⃣ Admin Verifikasi
- Login sebagai admin
- Buka: `/admin/toko/registrasi`
- Review data penjual
- **Approve** ✅ atau **Reject** ❌

### 3️⃣ Penjual Mulai Jualan
- Jika **Approved**: Dashboard seller aktif
- Bisa upload produk
- Kelola toko

---

## Perintah Penting

### Setup Database
```bash
# Migrasi database
php artisan migrate

# Seed admin dummy
php artisan db:seed --class=AdminSeeder

# Atau seed semua
php artisan db:seed
```

### Jalankan Server
```bash
php artisan serve
```

### Clear Cache
```bash
php artisan config:clear
php artisan cache:clear
php artisan view:clear
```

---

## URL Penting

| Role | URL | Keterangan |
|------|-----|------------|
| **Home** | `/` | Landing page |
| **Market** | `/products` | Browse produk (tanpa login) |
| **Login Penjual** | `/login` | Login untuk penjual |
| **Daftar Penjual** | `/register` | Registrasi toko baru |
| **Dashboard Seller** | `/market/dashboard` | Dashboard penjual |
| **Admin Dashboard** | `/admin/dashboard` | Dashboard admin |
| **Verifikasi Toko** | `/admin/toko/registrasi` | List pendaftaran |

---

## Role & Akses

### 🛍️ Pembeli (Guest)
- ✅ Browse produk
- ✅ Lihat detail produk
- ✅ Baca review
- ✅ Beli langsung (tanpa login)
- ❌ Tidak perlu registrasi

### 🏪 Penjual
- ✅ Daftar dengan email UNDIP
- ✅ Tunggu verifikasi admin
- ✅ Upload & kelola produk
- ✅ Monitor stok
- ✅ Lihat dashboard

### 👨‍💼 Admin
- ✅ Verifikasi pendaftaran toko
- ✅ Approve/Reject seller
- ✅ Manajemen user
- ✅ Monitor platform

---

## Testing Accounts

### Admin Accounts
```
admin@kampustore.com          / admin123
verifikator1@kampustore.com   / verifikator123
verifikator2@kampustore.com   / verifikator123
```

### Test Seller (Buat manual via /register)
```
Email    : penjual@students.undip.ac.id
Password : (bebas, min 8 karakter)
```

---

## Troubleshooting

### Admin tidak bisa login?
```bash
# Re-seed admin
php artisan db:seed --class=AdminSeeder --force
```

### Lupa password admin?
```bash
php artisan tinker
# Kemudian:
$admin = User::where('email', 'admin@kampustore.com')->first();
$admin->password = bcrypt('admin123');
$admin->save();
exit;
```

### Error 419 (CSRF)?
```bash
php artisan config:clear
php artisan cache:clear
```

### Storage link error?
```bash
php artisan storage:link
```

---

## Demo Flow

### Flow 1: Pembeli Belanja
```
1. Buka http://127.0.0.1:8000
2. Klik "Belanja Sekarang"
3. Browse produk (TANPA LOGIN!)
4. Klik produk untuk detail
5. Beli langsung
```

### Flow 2: Penjual Daftar → Verifikasi → Jualan
```
1. Buka /register
2. Isi form lengkap (email @students.undip.ac.id)
3. Upload foto & KTP
4. Submit → Status: Pending

[ADMIN SIDE]
5. Admin login (admin@kampustore.com)
6. Buka /admin/toko/registrasi
7. Review & Approve

[PENJUAL SIDE]
8. Penjual login
9. Redirect ke dashboard seller
10. Upload produk pertama!
```

---

## Status Toko

| Status | Icon | Keterangan |
|--------|------|------------|
| **Pending** | 🕐 | Menunggu verifikasi admin |
| **Approved** | ✅ | Disetujui, bisa jualan |
| **Rejected** | ❌ | Ditolak (lihat alasan) |

---

**Happy Selling! 🎉**
