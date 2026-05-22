<p align="center">
  <img src="https://img.shields.io/badge/Laravel-12-FF2D20?logo=laravel" alt="Laravel 12">
  <img src="https://img.shields.io/badge/PHP-8.2-777BB4?logo=php" alt="PHP 8.2">
  <img src="https://img.shields.io/badge/Tailwind_CSS-4-06B6D4?logo=tailwindcss" alt="Tailwind CSS">
  <img src="https://img.shields.io/badge/MySQL-4479A1?logo=mysql" alt="MySQL">
</p>

<h1 align="center">🎵 APS PROJECT — Aplikasi Pemesanan Tiket Konser</h1>

<p align="center">
  Platform pemesanan tiket konser berbasis web dengan sistem <strong>manajemen konser, booking tiket, 
  pembayaran via transfer/saldo, fitur chat, dan laporan keuangan</strong>.
</p>

---

## ✨ Fitur

### 👤 Pengguna (User)
| Fitur | Deskripsi |
|-------|-----------|
| 🎫 **Lihat & Cari Konser** | Jelajahi konser yang tersedia dengan detail lengkap |
| 🎟️ **Booking Tiket** | Pesan tiket konser dengan jumlah kursi yang diinginkan |
| 💳 **Pembayaran** | Bayar via transfer (upload bukti) atau saldo dompet |
| 👛 **Saldo Dompet** | Isi saldo oleh admin, gunakan untuk bayar tiket |
| 💰 **Withdrawal** | Ajukan penarikan saldo ke rekening bank |
| 💬 **Chat Admin** | Tanya-jawab dengan admin melalui chat |
| ⭐ **Kritik & Saran** | Kirim feedback ke admin |
| 📢 **Pengumuman** | Lihat pengumuman dari admin |

### 🔧 Admin & Supervisor
| Fitur | Deskripsi |
|-------|-----------|
| 📊 **Dashboard** | Statistik konser, booking, pemasukan, pengeluaran |
| 🎵 **Manajemen Konser** | CRUD konser (tambah, edit, hapus) |
| 📋 **Manajemen Booking** | Konfirmasi/tolak booking, upload bukti pembayaran |
| 👥 **Manajemen User** | Kelola pengguna, top-up saldo (khusus admin) |
| 🏦 **Manajemen Withdrawal** | Setujui/tolak penarikan saldo |
| 📄 **Invoice** | Buat invoice pemasukan & pengeluaran, ekspor PDF/Word |
| 💬 **Chat** | Balas chat dari pengguna |
| 📢 **Pengumuman** | Buat & kelola pengumuman |
| ⭐ **Feedback** | Lihat kritik & saran dari pengguna |
| 🔄 **Backup & Restore** | Backup dan restore database |
| 🧮 **Kalkulator** | Kalkulator sederhana |

---

## 🖥️ Screenshot

> *<img width="1343" height="663" alt="image" src="https://github.com/user-attachments/assets/89a54c50-e811-4617-9623-bcc5a81f43b8" />
<img width="1348" height="663" alt="image" src="https://github.com/user-attachments/assets/a2507211-07bd-4240-96f3-6ba9a041ad48" />
<img width="1347" height="659" alt="image" src="https://github.com/user-attachments/assets/9a11ca3d-0966-4037-9279-265550cbd48e" />
<img width="1361" height="678" alt="image" src="https://github.com/user-attachments/assets/3dd4a557-6517-4c80-bbce-c42d5ac188b9" />
<img width="1358" height="672" alt="image" src="https://github.com/user-attachments/assets/bd1f3d42-2524-4004-b140-c3075310a4d8" />
<img width="1363" height="674" alt="image" src="https://github.com/user-attachments/assets/cf4bc802-cc16-4c91-b3c7-2ff568825204" />





*

---

## 🚀 Instalasi

### Prasyarat
- PHP 8.2+
- Composer
- MySQL / MariaDB
- Node.js & npm
- Git

### Langkah Instalasi

