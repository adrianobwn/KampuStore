# 🔐 Admin Credentials - KampuStore

## Admin Dummy untuk Testing & Verifikasi Toko

Berikut adalah kredensial admin yang sudah dibuat di database untuk keperluan testing dan verifikasi pendaftaran toko penjual.

---

### 👤 **Admin Utama**

```
Email    : admin@kampustore.com
Password : admin123
Role     : Super Admin
```

**Fungsi:**
- Verifikasi/Approve pendaftaran toko penjual
- Reject pendaftaran dengan alasan
- Akses penuh ke dashboard admin
- Manajemen user dan seller

**Akses Dashboard:**
- Login di: `http://127.0.0.1:8000/login`
- Setelah login, otomatis redirect ke: `/admin/dashboard`

---

### 👥 **Admin Verifikator**

#### Verifikator 1
```
Email    : verifikator1@kampustore.com
Password : verifikator123
Role     : Admin Verifikator
```

#### Verifikator 2
```
Email    : verifikator2@kampustore.com
Password : verifikator123
Role     : Admin Verifikator
```

**Fungsi:**
- Khusus untuk verifikasi pendaftaran toko
- Review dokumen KTP dan foto PIC
- Approve atau reject pendaftaran

---

## 📋 Cara Menggunakan

### 1. **Seed Admin ke Database**

Jika belum menjalankan seeder, jalankan:

```bash
php artisan db:seed --class=AdminSeeder
```

Atau seed semua data (termasuk admin):

```bash
php artisan db:seed
```

### 2. **Login sebagai Admin**

1. Buka browser: `http://127.0.0.1:8000/login`
2. Masukkan email: `admin@kampustore.com`
3. Masukkan password: `admin123`
4. Klik Login
5. Otomatis redirect ke Admin Dashboard

### 3. **Verifikasi Pendaftaran Toko**

Di Admin Dashboard, Anda bisa:

**Melihat Daftar Pendaftaran:**
- Navigasi: Admin Dashboard → Daftar Toko → Registrasi
- URL: `http://127.0.0.1:8000/admin/toko/registrasi`

**Review Pendaftaran:**
- Klik "Detail" pada toko yang statusnya "Pending"
- Lihat informasi toko: nama, deskripsi, data PIC
- Lihat dokumen: Foto PIC dan KTP
- Lihat alamat lengkap

**Approve Toko:**
- Klik tombol "Setujui" / "Approve"
- Toko akan berubah status menjadi "Approved"
- Penjual bisa mulai upload produk

**Reject Toko:**
- Klik tombol "Tolak" / "Reject"
- Masukkan alasan penolakan
- Toko akan berubah status menjadi "Rejected"
- Penjual akan melihat alasan penolakan

---

## 🔄 Reset Password Admin

Jika lupa password admin, jalankan:

```bash
php artisan tinker
```

Kemudian:

```php
$admin = \App\Models\User::where('email', 'admin@kampustore.com')->first();
$admin->password = bcrypt('admin123');
$admin->save();
exit;
```

---

## ⚠️ **PENTING - Security Notes**

### Untuk Production:

1. **JANGAN gunakan password default!**
   ```bash
   # Ganti password di production
   php artisan tinker
   $admin = User::where('email', 'admin@kampustore.com')->first();
   $admin->password = bcrypt('your-strong-password-here');
   $admin->save();
   ```

2. **Ganti email admin:**
   - Gunakan email kampus atau email resmi
   - Format: `admin@students.undip.ac.id` atau `admin@undip.ac.id`

3. **Hapus admin dummy:**
   ```bash
   # Hapus verifikator dummy jika tidak diperlukan
   php artisan tinker
   User::whereIn('email', [
       'verifikator1@kampustore.com',
       'verifikator2@kampustore.com'
   ])->delete();
   ```

4. **Enable 2FA (Two-Factor Authentication)** jika memungkinkan

5. **Gunakan environment variables:**
   ```env
   # .env
   ADMIN_EMAIL=your-admin@undip.ac.id
   ADMIN_PASSWORD=your-secure-password
   ```

---

## 🧪 Testing Workflow

### Skenario 1: Pendaftaran Toko Baru

1. **Penjual mendaftar:**
   - Buka: `/register`
   - Isi form pendaftaran
   - Submit

2. **Admin menerima notifikasi:**
   - Login sebagai admin
   - Lihat daftar pendaftaran pending
   - Review data toko

3. **Admin approve:**
   - Klik approve
   - Penjual bisa login dan mulai jualan

### Skenario 2: Reject Pendaftaran

1. **Admin review pendaftaran**
2. **Temukan masalah:**
   - Data tidak lengkap
   - Foto KTP tidak jelas
   - Email bukan domain UNDIP
3. **Reject dengan alasan jelas**
4. **Penjual melihat alasan penolakan di dashboard**

---

## 📞 Kontak

Jika ada masalah dengan admin credentials atau verifikasi:
- Email: support@kampustore.com (dummy)
- Telegram: @kampustore_support (dummy)

---

**Last Updated:** {{ date('Y-m-d') }}
**Version:** 1.0.0
