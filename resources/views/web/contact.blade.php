@extends('web.layouts.app')

@section('title', 'Kontak Kami - POS System')
@section('description', 'Hubungi tim kami untuk informasi lebih lanjut tentang POS System atau bantuan teknis.')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl lg:text-6xl font-bold mb-6">
            Hubungi Kami
        </h1>
        <p class="text-xl text-blue-100 max-w-3xl mx-auto">
            Tim kami siap membantu Anda dengan pertanyaan atau kebutuhan terkait POS System
        </p>
    </div>
</section>

<!-- Contact Information -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Contact Form -->
            <div>
                <h2 class="text-3xl font-bold text-gray-900 mb-8">Kirim Pesan</h2>
                <form class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="first_name" class="block text-sm font-medium text-gray-700 mb-2">Nama Depan</label>
                            <input type="text" id="first_name" name="first_name" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        <div>
                            <label for="last_name" class="block text-sm font-medium text-gray-700 mb-2">Nama Belakang</label>
                            <input type="text" id="last_name" name="last_name" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                    </div>
                    
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <input type="email" id="email" name="email" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Nomor Telepon</label>
                        <input type="tel" id="phone" name="phone" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    
                    <div>
                        <label for="company" class="block text-sm font-medium text-gray-700 mb-2">Nama Perusahaan</label>
                        <input type="text" id="company" name="company" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    
                    <div>
                        <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">Subjek</label>
                        <select id="subject" name="subject" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="">Pilih subjek</option>
                            <option value="demo">Demo & Trial</option>
                            <option value="pricing">Informasi Harga</option>
                            <option value="support">Bantuan Teknis</option>
                            <option value="partnership">Kerjasama</option>
                            <option value="other">Lainnya</option>
                        </select>
                    </div>
                    
                    <div>
                        <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Pesan</label>
                        <textarea id="message" name="message" rows="6" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Tulis pesan Anda di sini..."></textarea>
                    </div>
                    
                    <button type="submit" class="w-full bg-blue-600 text-white py-3 px-6 rounded-lg font-semibold hover:bg-blue-700 transition duration-300">
                        Kirim Pesan
                    </button>
                </form>
            </div>
            
            <!-- Contact Information -->
            <div>
                <h2 class="text-3xl font-bold text-gray-900 mb-8">Informasi Kontak</h2>
                
                <div class="space-y-8">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <i class="fas fa-map-marker-alt text-blue-600 text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Alamat</h3>
                            <p class="text-gray-600">
                                Jl. Sudirman No. 123<br>
                                Jakarta Pusat, 12345<br>
                                Indonesia
                            </p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <i class="fas fa-phone text-blue-600 text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Telepon</h3>
                            <p class="text-gray-600">
                                +62 21 1234 5678<br>
                                +62 812 3456 7890
                            </p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <i class="fas fa-envelope text-blue-600 text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Email</h3>
                            <p class="text-gray-600">
                                info@pos-system.com<br>
                                support@pos-system.com
                            </p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <i class="fas fa-clock text-blue-600 text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Jam Kerja</h3>
                            <p class="text-gray-600">
                                Senin - Jumat: 08:00 - 17:00<br>
                                Sabtu: 09:00 - 15:00<br>
                                Minggu: Tutup
                            </p>
                        </div>
                    </div>
                </div>
                
                <!-- Social Media -->
                <div class="mt-12">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Ikuti Kami</h3>
                    <div class="flex space-x-4">
                        <a href="#" class="w-12 h-12 bg-blue-600 text-white rounded-lg flex items-center justify-center hover:bg-blue-700 transition duration-300">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="w-12 h-12 bg-blue-400 text-white rounded-lg flex items-center justify-center hover:bg-blue-500 transition duration-300">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="w-12 h-12 bg-pink-600 text-white rounded-lg flex items-center justify-center hover:bg-pink-700 transition duration-300">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="w-12 h-12 bg-blue-700 text-white rounded-lg flex items-center justify-center hover:bg-blue-800 transition duration-300">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="py-20 bg-gray-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Pertanyaan Umum</h2>
            <p class="text-xl text-gray-600">Temukan jawaban untuk pertanyaan yang sering diajukan</p>
        </div>
        
        <div class="space-y-6">
            <div class="bg-white rounded-lg p-6 shadow-sm">
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Bagaimana cara memulai trial gratis?</h3>
                <p class="text-gray-600">Anda dapat mendaftar trial gratis melalui halaman demo kami. Tim kami akan menghubungi Anda dalam 24 jam untuk setup akun.</p>
            </div>
            
            <div class="bg-white rounded-lg p-6 shadow-sm">
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Berapa lama waktu implementasi?</h3>
                <p class="text-gray-600">Implementasi dasar dapat selesai dalam 1-2 hari kerja. Untuk setup yang lebih kompleks, tim kami akan memberikan timeline yang detail.</p>
            </div>
            
            <div class="bg-white rounded-lg p-6 shadow-sm">
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Apakah ada training untuk karyawan?</h3>
                <p class="text-gray-600">Ya, kami menyediakan training gratis untuk paket Professional dan Enterprise. Training dapat dilakukan online atau onsite.</p>
            </div>
            
            <div class="bg-white rounded-lg p-6 shadow-sm">
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Bagaimana dengan dukungan teknis?</h3>
                <p class="text-gray-600">Kami menyediakan dukungan teknis 24/7 untuk semua paket. Response time bervariasi sesuai dengan paket yang Anda pilih.</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 bg-blue-600 text-white">
    <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl lg:text-4xl font-bold mb-6">
            Siap Memulai?
        </h2>
        <p class="text-xl mb-8 text-blue-100">
            Hubungi kami sekarang dan dapatkan solusi POS terbaik untuk bisnis Anda.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('demo') }}" class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition duration-300">
                Coba Demo Gratis
            </a>
            <a href="tel:+622112345678" class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-blue-600 transition duration-300">
                <i class="fas fa-phone mr-2"></i>Telepon Sekarang
            </a>
        </div>
    </div>
</section>
@endsection 