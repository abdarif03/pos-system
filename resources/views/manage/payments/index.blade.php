@extends('manage.layouts.app')

@section('title', 'Payment Management')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Flash Messages -->
    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6" role="alert">
        <div class="flex items-center">
            <i class="fas fa-check-circle mr-2"></i>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    </div>
    @endif
    @if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6" role="alert">
        <div class="flex items-center">
            <i class="fas fa-exclamation-circle mr-2"></i>
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    </div>
    @endif
    <!-- Page Header -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Payment Management</h1>
            <p class="text-gray-600">Kelola data pembayaran client</p>
        </div>
        <div class="flex space-x-2">
            <a href="{{ route('manage.payments.export') }}" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors">
                <i class="fas fa-download mr-2"></i>Export CSV
            </a>
            <a href="{{ route('manage.payments.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                <i class="fas fa-plus mr-2"></i>Add Payment
            </a>
        </div>
    </div>
    <!-- Search and Filter -->
    <div class="bg-white rounded-lg shadow p-6 mb-6">
        <form method="GET" action="{{ route('manage.payments.index') }}" class="grid grid-cols-1 md:grid-cols-5 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Client</label>
                <select name="client_id" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">All Clients</option>
                    @foreach($clients as $client)
                    <option value="{{ $client->id }}" {{ request('client_id') == $client->id ? 'selected' : '' }}>
                        {{ $client->name }} - {{ $client->company_name }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                <select name="status" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">All Status</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                    <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Date From</label>
                <input type="date" name="date_from" value="{{ request('date_from') }}" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Date To</label>
                <input type="date" name="date_to" value="{{ request('date_to') }}" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div class="flex items-end">
                <button type="submit" class="w-full bg-gray-600 text-white px-4 py-2 rounded-md hover:bg-gray-700 transition-colors">
                    <i class="fas fa-search mr-2"></i>Filter
                </button>
            </div>
        </form>
    </div>
    <!-- Payments Table -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex justify-between items-center">
                <h2 class="text-lg font-semibold text-gray-900">Payment List</h2>
                <div class="text-sm text-gray-600">
                    Showing {{ $payments->firstItem() ?? 0 }} to {{ $payments->lastItem() ?? 0 }} of {{ $payments->total() }} results
                </div>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Client</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Method</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Payment Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Due Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($payments as $payment)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div>
                                <div class="text-sm font-medium text-gray-900">{{ $payment->client->name }}</div>
                                <div class="text-sm text-gray-500">{{ $payment->client->company_name }}</div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-semibold text-gray-900">
                                Rp {{ number_format($payment->amount, 0, ',', '.') }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">
                                {{ ucfirst(str_replace('_', ' ', $payment->payment_method)) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                {{ $payment->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                {{ $payment->status == 'approved' ? 'bg-green-100 text-green-800' : '' }}
                                {{ $payment->status == 'rejected' ? 'bg-red-100 text-red-800' : '' }}">
                                {{ ucfirst($payment->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $payment->payment_date->format('d/m/Y') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $payment->due_date->format('d/m/Y') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex space-x-2">
                                <a href="{{ route('manage.payments.show', $payment) }}" class="text-blue-600 hover:text-blue-900" title="View Details">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('manage.payments.edit', $payment) }}" class="text-indigo-600 hover:text-indigo-900" title="Edit Payment">
                                    <i class="fas fa-edit"></i>
                                </a>
                                @if($payment->status == 'pending')
                                <form method="POST" action="{{ route('manage.payments.approve', $payment) }}" class="inline">
                                    @csrf
                                    <button type="submit" class="text-green-600 hover:text-green-900" title="Approve Payment" onclick="return confirm('Approve this payment?')">
                                        <i class="fas fa-check"></i>
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('manage.payments.reject', $payment) }}" class="inline">
                                    @csrf
                                    <button type="submit" class="text-red-600 hover:text-red-900" title="Reject Payment" onclick="return confirm('Reject this payment?')">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </form>
                                @endif
                                @if($payment->status != 'approved')
                                <form method="POST" action="{{ route('manage.payments.destroy', $payment) }}" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900" title="Delete Payment" onclick="return confirm('Delete this payment?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-8 text-center text-gray-500">
                            <div class="flex flex-col items-center">
                                <i class="fas fa-money-bill text-4xl text-gray-300 mb-2"></i>
                                <p class="text-lg font-medium">No payments found</p>
                                <p class="text-sm">Try adjusting your filter criteria</p>
                                @if(request('client_id') || request('status') || request('date_from') || request('date_to'))
                                <a href="{{ route('manage.payments.index') }}" class="mt-2 text-blue-600 hover:text-blue-900 text-sm">
                                    Clear all filters
                                </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <!-- Pagination -->
        @if($payments->hasPages())
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $payments->links() }}
        </div>
        @endif
    </div>
</div>
@endsection 