@extends('web.layouts.app')

@section('title', 'Daftar POS System')
@section('description', 'Daftar sebagai klien baru dan mulai gunakan POS System.')

@section('content')
<section class="py-16 bg-gradient-to-b from-blue-50 to-white">
    <div class="max-w-xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2 text-center">Daftar klien baru</h1>
        <p class="text-gray-600 text-center mb-8">Paket: <span class="font-semibold capitalize">{{ $packageType }}</span></p>

        @if ($errors->any())
            <div class="mb-6 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg text-sm">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white rounded-xl shadow-lg p-8">
            <form method="POST" action="{{ route('client.register.store') }}">
                @csrf
                <input type="hidden" name="package_type" value="{{ $packageType }}">

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama lengkap (admin)</label>
                    <input type="text" name="name" value="" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email (untuk login)</label>
                    <input type="email" name="email" value="" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Telepon</label>
                    <input type="text" name="phone" value="{{ old('phone') }}" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama perusahaan / toko</label>
                    <input type="text" name="company_name" value="" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Alamat perusahaan / toko</label>
                    <textarea name="address" id="address" cols="30" rows="10" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('address') }}</textarea>
                </div>

                <p class="text-sm text-gray-500 mb-6">
                    Setelah daftar, Anda akan menerima email berisi password sementara untuk login di aplikasi client POS.
                    Masa evaluasi {{ (int) config('client.trial_days', 3) }} hari dihitung dari tanggal pendaftaran.
                </p>

                <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-700 transition">
                    Kirim pendaftaran
                </button>
            </form>
        </div>

        <p class="text-center mt-6 text-sm text-gray-600">
            <a href="{{ route('pricing') }}" class="text-blue-600 hover:underline">← Kembali ke harga</a>
        </p>
    </div>
</section>
@endsection