```bash
# 1. Clone repositori
git clone https://github.com/purnama19452024/APSPROJECT-TIKETKONSER.git
cd APSPROJECT-TIKETKONSER

# 2. Install dependensi PHP
composer install

# 3. Copy file environment
copy .env.example .env

# 4. Generate application key
php artisan key:generate

# 5. Buat database MySQL, lalu edit .env
# DB_DATABASE=nama_database
# DB_USERNAME=root
# DB_PASSWORD=

# 6. Jalankan migrasi dan seeder
php artisan migrate --seed

# 7. Install dependensi frontend
npm install
npm run build

# 8. Jalankan aplikasi
php artisan serve
```

Akses aplikasi di `http://localhost:8000`

---

## 🧑‍💻 Akun Default (Seeder)

| Role | Email | Password |
|------|-------|----------|
| 🛡️ Admin | admin@admin.com | password |
| 👁️ Supervisor | supervisor@admin.com | password |
| 👤 User | test@example.com | password |

---

## 📖 Tutorial Penggunaan

### 🧭 Untuk Pengguna (User)

#### 1. Registrasi & Login
1. Buka halaman utama → klik **Register** atau **Login**
2. Daftar dengan nama, email, dan password
3. Login dengan akun yang sudah dibuat

#### 2. Melihat Konser
1. Dari halaman utama klik **Browse Concerts** atau **Concerts** di navbar
2. Lihat daftar konser yang tersedia (judul, artis, tanggal, venue, harga, kursi tersedia)
3. Klik konser untuk melihat detail lengkap

#### 3. Booking Tiket
1. Di halaman detail konser, klik **Book Now** atau **Pesan Tiket**
2. Pilih jumlah tiket yang diinginkan
3. Pilih metode pembayaran:
   - **Transfer**: upload bukti pembayaran
   - **Saldo**: bayar langsung dari saldo dompet (jika saldo cukup)
4. Klik **Pesan** → booking akan muncul dengan status **Pending**

#### 4. Cek Status Booking
1. Dari dashboard user, lihat **My Tickets** atau **Your Tickets**
2. Booking akan memiliki status: **Pending** (menunggu konfirmasi), **Confirmed** (disetujui), **Cancelled** (ditolak), **Expired** (kedaluwarsa)

#### 5. Chat dengan Admin
1. Klik **Chat Admin** di sidebar
2. Kirim pesan atau upload gambar
3. Admin akan membalas pesan Anda

#### 6. Withdrawal (Penarikan Saldo)
1. Klik **Withdrawals** di sidebar
2. Klik **Ajukan Penarikan**
3. Masukkan jumlah, nama bank, nomor rekening, dan nama pemilik
4. Admin akan menyetujui atau menolak permintaan

#### 7. Kritik & Saran
1. Klik **Kritik & Saran** di sidebar
2. Tulis pesan feedback Anda
3. Admin akan melihat feedback tersebut

#### 8. Profil
1. Klik **Profile** di sidebar
2. Edit nama, email, atau upload foto profil

---

### 🛠️ Untuk Admin & Supervisor

#### 1. Dashboard Admin
Setelah login sebagai admin/supervisor, buka `/admin` untuk melihat:
- Statistik jumlah konser, booking, pemasukan, pengeluaran, revenue
- Booking terbaru
- Konser mendatang

#### 2. Manajemen Konser
1. Klik **Concerts** di sidebar admin
2. **Tambah**: klik **Add Concert** → isi form (judul, artis, tanggal, jam, venue, kota, harga, kursi, gambar)
3. **Edit**: klik **Edit** pada konser → ubah data
4. **Hapus**: klik **Delete** (hanya admin)
5. Atur **Ticket Expiry** untuk menentukan batas waktu booking tiket

#### 3. Manajemen Booking
1. Klik **Bookings** di sidebar admin
2. Lihat daftar booking dengan status masing-masing
3. Klik booking untuk melihat detail
4. **Confirm**: setujui booking (kurangi kursi tersedia)
5. **Cancel**: tolak booking

#### 4. Manajemen User
1. Klik **Users** di sidebar admin
2. Lihat daftar user, klik untuk detail
3. **Top-Up Saldo**: tambahkan saldo ke dompet user
4. Admin bisa **Tambah, Edit, Hapus** user

