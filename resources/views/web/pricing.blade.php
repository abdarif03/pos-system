@extends('web.layouts.app')

@section('title', 'Harga POS System - Paket Terjangkau untuk Bisnis Anda')
@section('description', 'Pilih paket POS System yang sesuai dengan kebutuhan bisnis Anda. Harga terjangkau dengan fitur lengkap.')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl lg:text-6xl font-bold mb-6">
            Pilih Paket yang Tepat
        </h1>
        <p class="text-xl text-blue-100 max-w-3xl mx-auto">
            Berbagai paket dengan harga terjangkau untuk bisnis dari skala kecil hingga enterprise
        </p>
    </div>
</section>

<!-- Pricing Plans -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Basic Plan -->
            <div class="bg-white border-2 border-gray-200 rounded-lg p-8 hover:shadow-lg transition duration-300">
                <div class="text-center mb-8">
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Basic</h3>
                    <div class="text-4xl font-bold text-blue-600 mb-2">Rp 299K</div>
                    <div class="text-gray-600">per bulan</div>
                </div>
                
                <ul class="space-y-4 mb-8">
                    <li class="flex items-center">
                        <i class="fas fa-check text-green-500 mr-3"></i>
                        <span>Hingga 1 outlet</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-check text-green-500 mr-3"></i>
                        <span>3 user aktif</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-check text-green-500 mr-3"></i>
                        <span>Manajemen produk</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-check text-green-500 mr-3"></i>
                        <span>Transaksi POS</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-check text-green-500 mr-3"></i>
                        <span>Laporan dasar</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-check text-green-500 mr-3"></i>
                        <span>Email support</span>
                    </li>
                </ul>
                
                <a href="{{ route('contact') }}" class="w-full bg-gray-600 text-white py-3 px-6 rounded-lg font-semibold hover:bg-gray-700 transition duration-300 text-center block">
                    Pilih Paket
                </a>
            </div>
            
            <!-- Professional Plan -->
            <div class="bg-white border-2 border-blue-600 rounded-lg p-8 hover:shadow-lg transition duration-300 relative">
                <div class="absolute -top-4 left-1/2 transform -translate-x-1/2">
                    <span class="bg-blue-600 text-white px-4 py-1 rounded-full text-sm font-semibold">Terpopuler</span>
                </div>
                
                <div class="text-center mb-8">
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Professional</h3>
                    <div class="text-4xl font-bold text-blue-600 mb-2">Rp 599K</div>
                    <div class="text-gray-600">per bulan</div>
                </div>
                
                <ul class="space-y-4 mb-8">
                    <li class="flex items-center">
                        <i class="fas fa-check text-green-500 mr-3"></i>
                        <span>Hingga 5 outlet</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-check text-green-500 mr-3"></i>
                        <span>10 user aktif</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-check text-green-500 mr-3"></i>
                        <span>Semua fitur Basic</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-check text-green-500 mr-3"></i>
                        <span>Laporan lengkap</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-check text-green-500 mr-3"></i>
                        <span>Analisis profit</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-check text-green-500 mr-3"></i>
                        <span>Export PDF</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-check text-green-500 mr-3"></i>
                        <span>Priority support</span>
                    </li>
                </ul>
                
                <a href="{{ route('contact') }}" class="w-full bg-blue-600 text-white py-3 px-6 rounded-lg font-semibold hover:bg-blue-700 transition duration-300 text-center block">
                    Pilih Paket
                </a>
            </div>
            
            <!-- Enterprise Plan -->
            <div class="bg-white border-2 border-gray-200 rounded-lg p-8 hover:shadow-lg transition duration-300">
                <div class="text-center mb-8">
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Enterprise</h3>
                    <div class="text-4xl font-bold text-blue-600 mb-2">Rp 1.299K</div>
                    <div class="text-gray-600">per bulan</div>
                </div>
                
                <ul class="space-y-4 mb-8">
                    <li class="flex items-center">
                        <i class="fas fa-check text-green-500 mr-3"></i>
                        <span>Outlet unlimited</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-check text-green-500 mr-3"></i>
                        <span>User unlimited</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-check text-green-500 mr-3"></i>
                        <span>Semua fitur Professional</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-check text-green-500 mr-3"></i>
                        <span>API access</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-check text-green-500 mr-3"></i>
                        <span>Custom integration</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-check text-green-500 mr-3"></i>
                        <span>Dedicated support</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-check text-green-500 mr-3"></i>
                        <span>Training & onboarding</span>
                    </li>
                </ul>
                
                <a href="{{ route('contact') }}" class="w-full bg-gray-600 text-white py-3 px-6 rounded-lg font-semibold hover:bg-gray-700 transition duration-300 text-center block">
                    Pilih Paket
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Features Comparison -->
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Perbandingan Fitur</h2>
            <p class="text-xl text-gray-600">Lihat perbedaan fitur antar paket</p>
        </div>
        
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Fitur</th>
                        <th class="px-6 py-4 text-center text-sm font-semibold text-gray-900">Basic</th>
                        <th class="px-6 py-4 text-center text-sm font-semibold text-gray-900">Professional</th>
                        <th class="px-6 py-4 text-center text-sm font-semibold text-gray-900">Enterprise</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <tr>
                        <td class="px-6 py-4 text-sm text-gray-900">Jumlah Outlet</td>
                        <td class="px-6 py-4 text-center text-sm text-gray-600">1</td>
                        <td class="px-6 py-4 text-center text-sm text-gray-600">5</td>
                        <td class="px-6 py-4 text-center text-sm text-gray-600">Unlimited</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 text-sm text-gray-900">Jumlah User</td>
                        <td class="px-6 py-4 text-center text-sm text-gray-600">3</td>
                        <td class="px-6 py-4 text-center text-sm text-gray-600">10</td>
                        <td class="px-6 py-4 text-center text-sm text-gray-600">Unlimited</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 text-sm text-gray-900">Transaksi POS</td>
                        <td class="px-6 py-4 text-center"><i class="fas fa-check text-green-500"></i></td>
                        <td class="px-6 py-4 text-center"><i class="fas fa-check text-green-500"></i></td>
                        <td class="px-6 py-4 text-center"><i class="fas fa-check text-green-500"></i></td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 text-sm text-gray-900">Manajemen Produk</td>
                        <td class="px-6 py-4 text-center"><i class="fas fa-check text-green-500"></i></td>
                        <td class="px-6 py-4 text-center"><i class="fas fa-check text-green-500"></i></td>
                        <td class="px-6 py-4 text-center"><i class="fas fa-check text-green-500"></i></td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 text-sm text-gray-900">Laporan Lengkap</td>
                        <td class="px-6 py-4 text-center"><i class="fas fa-times text-red-500"></i></td>
                        <td class="px-6 py-4 text-center"><i class="fas fa-check text-green-500"></i></td>
                        <td class="px-6 py-4 text-center"><i class="fas fa-check text-green-500"></i></td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 text-sm text-gray-900">Analisis Profit</td>
                        <td class="px-6 py-4 text-center"><i class="fas fa-times text-red-500"></i></td>
                        <td class="px-6 py-4 text-center"><i class="fas fa-check text-green-500"></i></td>
                        <td class="px-6 py-4 text-center"><i class="fas fa-check text-green-500"></i></td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 text-sm text-gray-900">Export PDF</td>
                        <td class="px-6 py-4 text-center"><i class="fas fa-times text-red-500"></i></td>
                        <td class="px-6 py-4 text-center"><i class="fas fa-check text-green-500"></i></td>
                        <td class="px-6 py-4 text-center"><i class="fas fa-check text-green-500"></i></td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 text-sm text-gray-900">API Access</td>
                        <td class="px-6 py-4 text-center"><i class="fas fa-times text-red-500"></i></td>
                        <td class="px-6 py-4 text-center"><i class="fas fa-times text-red-500"></i></td>
                        <td class="px-6 py-4 text-center"><i class="fas fa-check text-green-500"></i></td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 text-sm text-gray-900">Dedicated Support</td>
                        <td class="px-6 py-4 text-center"><i class="fas fa-times text-red-500"></i></td>
                        <td class="px-6 py-4 text-center"><i class="fas fa-times text-red-500"></i></td>
                        <td class="px-6 py-4 text-center"><i class="fas fa-check text-green-500"></i></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="py-20 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Pertanyaan Umum</h2>
            <p class="text-xl text-gray-600">Temukan jawaban untuk pertanyaan yang sering diajukan</p>
        </div>
        
        <div class="space-y-6">
            <div class="bg-gray-50 rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Apakah ada biaya setup?</h3>
                <p class="text-gray-600">Tidak ada biaya setup. Anda dapat langsung menggunakan sistem setelah berlangganan.</p>
            </div>
            
            <div class="bg-gray-50 rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Bisakah saya upgrade paket nanti?</h3>
                <p class="text-gray-600">Ya, Anda dapat upgrade paket kapan saja. Biaya akan disesuaikan secara prorata.</p>
            </div>
            
            <div class="bg-gray-50 rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Apakah ada trial gratis?</h3>
                <p class="text-gray-600">Ya, kami menyediakan trial gratis selama 14 hari untuk semua paket.</p>
            </div>
            
            <div class="bg-gray-50 rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Bagaimana dengan keamanan data?</h3>
                <p class="text-gray-600">Data Anda aman dengan enkripsi SSL dan backup otomatis setiap hari.</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 bg-blue-600 text-white">
    <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl lg:text-4xl font-bold mb-6">
            Mulai Sekarang
        </h2>
        <p class="text-xl mb-8 text-blue-100">
            Pilih paket yang sesuai dan mulai tingkatkan bisnis Anda dengan POS System.
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