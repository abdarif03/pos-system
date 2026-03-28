@extends('manage.layouts.app')

@section('title', 'Status Langganan')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Status langganan client</h1>
        <p class="text-gray-600">Ringkasan read-only: sudah dibayar / aktif, menunggu pembayaran, atau expired (tanpa alur approval).</p>
    </div>

    <div class="bg-white rounded-lg shadow p-6 mb-6">
        <form method="GET" action="{{ route('manage.subscriptions.index') }}" class="flex flex-wrap items-end gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Filter status</label>
                <select name="status" class="w-full md:w-64 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Semua</option>
                    <option value="{{ \App\Support\SubscriptionBilling::STATUS_PAID_ACTIVE }}" {{ $statusFilter === \App\Support\SubscriptionBilling::STATUS_PAID_ACTIVE ? 'selected' : '' }}>Sudah dibayar / aktif</option>
                    <option value="{{ \App\Support\SubscriptionBilling::STATUS_WAITING_PAYMENT }}" {{ $statusFilter === \App\Support\SubscriptionBilling::STATUS_WAITING_PAYMENT ? 'selected' : '' }}>Menunggu pembayaran</option>
                    <option value="{{ \App\Support\SubscriptionBilling::STATUS_EXPIRED }}" {{ $statusFilter === \App\Support\SubscriptionBilling::STATUS_EXPIRED ? 'selected' : '' }}>Expired</option>
                </select>
            </div>
            <button type="submit" class="bg-gray-600 text-white px-4 py-2 rounded-md hover:bg-gray-700">Terapkan</button>
            <a href="{{ route('manage.subscriptions.index') }}" class="text-blue-600 hover:underline py-2">Reset</a>
        </form>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Client</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Paket</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Berlaku hingga</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status langganan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($rows as $row)
                        @php $client = $row['client']; @endphp
                        <tr>
                            <td class="px-6 py-4">
                                <div class="font-medium text-gray-900">{{ $client->company_name }}</div>
                                <div class="text-sm text-gray-500">{{ $client->email }}</div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-700 capitalize">{{ $client->package_type }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $client->expiry_date->format('d M Y') }}</td>
                            <td class="px-6 py-4">
                                @if($row['status'] === \App\Support\SubscriptionBilling::STATUS_EXPIRED)
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">{{ $row['status_label'] }}</span>
                                @elseif($row['status'] === \App\Support\SubscriptionBilling::STATUS_WAITING_PAYMENT)
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">{{ $row['status_label'] }}</span>
                                @else
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">{{ $row['status_label'] }}</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm">
                                <a href="{{ route('manage.clients.show', $client) }}" class="text-blue-600 hover:text-blue-800">Detail client</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-gray-500">Tidak ada data.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
