@extends('manage.layouts.app')

@section('title', 'Payment Details')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Page Header -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Payment Details</h1>
            <p class="text-gray-600">Detail pembayaran untuk client: {{ $payment->client->name }}</p>
        </div>
        <a href="{{ route('manage.payments.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition-colors">
            <i class="fas fa-arrow-left mr-2"></i>Back to List
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Payment Information -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-semibold text-gray-900 mb-4">Payment Information</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Client</label>
                    <p class="text-gray-900 font-medium">{{ $payment->client->name }}<br><span class="text-gray-500 text-xs">{{ $payment->client->company_name }}</span></p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Amount</label>
                    <p class="text-gray-900 font-semibold">Rp {{ number_format($payment->amount, 0, ',', '.') }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Payment Method</label>
                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">
                        {{ ucfirst(str_replace('_', ' ', $payment->payment_method)) }}
                    </span>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                        {{ $payment->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                        {{ $payment->status == 'approved' ? 'bg-green-100 text-green-800' : '' }}
                        {{ $payment->status == 'rejected' ? 'bg-red-100 text-red-800' : '' }}">
                        {{ ucfirst($payment->status) }}
                    </span>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Payment Date</label>
                    <p class="text-gray-900">{{ $payment->payment_date->format('d/m/Y') }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Due Date</label>
                    <p class="text-gray-900">{{ $payment->due_date->format('d/m/Y') }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Reference Number</label>
                    <p class="text-gray-900">{{ $payment->reference_number ?? '-' }}</p>
                </div>
            </div>
            @if($payment->description)
            <div class="mt-6">
                <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <p class="text-gray-900 bg-gray-50 p-3 rounded-md">{{ $payment->description }}</p>
            </div>
            @endif
        </div>
        <!-- Client Information -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-semibold text-gray-900 mb-4">Client Information</h2>
            <div class="space-y-2">
                <div>
                    <span class="font-medium text-gray-700">Name:</span> {{ $payment->client->name }}
                </div>
                <div>
                    <span class="font-medium text-gray-700">Email:</span> {{ $payment->client->email }}
                </div>
                <div>
                    <span class="font-medium text-gray-700">Phone:</span> {{ $payment->client->phone }}
                </div>
                <div>
                    <span class="font-medium text-gray-700">Company:</span> {{ $payment->client->company_name }}
                </div>
                <div>
                    <span class="font-medium text-gray-700">Package:</span> {{ ucfirst($payment->client->package_type) }}
                </div>
                <div>
                    <span class="font-medium text-gray-700">Status:</span> 
                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                        {{ $payment->client->status == 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ ucfirst($payment->client->status) }}
                    </span>
                </div>
            </div>
        </div>
    </div>
    <!-- Actions -->
    <div class="mt-8 flex space-x-4">
        <a href="{{ route('manage.payments.edit', $payment) }}" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors">
            <i class="fas fa-edit mr-2"></i>Edit Payment
        </a>
        @if($payment->status == 'pending')
        <form method="POST" action="{{ route('manage.payments.approve', $payment) }}" class="inline">
            @csrf
            <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition-colors" onclick="return confirm('Approve this payment?')">
                <i class="fas fa-check mr-2"></i>Approve
            </button>
        </form>
        <form method="POST" action="{{ route('manage.payments.reject', $payment) }}" class="inline">
            @csrf
            <button type="submit" class="bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-red-700 transition-colors" onclick="return confirm('Reject this payment?')">
                <i class="fas fa-times mr-2"></i>Reject
            </button>
        </form>
        @endif
        @if($payment->status != 'approved')
        <form method="POST" action="{{ route('manage.payments.destroy', $payment) }}" class="inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-red-700 transition-colors" onclick="return confirm('Delete this payment?')">
                <i class="fas fa-trash mr-2"></i>Delete
            </button>
        </form>
        @endif
    </div>
</div>
@endsection 