@extends('web.layouts.app')

@section('title', 'Tentang Kami - POS System')
@section('description', 'Kenali tim kami yang berdedikasi untuk memberikan solusi POS terbaik untuk bisnis Anda.')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl lg:text-6xl font-bold mb-6">
            Tentang Kami
        </h1>
        <p class="text-xl text-blue-100 max-w-3xl mx-auto">
            Kami adalah tim yang berdedikasi untuk membantu bisnis Anda berkembang dengan teknologi POS yang modern dan terpercaya
        </p>
    </div>
</section>

<!-- Our Story -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
                <h2 class="text-3xl font-bold text-gray-900 mb-6">Cerita Kami</h2>
                <p class="text-lg text-gray-600 mb-6">
                    POS System didirikan dengan visi untuk membantu bisnis kecil dan menengah di Indonesia mengelola operasional mereka dengan lebih efisien dan modern.
                </p>
                <p class="text-lg text-gray-600 mb-6">
                    Berawal dari pengalaman kami melihat banyak bisnis yang masih menggunakan sistem manual atau software yang tidak user-friendly, kami berkomitmen untuk menciptakan solusi yang mudah digunakan namun powerful.
                </p>
                <p class="text-lg text-gray-600">
                    Saat ini, ribuan bisnis telah mempercayai POS System untuk mengelola operasional mereka, dan kami terus berinovasi untuk memberikan pengalaman terbaik.
                </p>
            </div>
            <div class="text-center">
                <i class="fas fa-lightbulb text-8xl text-blue-200"></i>
            </div>
        </div>
    </div>
</section>

<!-- Our Mission & Vision -->
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
            <div class="text-center">
                <div class="bg-white p-8 rounded-lg shadow-lg">
                    <div class="text-blue-600 mb-4">
                        <i class="fas fa-bullseye text-4xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Misi Kami</h3>
                    <p class="text-gray-600">
                        Memberikan solusi teknologi yang terjangkau dan mudah digunakan untuk membantu bisnis Indonesia berkembang dan bersaing di era digital.
                    </p>
                </div>
            </div>
            
            <div class="text-center">
                <div class="bg-white p-8 rounded-lg shadow-lg">
                    <div class="text-blue-600 mb-4">
                        <i class="fas fa-eye text-4xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Visi Kami</h3>
                    <p class="text-gray-600">
                        Menjadi platform POS terdepan di Indonesia yang dipercaya oleh ribuan bisnis untuk mengelola operasional mereka dengan efisien dan modern.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Our Values -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Nilai-Nilai Kami</h2>
            <p class="text-xl text-gray-600">Prinsip yang memandu setiap langkah kami</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="text-center">
                <div class="text-blue-600 mb-4">
                    <i class="fas fa-heart text-4xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-3">Passion</h3>
                <p class="text-gray-600">
                    Kami memiliki passion untuk membantu bisnis berkembang dengan teknologi yang tepat.
                </p>
            </div>
            
            <div class="text-center">
                <div class="text-blue-600 mb-4">
                    <i class="fas fa-handshake text-4xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-3">Integritas</h3>
                <p class="text-gray-600">
                    Kami selalu berkomitmen untuk memberikan layanan yang jujur dan terpercaya.
                </p>
            </div>
            
            <div class="text-center">
                <div class="text-blue-600 mb-4">
                    <i class="fas fa-rocket text-4xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-3">Inovasi</h3>
                <p class="text-gray-600">
                    Kami terus berinovasi untuk memberikan solusi terbaik bagi pelanggan.
                </p>
            </div>
            
            <div class="text-center">
                <div class="text-blue-600 mb-4">
                    <i class="fas fa-users text-4xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-3">Kolaborasi</h3>
                <p class="text-gray-600">
                    Kami percaya bahwa kolaborasi dengan pelanggan adalah kunci kesuksesan.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Team -->
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Tim Kami</h2>
            <p class="text-xl text-gray-600">Bertemu dengan tim yang membuat POS System menjadi kenyataan</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="p-6 text-center">
                    <div class="w-24 h-24 bg-blue-200 rounded-full mx-auto mb-4 flex items-center justify-center">
                        <i class="fas fa-user text-3xl text-blue-600"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Ahmad Rahman</h3>
                    <p class="text-blue-600 mb-3">CEO & Founder</p>
                    <p class="text-gray-600 text-sm">
                        Memiliki pengalaman 10+ tahun di industri teknologi dan retail.
                    </p>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="p-6 text-center">
                    <div class="w-24 h-24 bg-blue-200 rounded-full mx-auto mb-4 flex items-center justify-center">
                        <i class="fas fa-user text-3xl text-blue-600"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Sarah Wijaya</h3>
                    <p class="text-blue-600 mb-3">CTO</p>
                    <p class="text-gray-600 text-sm">
                        Ahli teknologi dengan fokus pada pengembangan produk yang user-friendly.
                    </p>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="p-6 text-center">
                    <div class="w-24 h-24 bg-blue-200 rounded-full mx-auto mb-4 flex items-center justify-center">
                        <i class="fas fa-user text-3xl text-blue-600"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Budi Santoso</h3>
                    <p class="text-blue-600 mb-3">Head of Sales</p>
                    <p class="text-gray-600 text-sm">
                        Spesialis dalam memahami kebutuhan bisnis dan memberikan solusi yang tepat.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 bg-blue-600 text-white">
    <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl lg:text-4xl font-bold mb-6">
            Bergabunglah dengan Ribuan Bisnis Lainnya
        </h2>
        <p class="text-xl mb-8 text-blue-100">
            Mulai gunakan POS System sekarang dan rasakan perbedaan dalam mengelola bisnis Anda.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('demo') }}" class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition duration-300">
                Coba Demo Gratis
            </a>
            <a href="{{ route('contact') }}" class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-blue-600 transition duration-300">
                Hubungi Kami
            </a>
        </div>
    </div>
</section>
@endsection 