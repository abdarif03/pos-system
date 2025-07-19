# Domain Separation Fix

## Masalah
Saat mengakses `www.pos-system.test`, pengguna selalu diarahkan ke `client.pos-system.test/login` atau `client.pos-system.test/dashboard` meskipun seharusnya menampilkan halaman web profile.

## Penyebab
1. **Session Cookie Sharing**: Session cookie dibagikan antara domain `www.pos-system.test` dan `client.pos-system.test`
2. **Middleware Configuration**: Middleware `client` yang tidak tepat di `RouteServiceProvider.php`
3. **Domain Constraint Redundancy**: Domain constraint ganda di `routes/client.php`
4. **Global Authentication Redirect**: Konfigurasi `redirectGuestsTo('/login')` di bootstrap/app.php mempengaruhi semua domain
5. **Session Store Error**: Konfigurasi session database yang menyebabkan "session store not set on request"

## Solusi yang Diterapkan

### 1. Perbaikan RouteServiceProvider.php
- Mengganti middleware `client` dengan middleware `web` untuk domain `client.pos-system.test`
- Memastikan routing terpisah dengan benar antara web profile dan POS application

### 2. Perbaikan routes/client.php
- Menghapus domain constraint redundan (`Route::domain('client.pos-system.test')`)
- Domain constraint sudah ditangani di `RouteServiceProvider.php`

### 3. Perbaikan Session Configuration
- Mengubah session driver dari `database` ke `file` untuk menghindari session store error
- Menghapus middleware kompleks yang mengganggu session handling

### 4. Simplified Middleware Approach
- Menghapus middleware kompleks yang menyebabkan konflik session
- Menggunakan route-level middleware untuk authentication di domain client
- Domain web profile tidak menggunakan middleware authentication

### 5. Perbaikan bootstrap/app.php
- Menghapus konfigurasi global `redirectGuestsTo('/login')`
- Menghapus middleware yang bermasalah
- Menggunakan pendekatan sederhana tanpa mengganggu session

## Hasil
Sekarang domain terpisah dengan benar:
- **www.pos-system.test** → Halaman web profile (home, features, pricing, dll.) **TANPA authentication**
- **client.pos-system.test** → Aplikasi POS (login, dashboard, transaksi, dll.) **DENGAN authentication**

## Testing
Untuk memastikan fix berhasil:
1. Akses `www.pos-system.test` → Harus menampilkan halaman web profile tanpa redirect
2. Akses `client.pos-system.test` → Harus menampilkan halaman login atau dashboard (jika sudah login)
3. Session tidak boleh dibagikan antara kedua domain
4. Authentication hanya berlaku di domain client
5. Tidak ada error "session store not set on request"

## File yang Dimodifikasi
- `app/Providers/RouteServiceProvider.php`
- `routes/client.php`
- `bootstrap/app.php`
- `config/session.php`
- `app/Http/Middleware/DomainRedirectMiddleware.php` (baru, sederhana)
- `app/Http/Middleware/DomainSessionMiddleware.php` (dihapus)
- `app/Http/Middleware/ClientAuthMiddleware.php` (dihapus)
- `app/Http/Middleware/CheckDomain.php` (dihapus) 