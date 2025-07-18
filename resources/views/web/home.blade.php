@extends('web.layouts.app')

@section('title', 'POS System - Solusi Point of Sale Terbaik untuk Bisnis Anda')
@section('description', 'Sistem POS modern dengan fitur lengkap untuk mengelola transaksi, inventori, dan laporan bisnis Anda dengan mudah dan efisien.')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
                <h1 class="text-4xl lg:text-6xl font-bold mb-6">
                    Sistem POS Modern untuk Bisnis Anda
                </h1>
                <p class="text-xl mb-8 text-blue-100">
                    Kelola transaksi, inventori, dan laporan dengan mudah. Tingkatkan efisiensi bisnis Anda dengan sistem point of sale yang terpercaya.
                </p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('demo') }}" class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition duration-300 text-center">
                        <i class="fas fa-play mr-2"></i>Coba Demo
                    </a>
                    <a href="{{ route('features') }}" class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-blue-600 transition duration-300 text-center">
                        <i class="fas fa-info-circle mr-2"></i>Pelajari Fitur
                    </a>
                </div>
            </div>
            <div class="text-center">
                <i class="fas fa-cash-register text-8xl text-blue-200"></i>
            </div>
        </div>
    </div>
</section>

<!-- Features Overview -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">
                Mengapa Memilih POS System Kami?
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Sistem POS yang dirancang khusus untuk memenuhi kebutuhan bisnis modern dengan fitur-fitur canggih dan antarmuka yang user-friendly.
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Feature 1 -->
            <div class="bg-gray-50 p-8 rounded-lg hover:shadow-lg transition duration-300">
                <div class="text-blue-600 mb-4">
                    <i class="fas fa-shopping-cart text-3xl"></i>
                </div>
                <h3 class="text-xl font-semibold mb-3">Transaksi Cepat</h3>
                <p class="text-gray-600">
                    Proses transaksi yang cepat dan mudah dengan antarmuka yang intuitif. Hemat waktu dan tingkatkan kepuasan pelanggan.
                </p>
            </div>
            
            <!-- Feature 2 -->
            <div class="bg-gray-50 p-8 rounded-lg hover:shadow-lg transition duration-300">
                <div class="text-blue-600 mb-4">
                    <i class="fas fa-boxes text-3xl"></i>
                </div>
                <h3 class="text-xl font-semibold mb-3">Manajemen Inventori</h3>
                <p class="text-gray-600">
                    Kelola stok produk dengan mudah. Pantau inventori real-time dan dapatkan notifikasi stok menipis otomatis.
                </p>
            </div>
            
            <!-- Feature 3 -->
            <div class="bg-gray-50 p-8 rounded-lg hover:shadow-lg transition duration-300">
                <div class="text-blue-600 mb-4">
                    <i class="fas fa-chart-line text-3xl"></i>
                </div>
                <h3 class="text-xl font-semibold mb-3">Laporan Lengkap</h3>
                <p class="text-gray-600">
                    Laporan penjualan, profit, dan analisis bisnis yang detail. Buat keputusan bisnis yang lebih baik dengan data yang akurat.
                </p>
            </div>
            
            <!-- Feature 4 -->
            <div class="bg-gray-50 p-8 rounded-lg hover:shadow-lg transition duration-300">
                <div class="text-blue-600 mb-4">
                    <i class="fas fa-users text-3xl"></i>
                </div>
                <h3 class="text-xl font-semibold mb-3">Multi-User</h3>
                <p class="text-gray-600">
                    Sistem role-based access control. Kelola akses karyawan dengan mudah dan aman sesuai dengan tanggung jawab masing-masing.
                </p>
            </div>
            
            <!-- Feature 5 -->
            <div class="bg-gray-50 p-8 rounded-lg hover:shadow-lg transition duration-300">
                <div class="text-blue-600 mb-4">
                    <i class="fas fa-mobile-alt text-3xl"></i>
                </div>
                <h3 class="text-xl font-semibold mb-3">Responsive Design</h3>
                <p class="text-gray-600">
                    Akses sistem dari berbagai perangkat. Kompatibel dengan desktop, tablet, dan smartphone untuk fleksibilitas maksimal.
                </p>
            </div>
            
            <!-- Feature 6 -->
            <div class="bg-gray-50 p-8 rounded-lg hover:shadow-lg transition duration-300">
                <div class="text-blue-600 mb-4">
                    <i class="fas fa-shield-alt text-3xl"></i>
                </div>
                <h3 class="text-xl font-semibold mb-3">Keamanan Tinggi</h3>
                <p class="text-gray-600">
                    Sistem keamanan yang kuat dengan enkripsi data dan backup otomatis. Lindungi data bisnis Anda dengan teknologi terkini.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Statistics -->
<section class="py-20 bg-blue-600 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 text-center">
            <div>
                <div class="text-4xl font-bold mb-2">1000+</div>
                <div class="text-blue-200">Bisnis Aktif</div>
            </div>
            <div>
                <div class="text-4xl font-bold mb-2">50K+</div>
                <div class="text-blue-200">Transaksi/Hari</div>
            </div>
            <div>
                <div class="text-4xl font-bold mb-2">99.9%</div>
                <div class="text-blue-200">Uptime</div>
            </div>
            <div>
                <div class="text-4xl font-bold mb-2">24/7</div>
                <div class="text-blue-200">Support</div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 bg-gray-50">
    <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-6">
            Siap Meningkatkan Bisnis Anda?
        </h2>
        <p class="text-xl text-gray-600 mb-8">
            Bergabunglah dengan ribuan bisnis yang telah mempercayai POS System kami untuk mengelola operasional mereka.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('pricing') }}" class="bg-blue-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-blue-700 transition duration-300">
                Lihat Harga
            </a>
            <a href="{{ route('contact') }}" class="border-2 border-blue-600 text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-blue-600 hover:text-white transition duration-300">
                Hubungi Kami
            </a>
        </div>
    </div>
</section>
@endsection 