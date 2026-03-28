@extends('web.layouts.app')

@section('title', 'Pendaftaran berhasil')
@section('description', 'Terima kasih telah mendaftar POS System.')

@section('content')
<section class="py-24 bg-white">
    <div class="max-w-lg mx-auto px-4 text-center">
        <i class="fas fa-envelope-open-text text-5xl text-blue-600 mb-6"></i>
        <h1 class="text-3xl font-bold text-gray-900 mb-4">Pendaftaran berhasil</h1>
        @if(session('success'))
            <p class="text-gray-600 mb-8">{{ session('success') }}</p>
        @else
            <p class="text-gray-600 mb-8">Periksa kotak masuk email Anda untuk kredensial login.</p>
        @endif
        <a href="{{ route('home') }}" class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700">
            Kembali ke beranda
        </a>
    </div>
</section>
@endsection
