# Transaction Expiration System

## Overview
Sistem ini secara otomatis menandai transaksi sebagai "Kadaluarsa" setelah 2 jam tidak ada perubahan status.

## Fitur yang Ditambahkan

### 1. Status Transaksi
- **Baru (new)**: Status default untuk transaksi baru
- **Lunas (paid)**: Transaksi yang sudah dibayar
- **Dibatalkan (cancel)**: Transaksi yang dibatalkan (stok dikembalikan)
- **Kadaluarsa (expired)**: Transaksi yang tidak diproses dalam 2 jam

### 2. Tombol Aksi
- **Tandai Lunas**: Mengubah status dari "Baru" ke "Lunas"
- **Batalkan**: Mengubah status ke "Dibatalkan" dan mengembalikan stok
- **Tandai Kadaluarsa**: Mengubah status ke "Kadaluarsa" (manual)

### 3. Validasi
- Hanya transaksi dengan status "Baru" yang dapat diubah
- Transaksi harus berusia minimal 2 jam untuk dapat ditandai sebagai kadaluarsa
- Stok otomatis dikembalikan saat transaksi dibatalkan

## Setup Scheduled Task

### Untuk Development (Manual)
Jalankan command secara manual untuk testing:
```bash
php artisan transactions:mark-expired
```

### Untuk Production (Otomatis)
Tambahkan cron job untuk menjalankan scheduler Laravel:

1. Buka crontab:
```bash
crontab -e
```

2. Tambahkan baris berikut:
```bash
* * * * * cd /path/to/your/project && php artisan schedule:run >> /dev/null 2>&1
```

3. Command akan berjalan setiap 15 menit untuk mengecek transaksi yang kadaluarsa.

## Command yang Tersedia

### MarkExpiredTransactions
- **Command**: `php artisan transactions:mark-expired`
- **Fungsi**: Menandai transaksi sebagai kadaluarsa jika sudah 2 jam tidak berubah
- **Jadwal**: Setiap 15 menit (via scheduler)

## Routes yang Ditambahkan

```php
Route::post('/transactions/{id}/mark-as-paid', [TransactionController::class, 'markAsPaid'])->name('transactions.mark-as-paid');
Route::post('/transactions/{id}/cancel', [TransactionController::class, 'cancel'])->name('transactions.cancel');
Route::post('/transactions/{id}/mark-as-expired', [TransactionController::class, 'markAsExpired'])->name('transactions.mark-as-expired');
```

## Testing

1. Buat transaksi baru
2. Tunggu 2 jam atau gunakan tombol "Kadaluarsa" untuk testing
3. Jalankan command `php artisan transactions:mark-expired`
4. Periksa status transaksi di daftar transaksi 