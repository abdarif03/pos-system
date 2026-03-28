<x-mail::message>
# Selamat datang di POS System

Pendaftaran untuk **{{ $client->company_name }}** telah berhasil.

Anda dapat login ke aplikasi POS di:

<x-mail::button :url="$loginUrl">
Buka POS Client
</x-mail::button>

**URL login:** {{ $loginUrl }}

**Email:** {{ $user->email }}

**Password sementara:** `{{ $plainPassword }}`

Segera ganti password setelah login pertama demi keamanan.

Terima kasih,<br>
{{ config('app.name') }}
</x-mail::message>
