# Login Credentials - POS System

## User Accounts yang Tersedia

### 1. Administrator
- **Email:** `admin@pos.com`
- **Password:** `password`
- **Role:** Admin
- **Akses:** Semua fitur sistem

### 2. Cashier
- **Email:** `kasir1@pos.com`
- **Password:** `password`
- **Role:** Cashier
- **Akses:** Transaksi, produk, laporan

## Cara Login

1. Buka browser dan akses aplikasi POS
2. Klik "Login" atau akses langsung ke `/login`
3. Masukkan email dan password sesuai akun di atas
4. Klik tombol "Login"
5. Setelah berhasil, Anda akan diarahkan ke Dashboard

## Fitur yang Tersedia Setelah Login

### Dashboard
- Overview total produk, transaksi, dan user
- Transaksi terbaru
- Produk dengan stok rendah

### Transaksi
- Daftar semua transaksi
- Buat transaksi baru
- Detail transaksi
- Kelola status transaksi (Lunas, Batal, Kadaluarsa)

### Produk
- Daftar produk
- Tambah produk baru
- Edit produk
- Hapus produk

### Laporan Laba
- Dashboard laba
- Laporan harian
- Laporan mingguan
- Laporan bulanan
- Laporan tahunan

### Pengaturan
- Kelola user
- Kelola role user
- Kelola kategori produk

## Logout

Untuk logout, klik menu user di navbar (kanan atas) dan pilih "Logout".

## Troubleshooting

Jika mengalami masalah login:

1. **Pastikan email dan password benar**
2. **Cek koneksi database**
3. **Clear cache Laravel:**
   ```bash
   php artisan cache:clear
   php artisan config:clear
   php artisan route:clear
   ```
4. **Restart server Laravel**

## Keamanan

- Password default adalah `password` - segera ganti setelah login pertama
- Gunakan password yang kuat
- Jangan bagikan kredensial login
- Logout setiap kali selesai menggunakan sistem 