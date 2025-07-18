@extends('web.layouts.app')

@section('title', 'Demo POS System - Coba Gratis Sekarang')
@section('description', 'Coba demo POS System secara gratis. Rasakan kemudahan mengelola bisnis dengan sistem POS modern.')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl lg:text-6xl font-bold mb-6">
            Coba Demo Gratis
        </h1>
        <p class="text-xl text-blue-100 max-w-3xl mx-auto">
            Rasakan kemudahan menggunakan POS System dengan demo interaktif. Tidak perlu kartu kredit, langsung coba sekarang!
        </p>
    </div>
</section>

<!-- Demo Features -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Apa yang Bisa Anda Coba?</h2>
            <p class="text-xl text-gray-600">Jelajahi semua fitur POS System dalam demo interaktif</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
            <div class="text-center">
                <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-shopping-cart text-2xl text-blue-600"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-3">Transaksi POS</h3>
                <p class="text-gray-600">Coba proses transaksi dari awal hingga selesai dengan data dummy</p>
            </div>
            
            <div class="text-center">
                <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-boxes text-2xl text-blue-600"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-3">Manajemen Produk</h3>
                <p class="text-gray-600">Kelola produk, kategori, dan stok dengan antarmuka yang mudah</p>
            </div>
            
            <div class="text-center">
                <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-chart-line text-2xl text-blue-600"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-3">Laporan & Analisis</h3>
                <p class="text-gray-600">Lihat berbagai jenis laporan dan analisis bisnis yang detail</p>
            </div>
            
            <div class="text-center">
                <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-users text-2xl text-blue-600"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-3">Manajemen User</h3>
                <p class="text-gray-600">Atur role dan permission pengguna sesuai kebutuhan bisnis</p>
            </div>
            
            <div class="text-center">
                <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-file-pdf text-2xl text-blue-600"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-3">Export Laporan</h3>
                <p class="text-gray-600">Export laporan dalam format PDF untuk dokumentasi</p>
            </div>
            
            <div class="text-center">
                <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-mobile-alt text-2xl text-blue-600"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-3">Responsive Design</h3>
                <p class="text-gray-600">Coba akses dari berbagai perangkat: desktop, tablet, mobile</p>
            </div>
        </div>
    </div>
</section>

<!-- Demo Access -->
<section class="py-20 bg-gray-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-bold text-gray-900 mb-6">Akses Demo Sekarang</h2>
        <p class="text-xl text-gray-600 mb-8">
            Klik tombol di bawah untuk mengakses demo POS System. Anda akan diarahkan ke sistem demo dengan data dummy yang sudah disiapkan.
        </p>
        
        <div class="bg-white rounded-lg shadow-lg p-8 mb-8">
            <div class="text-center">
                <i class="fas fa-rocket text-6xl text-blue-600 mb-6"></i>
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Demo POS System</h3>
                <p class="text-gray-600 mb-6">
                    <strong>Username:</strong> demo@pos-system.com<br>
                    <strong>Password:</strong> demo1234
                </p>
                <a href="http://client.pos-system.test" target="_blank" class="inline-block bg-blue-600 text-white px-8 py-4 rounded-lg font-semibold hover:bg-blue-700 transition duration-300 text-lg">
                    <i class="fas fa-external-link-alt mr-2"></i>
                    Mulai Demo Sekarang
                </a>
            </div>
        </div>
        
        <div class="text-sm text-gray-500">
            <p>* Demo menggunakan data dummy dan akan di-reset setiap 24 jam</p>
            <p>* Tidak ada data pribadi yang akan disimpan</p>
        </div>
    </div>
</section>

<!-- Demo Benefits -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Mengapa Harus Coba Demo?</h2>
            <p class="text-xl text-gray-600">Alasan mengapa demo adalah langkah terbaik sebelum memutuskan</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <i class="fas fa-hand-holding-usd text-blue-600 text-2xl"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Gratis 100%</h3>
                    <p class="text-gray-600">Tidak ada biaya apapun untuk mencoba demo. Tidak perlu kartu kredit atau komitmen.</p>
                </div>
            </div>
            
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <i class="fas fa-clock text-blue-600 text-2xl"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Langsung Coba</h3>
                    <p class="text-gray-600">Akses instan tanpa perlu setup atau konfigurasi yang rumit.</p>
                </div>
            </div>
            
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <i class="fas fa-shield-alt text-blue-600 text-2xl"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Aman & Terpercaya</h3>
                    <p class="text-gray-600">Demo menggunakan data dummy, tidak ada risiko terhadap data bisnis Anda.</p>
                </div>
            </div>
            
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <i class="fas fa-comments text-blue-600 text-2xl"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Dukungan Langsung</h3>
                    <p class="text-gray-600">Tim kami siap membantu jika Anda memiliki pertanyaan selama demo.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Next Steps -->
<section class="py-20 bg-blue-600 text-white">
    <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl lg:text-4xl font-bold mb-6">
            Setelah Demo, Apa Selanjutnya?
        </h2>
        <p class="text-xl mb-8 text-blue-100">
            Jika Anda puas dengan demo, berikut adalah langkah selanjutnya untuk mulai menggunakan POS System
        </p>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
            <div class="bg-white bg-opacity-10 rounded-lg p-6">
                <div class="text-4xl font-bold mb-2">1</div>
                <h3 class="text-xl font-semibold mb-3">Pilih Paket</h3>
                <p class="text-blue-100">Pilih paket yang sesuai dengan kebutuhan bisnis Anda</p>
            </div>
            
            <div class="bg-white bg-opacity-10 rounded-lg p-6">
                <div class="text-4xl font-bold mb-2">2</div>
                <h3 class="text-xl font-semibold mb-3">Setup Akun</h3>
                <p class="text-blue-100">Tim kami akan membantu setup akun dan konfigurasi awal</p>
            </div>
            
            <div class="bg-white bg-opacity-10 rounded-lg p-6">
                <div class="text-4xl font-bold mb-2">3</div>
                <h3 class="text-xl font-semibold mb-3">Mulai Gunakan</h3>
                <p class="text-blue-100">Mulai gunakan POS System untuk mengelola bisnis Anda</p>
            </div>
        </div>
        
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('pricing') }}" class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition duration-300">
                Lihat Paket & Harga
            </a>
            <a href="{{ route('contact') }}" class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-blue-600 transition duration-300">
                Hubungi Sales
            </a>
        </div>
    </div>
</section>
@endsection 