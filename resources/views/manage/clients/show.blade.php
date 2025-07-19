@extends('manage.layouts.app')

@section('title', 'Client Details')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Page Header -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Client Details</h1>
            <p class="text-gray-600">Detail informasi client: {{ $client->name }}</p>
        </div>
        <div class="flex space-x-2">
            <a href="{{ route('manage.clients.edit', $client) }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                <i class="fas fa-edit mr-2"></i>Edit Client
            </a>
            <a href="{{ route('manage.clients.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition-colors">
                <i class="fas fa-arrow-left mr-2"></i>Back to List
            </a>
        </div>
    </div>

    <!-- Client Information -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Information -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow p-6 mb-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Client Information</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                        <p class="text-gray-900 font-medium">{{ $client->name }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <p class="text-gray-900">{{ $client->email }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                        <p class="text-gray-900">{{ $client->phone }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Company Name</label>
                        <p class="text-gray-900">{{ $client->company_name }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Package Type</label>
                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                            {{ $client->package_type == 'basic' ? 'bg-blue-100 text-blue-800' : '' }}
                            {{ $client->package_type == 'premium' ? 'bg-yellow-100 text-yellow-800' : '' }}
                            {{ $client->package_type == 'enterprise' ? 'bg-purple-100 text-purple-800' : '' }}">
                            {{ ucfirst($client->package_type) }}
                        </span>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                            {{ $client->status == 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ ucfirst($client->status) }}
                        </span>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Registration Date</label>
                        <p class="text-gray-900">{{ $client->registration_date->format('d/m/Y') }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Expiry Date</label>
                        <p class="text-gray-900">{{ $client->expiry_date->format('d/m/Y') }}</p>
                    </div>
                </div>
                
                @if($client->notes)
                <div class="mt-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Notes</label>
                    <p class="text-gray-900 bg-gray-50 p-3 rounded-md">{{ $client->notes }}</p>
                </div>
                @endif
            </div>

            <!-- Payment History -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold text-gray-900">Payment History</h2>
                    <a href="{{ route('manage.payments.create') }}?client_id={{ $client->id }}" 
                       class="bg-green-600 text-white px-3 py-1 rounded text-sm hover:bg-green-700 transition-colors">
                        <i class="fas fa-plus mr-1"></i>Add Payment
                    </a>
                </div>
                
                @if($client->payments->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Amount</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Method</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($client->payments->take(5) as $payment)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-sm text-gray-900">
                                    {{ $payment->payment_date->format('d/m/Y') }}
                                </td>
                                <td class="px-4 py-3 text-sm font-semibold text-gray-900">
                                    Rp {{ number_format($payment->amount, 0, ',', '.') }}
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-900">
                                    {{ ucfirst(str_replace('_', ' ', $payment->payment_method)) }}
                                </td>
                                <td class="px-4 py-3">
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                        {{ $payment->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                        {{ $payment->status == 'approved' ? 'bg-green-100 text-green-800' : '' }}
                                        {{ $payment->status == 'rejected' ? 'bg-red-100 text-red-800' : '' }}">
                                        {{ ucfirst($payment->status) }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    <a href="{{ route('manage.payments.show', $payment) }}" class="text-blue-600 hover:text-blue-900">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                @if($client->payments->count() > 5)
                <div class="mt-4 text-center">
                    <a href="{{ route('manage.payments.index') }}?client_id={{ $client->id }}" 
                       class="text-blue-600 hover:text-blue-900 text-sm">
                        View all {{ $client->payments->count() }} payments →
                    </a>
                </div>
                @endif
                @else
                <p class="text-gray-500 text-center py-4">No payment records found</p>
                @endif
            </div>
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1">
            <!-- Quick Actions -->
            <div class="bg-white rounded-lg shadow p-6 mb-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>
                
                <div class="space-y-3">
                    @if($client->status == 'active')
                    <form method="POST" action="{{ route('manage.clients.deactivate', $client) }}" class="inline w-full">
                        @csrf
                        <button type="submit" class="w-full bg-yellow-600 text-white px-4 py-2 rounded-lg hover:bg-yellow-700 transition-colors text-left"
                                onclick="return confirm('Deactivate this client?')">
                            <i class="fas fa-pause mr-2"></i>Deactivate Client
                        </button>
                    </form>
                    @else
                    <form method="POST" action="{{ route('manage.clients.activate', $client) }}" class="inline w-full">
                        @csrf
                        <button type="submit" class="w-full bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors text-left"
                                onclick="return confirm('Activate this client?')">
                            <i class="fas fa-play mr-2"></i>Activate Client
                        </button>
                    </form>
                    @endif
                    
                    <a href="{{ route('manage.payments.create') }}?client_id={{ $client->id }}" 
                       class="block w-full bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors text-center">
                        <i class="fas fa-plus mr-2"></i>Add Payment
                    </a>
                    
                    <form method="POST" action="{{ route('manage.clients.destroy', $client) }}" class="inline w-full">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition-colors"
                                onclick="return confirm('Are you sure you want to delete this client? This action cannot be undone.')">
                            <i class="fas fa-trash mr-2"></i>Delete Client
                        </button>
                    </form>
                </div>
            </div>

            <!-- Statistics -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Payment Statistics</h3>
                
                <div class="space-y-4">
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Total Payments</span>
                        <span class="font-semibold text-gray-900">{{ $client->payments->count() }}</span>
                    </div>
                    
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Total Amount</span>
                        <span class="font-semibold text-gray-900">
                            Rp {{ number_format($client->payments->sum('amount'), 0, ',', '.') }}
                        </span>
                    </div>
                    
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Approved</span>
                        <span class="font-semibold text-green-600">
                            {{ $client->payments->where('status', 'approved')->count() }}
                        </span>
                    </div>
                    
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Pending</span>
                        <span class="font-semibold text-yellow-600">
                            {{ $client->payments->where('status', 'pending')->count() }}
                        </span>
                    </div>
                    
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Rejected</span>
                        <span class="font-semibold text-red-600">
                            {{ $client->payments->where('status', 'rejected')->count() }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 