#### 5. Manajemen Withdrawal
1. Klik **Withdrawals** di sidebar admin
2. Lihat daftar permintaan penarikan
3. Klik untuk detail
4. **Approve**: setujui penarikan (saldo user akan terpotong otomatis)
5. **Reject**: tolak penarikan dengan catatan

#### 6. Invoice
1. Klik **Invoices** di sidebar admin
2. **Uang Masuk/Uang Keluar**: filter berdasarkan tipe
3. **Buat Invoice**: klik **Create** (khusus admin) → pilih tipe, masukkan jumlah, deskripsi
4. **Upload Signature**: upload tanda tangan digital
5. **Export**: download invoice sebagai **PDF** atau **Word**

#### 7. Chat
1. Klik **Chats** di sidebar admin
2. Pilih user yang ingin dibalas
3. Ketik pesan dan kirim

#### 8. Pengumuman
1. Klik **Announcements** di sidebar admin
2. Admin bisa **Tambah, Edit, Hapus** pengumuman
3. Supervisor hanya bisa melihat

#### 9. Backup & Restore
1. Klik **Backup & Restore** di sidebar admin
2. **Create Backup**: backup database ke file SQL
3. **Restore**: restore dari file backup
4. **Download**: download file backup
5. **Delete**: hapus file backup (khusus admin)

#### 10. Kalkulator
Klik **Calculator** di sidebar admin untuk menggunakan kalkulator sederhana.

---

## 🧩 Role & Hak Akses

| Fitur | Admin | Supervisor | User |
|-------|:-----:|:----------:|:----:|
| Dashboard Admin | ✅ | ✅ | ❌ |
| CRUD Konser | ✅ | ✅ | ❌ |
| Konfirmasi Booking | ✅ | ✅ | ❌ |
| Lihat User | ✅ | ✅ | ❌ |
| Tambah/Edit/Hapus User | ✅ | ❌ | ❌ |
| Top-Up Saldo | ✅ | ❌ | ❌ |
| Approve/Reject Withdrawal | ✅ | ❌ | ❌ |
| Buat/Hapus Invoice | ✅ | ❌ | ❌ |
| Lihat Invoice | ✅ | ✅ | ❌ |
| Chat | ✅ | ✅ | ❌ |
| CRUD Pengumuman | ✅ | ❌ | ❌ |
| Backup & Restore | ✅ | ❌ | ❌ |
| Kalkulator | ✅ | ✅ | ❌ |
| Booking Tiket | ❌ | ❌ | ✅ |
| Chat Admin | ❌ | ❌ | ✅ |
| Withdrawal | ❌ | ❌ | ✅ |

---

## ⚙️ Teknologi

| Teknologi | Kegunaan |
|-----------|----------|
| [Laravel 12](https://laravel.com) | Framework PHP |
| [Tailwind CSS 4](https://tailwindcss.com) | CSS framework |
| [Alpine.js](https://alpinejs.dev) | Interaktivitas frontend |
| [MySQL](https://mysql.com) | Database |
| [Vite](https://vitejs.dev) | Build tool frontend |
| [Laravel Breeze](https://laravel.com/docs/starter-kits) | Autentikasi |
| [mpdf](https://mpdf.github.io) | Export PDF |
| [PHPWord](https://github.com/PHPOffice/PHPWord) | Export Word |

---

## 📦 Struktur Direktori

```
app/
├── Console/Commands/        # Artisan commands (ExpireBookings)
├── Http/
│   ├── Controllers/
│   │   ├── Admin/           # Admin controllers
│   │   └── User/            # User controllers
│   └── ...
├── Models/                   # Eloquent models
├── ...
database/
├── migrations/               # Struktur tabel database
└── seeders/                  # Data awal (seeder)
resources/views/
├── admin/                    # View admin panel
├── auth/                     # View autentikasi Breeze
├── user/                     # View user panel
├── layouts/                  # Layout utama
└── components/               # Blade components
routes/
├── web.php                   # Route utama
└── auth.php                  # Route autentikasi
```

---

## 🧪 Menjalankan Tests

```bash
php artisan test
```

---

## 📜 Lisensi

Proyek ini dikembangkan untuk keperluan tugas **APS Project**.
