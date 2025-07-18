@extends('web.layouts.app')

@section('title', 'Fitur POS System - Solusi Lengkap untuk Bisnis Anda')
@section('description', 'Jelajahi fitur-fitur canggih POS System yang dirancang untuk meningkatkan efisiensi dan profitabilitas bisnis Anda.')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl lg:text-6xl font-bold mb-6">
            Fitur-Fitur Unggulan
        </h1>
        <p class="text-xl text-blue-100 max-w-3xl mx-auto">
            Sistem POS modern dengan fitur lengkap yang dirancang untuk memenuhi semua kebutuhan bisnis Anda
        </p>
    </div>
</section>

<!-- Features Detail -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Transaction Management -->
        <div class="mb-20">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Manajemen Transaksi</h2>
                <p class="text-xl text-gray-600">Proses transaksi yang cepat, aman, dan mudah</p>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <div class="space-y-6">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <i class="fas fa-shopping-cart text-blue-600 text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-900">Transaksi Cepat</h3>
                                <p class="text-gray-600">Antarmuka yang intuitif memungkinkan proses transaksi dalam hitungan detik</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <i class="fas fa-credit-card text-blue-600 text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-900">Multi-Payment</h3>
                                <p class="text-gray-600">Dukungan berbagai metode pembayaran: tunai, kartu, e-wallet</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <i class="fas fa-receipt text-blue-600 text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-900">Struk Digital</h3>
                                <p class="text-gray-600">Cetak struk atau kirim via email/WhatsApp ke pelanggan</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <i class="fas fa-undo text-blue-600 text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-900">Retur & Refund</h3>
                                <p class="text-gray-600">Kelola retur produk dan refund dengan mudah</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="text-center">
                    <i class="fas fa-cash-register text-8xl text-blue-200"></i>
                </div>
            </div>
        </div>
        
        <!-- Inventory Management -->
        <div class="mb-20">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Manajemen Inventori</h2>
                <p class="text-xl text-gray-600">Kelola stok produk dengan efisien dan akurat</p>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="text-center lg:order-2">
                    <i class="fas fa-boxes text-8xl text-blue-200"></i>
                </div>
                
                <div>
                    <div class="space-y-6">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <i class="fas fa-warehouse text-blue-600 text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-900">Stok Real-time</h3>
                                <p class="text-gray-600">Pantau stok produk secara real-time dengan update otomatis</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <i class="fas fa-exclamation-triangle text-blue-600 text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-900">Alert Stok Menipis</h3>
                                <p class="text-gray-600">Notifikasi otomatis ketika stok produk mencapai batas minimum</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <i class="fas fa-tags text-blue-600 text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-900">Kategori Produk</h3>
                                <p class="text-gray-600">Organisir produk dengan sistem kategori yang fleksibel</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <i class="fas fa-barcode text-blue-600 text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-900">Barcode Scanner</h3>
                                <p class="text-gray-600">Dukungan scanner barcode untuk input produk yang cepat</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Reporting & Analytics -->
        <div class="mb-20">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Laporan & Analisis</h2>
                <p class="text-xl text-gray-600">Data bisnis yang akurat untuk pengambilan keputusan yang tepat</p>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <div class="space-y-6">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <i class="fas fa-chart-line text-blue-600 text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-900">Laporan Penjualan</h3>
                                <p class="text-gray-600">Analisis penjualan harian, mingguan, bulanan, dan tahunan</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <i class="fas fa-dollar-sign text-blue-600 text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-900">Analisis Profit</h3>
                                <p class="text-gray-600">Hitung profit margin dan analisis keuntungan bisnis</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <i class="fas fa-file-pdf text-blue-600 text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-900">Export PDF</h3>
                                <p class="text-gray-600">Export laporan dalam format PDF untuk dokumentasi</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <i class="fas fa-chart-pie text-blue-600 text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-900">Dashboard Visual</h3>
                                <p class="text-gray-600">Visualisasi data dengan grafik dan chart yang informatif</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="text-center">
                    <i class="fas fa-chart-bar text-8xl text-blue-200"></i>
                </div>
            </div>
        </div>
        
        <!-- User Management -->
        <div class="mb-20">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Manajemen Pengguna</h2>
                <p class="text-gray-600">Kontrol akses dan keamanan sistem yang terpercaya</p>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="text-center lg:order-2">
                    <i class="fas fa-users text-8xl text-blue-200"></i>
                </div>
                
                <div>
                    <div class="space-y-6">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <i class="fas fa-user-shield text-blue-600 text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-900">Role-Based Access</h3>
                                <p class="text-gray-600">Atur hak akses berdasarkan peran: Admin, Cashier, User</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <i class="fas fa-history text-blue-600 text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-900">Activity Log</h3>
                                <p class="text-gray-600">Catatan aktivitas pengguna untuk audit dan keamanan</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <i class="fas fa-mobile-alt text-blue-600 text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-900">Multi-Device</h3>
                                <p class="text-gray-600">Akses sistem dari berbagai perangkat dengan aman</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <i class="fas fa-cloud text-blue-600 text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-900">Cloud Backup</h3>
                                <p class="text-gray-600">Backup data otomatis ke cloud untuk keamanan maksimal</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 bg-gray-50">
    <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-6">
            Siap Menggunakan Fitur-Fitur Ini?
        </h2>
        <p class="text-xl text-gray-600 mb-8">
            Mulai gunakan POS System sekarang dan rasakan perbedaan dalam mengelola bisnis Anda.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('demo') }}" class="bg-blue-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-blue-700 transition duration-300">
                Coba Demo Gratis
            </a>
            <a href="{{ route('pricing') }}" class="border-2 border-blue-600 text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-blue-600 hover:text-white transition duration-300">
                Lihat Harga
            </a>
        </div>
    </div>
</section>
@endsection 