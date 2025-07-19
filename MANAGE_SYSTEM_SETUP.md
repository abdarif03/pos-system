# Manage System Setup

## Overview
Sistem manajemen untuk mengelola data client yang melakukan registrasi melalui web. Sistem ini berjalan di subdomain `manage.pos-system.test` dan menyediakan dashboard untuk monitoring client, mengelola user access, dan mengelola laporan pembayaran.

## Fitur Utama

### 1. Dashboard
- **Statistik Client**: Menampilkan jumlah client aktif berdasarkan jenis paket (basic, premium, enterprise)
- **Total Revenue**: Menampilkan total pendapatan dari pembayaran yang disetujui
- **Pending Payments**: Menampilkan jumlah pembayaran yang masih pending
- **Recent Payments**: Menampilkan 10 pembayaran terbaru
- **Quick Actions**: Tombol cepat untuk menambah client, payment, dan user

### 2. Client Management
- **Daftar Client**: Menampilkan semua client dengan fitur filter dan search
- **Tambah Client**: Form untuk menambah client baru
- **Edit Client**: Mengubah data client
- **Detail Client**: Melihat detail lengkap client termasuk payment history
- **Aktivasi/Deaktivasi**: Mengaktifkan atau menonaktifkan client
- **Filter**: Filter berdasarkan status dan package type
- **Search**: Pencarian berdasarkan nama, email, atau nama perusahaan

### 3. Payment Management
- **Daftar Payment**: Menampilkan semua pembayaran dengan fitur filter
- **Tambah Payment**: Mencatat pembayaran baru
- **Edit Payment**: Mengubah data pembayaran
- **Approve/Reject**: Menyetujui atau menolak pembayaran
- **Export CSV**: Mengekspor data pembayaran ke file CSV
- **Filter**: Filter berdasarkan status, client, dan rentang tanggal

### 4. User Access Management
- **Daftar User**: Menampilkan semua user dengan role
- **Tambah User**: Menambah user baru dengan role
- **Edit User**: Mengubah data user dan password
- **Delete User**: Menghapus user

## Struktur Database

### Tabel `clients`
- `id` - Primary key
- `name` - Nama client
- `email` - Email client (unique)
- `phone` - Nomor telepon
- `company_name` - Nama perusahaan
- `package_type` - Jenis paket (basic, premium, enterprise)
- `status` - Status client (active, inactive)
- `registration_date` - Tanggal registrasi
- `expiry_date` - Tanggal berakhir
- `notes` - Catatan tambahan
- `created_at`, `updated_at` - Timestamps

### Tabel `payments`
- `id` - Primary key
- `client_id` - Foreign key ke tabel clients
- `amount` - Jumlah pembayaran
- `payment_method` - Metode pembayaran (bank_transfer, cash, credit_card, other)
- `status` - Status pembayaran (pending, approved, rejected)
- `payment_date` - Tanggal pembayaran
- `due_date` - Tanggal jatuh tempo
- `description` - Deskripsi pembayaran
- `reference_number` - Nomor referensi
- `created_at`, `updated_at` - Timestamps

## Routing

### Authentication Routes
- `GET /` - Redirect ke dashboard jika login, ke login jika belum
- `GET /login` - Halaman login
- `POST /login` - Proses login
- `POST /logout` - Proses logout

### Protected Routes
- `GET /dashboard` - Dashboard utama
- `GET /clients` - Daftar client
- `GET /clients/create` - Form tambah client
- `POST /clients/store` - Simpan client baru
- `GET /clients/{client}` - Detail client
- `GET /clients/{client}/edit` - Form edit client
- `PUT /clients/{client}` - Update client
- `DELETE /clients/{client}` - Hapus client
- `POST /clients/{client}/activate` - Aktivasi client
- `POST /clients/{client}/deactivate` - Deaktivasi client

- `GET /payments` - Daftar payment
- `GET /payments/create` - Form tambah payment
- `POST /payments/store` - Simpan payment baru
- `GET /payments/{payment}` - Detail payment
- `GET /payments/{payment}/edit` - Form edit payment
- `PUT /payments/{payment}` - Update payment
- `DELETE /payments/{payment}` - Hapus payment
- `POST /payments/{payment}/approve` - Approve payment
- `POST /payments/{payment}/reject` - Reject payment
- `GET /payments/export` - Export payment ke CSV

- `GET /users` - Daftar user
- `GET /users/create` - Form tambah user
- `POST /users/store` - Simpan user baru
- `GET /users/{user}/edit` - Form edit user
- `PUT /users/{user}` - Update user
- `DELETE /users/{user}` - Hapus user

## Controller Structure

### Manage\AuthController
- `showLoginForm()` - Tampilkan form login
- `login()` - Proses login
- `logout()` - Proses logout

### Manage\DashboardController
- `index()` - Dashboard dengan statistik

### Manage\ClientController
- `index()` - Daftar client dengan filter
- `create()` - Form tambah client
- `store()` - Simpan client
- `show()` - Detail client
- `edit()` - Form edit client
- `update()` - Update client
- `destroy()` - Hapus client
- `activate()` - Aktivasi client
- `deactivate()` - Deaktivasi client

### Manage\PaymentController
- `index()` - Daftar payment dengan filter
- `create()` - Form tambah payment
- `store()` - Simpan payment
- `show()` - Detail payment
- `edit()` - Form edit payment
- `update()` - Update payment
- `destroy()` - Hapus payment
- `approve()` - Approve payment
- `reject()` - Reject payment
- `export()` - Export ke CSV

### Manage\UserAccessController
- `index()` - Daftar user
- `create()` - Form tambah user
- `store()` - Simpan user
- `edit()` - Form edit user
- `update()` - Update user
- `destroy()` - Hapus user

## Model Relationships

### Client Model
- `payments()` - HasMany ke Payment
- `users()` - HasMany ke User
- Scopes: `active()`, `inactive()`

### Payment Model
- `client()` - BelongsTo ke Client
- Scopes: `approved()`, `pending()`, `rejected()`

## Setup Instructions

### 1. Database Migration
```bash
php artisan migrate
```

### 2. Clear Cache
```bash
php artisan config:clear
php artisan route:clear
php artisan cache:clear
```

### 3. Access URLs
- **Dashboard**: `manage.pos-system.test/dashboard`
- **Login**: `manage.pos-system.test/login`
- **Clients**: `manage.pos-system.test/clients`
- **Payments**: `manage.pos-system.test/payments`
- **Users**: `manage.pos-system.test/users`

### 4. Authentication
Sistem menggunakan authentication Laravel default. Pastikan ada user dengan role yang sesuai untuk mengakses manage system.

## File Structure
```
app/
├── Http/Controllers/Manage/
│   ├── AuthController.php
│   ├── DashboardController.php
│   ├── ClientController.php
│   ├── PaymentController.php
│   └── UserAccessController.php
├── Models/
│   ├── Client.php
│   └── Payment.php
resources/views/manage/
├── layouts/
│   └── app.blade.php
├── auth/
│   └── login.blade.php
└── dashboard.blade.php
routes/
└── manage.php
database/migrations/
├── create_clients_table.php
└── create_payments_table.php
```

## Security Features
- Authentication required untuk semua route kecuali login
- CSRF protection
- Input validation
- Role-based access control (menggunakan model Role yang sudah ada)
- Session management

## Future Enhancements
- Email notifications untuk payment status changes
- Dashboard charts dan graphs
- Bulk operations untuk client dan payment
- API endpoints untuk integration
- Advanced reporting dan analytics
- Multi-language support 