# Manage System Login Credentials

## User Accounts untuk Manage System

### 1. System Administrator
- **Email**: `admin@pos-system.test`
- **Password**: `admin123`
- **Role**: Admin
- **Access**: Full access to all features
- **Permissions**: All permissions (`*`)

### 2. Client Manager
- **Email**: `manager@pos-system.test`
- **Password**: `manager123`
- **Role**: Manager
- **Access**: Manage clients and payments
- **Permissions**: `clients.*`, `payments.*`, `users.read`

### 3. Payment Supervisor
- **Email**: `supervisor@pos-system.test`
- **Password**: `supervisor123`
- **Role**: Manager
- **Access**: Manage clients and payments
- **Permissions**: `clients.*`, `payments.*`, `users.read`

## Cara Login

1. Buka browser dan akses: `manage.pos-system.test/login`
2. Masukkan email dan password sesuai akun di atas
3. Klik "Sign in"
4. Setelah login berhasil, akan diarahkan ke dashboard

## Sample Data yang Tersedia

### Client Data (8 clients)
1. **Ahmad Rahman** - Toko Saya Jaya (Premium, Active)
2. **Siti Nurhaliza** - Warung Makan Sederhana (Basic, Active)
3. **Budi Santoso** - Supermarket Makmur (Enterprise, Active)
4. **Dewi Sartika** - Cafe Kopi Nusantara (Premium, Active)
5. **Rudi Hermawan** - Toserba Rudi (Basic, Inactive)
6. **Maya Indah** - Salon Maya Indah (Premium, Active)
7. **Joko Widodo** - Apotek Sehat (Enterprise, Active)
8. **Sri Wahyuni** - Bengkel Motor Sri (Basic, Active)

### Payment Data
- Setiap client memiliki 2-4 pembayaran
- Total sekitar 20+ pembayaran dengan status bervariasi
- Metode pembayaran: bank_transfer, cash, credit_card
- Status: pending, approved, rejected

### Package Types dan Pricing
- **Basic**: Rp 500.000 - Rp 1.000.000
- **Premium**: Rp 1.500.000 - Rp 2.500.000
- **Enterprise**: Rp 3.000.000 - Rp 5.000.000

## Dashboard Statistics

Setelah login, dashboard akan menampilkan:
- **Total Clients**: 8
- **Active Clients**: 7 (1 inactive)
- **Total Revenue**: Berdasarkan pembayaran approved
- **Pending Payments**: Berdasarkan pembayaran pending
- **Client Statistics by Package**: Breakdown per jenis paket
- **Recent Payments**: 10 pembayaran terbaru

## Testing Scenarios

### 1. Dashboard Testing
- Login dengan admin@pos-system.test
- Periksa statistik di dashboard
- Klik quick actions untuk navigasi

### 2. Client Management Testing
- Akses menu Clients
- Test filter berdasarkan status dan package type
- Test search functionality
- Tambah client baru
- Edit client existing
- Aktivasi/deaktivasi client

### 3. Payment Management Testing
- Akses menu Payments
- Test filter berdasarkan status, client, dan tanggal
- Approve/reject pembayaran
- Export data ke CSV
- Tambah payment baru

### 4. User Management Testing
- Akses menu Users
- Tambah user baru
- Edit user existing
- Hapus user

## Security Notes

- Password menggunakan Hash::make() untuk keamanan
- Role-based access control aktif
- CSRF protection enabled
- Session management aktif

## Troubleshooting

### Jika tidak bisa login:
1. Pastikan database migration sudah dijalankan
2. Pastikan seeder sudah dijalankan
3. Clear cache: `php artisan cache:clear`
4. Periksa konfigurasi session

### Jika data tidak muncul:
1. Jalankan seeder: `php artisan db:seed --class=ManageDataSeeder`
2. Periksa koneksi database
3. Periksa log error di `storage/logs/laravel.log`

## Commands untuk Recreate Data

```bash
# Jalankan migration
php artisan migrate:fresh

# Jalankan semua seeder
php artisan db:seed

# Atau jalankan seeder specific
php artisan db:seed --class=ManageUserSeeder
php artisan db:seed --class=ManageDataSeeder
``` 