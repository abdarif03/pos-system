@extends('manage.layouts.app')

@section('title', 'Client Management')

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
            <h1 class="text-3xl font-bold text-gray-900">Client Management</h1>
            <p class="text-gray-600">Kelola data client yang terdaftar</p>
        </div>
        <a href="{{ route('manage.clients.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
            <i class="fas fa-plus mr-2"></i>Add New Client
        </a>
    </div>

    <!-- Search and Filter -->
    <div class="bg-white rounded-lg shadow p-6 mb-6">
        <form method="GET" action="{{ route('manage.clients.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Search</label>
                <input type="text" name="search" value="{{ request('search') }}" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                       placeholder="Search by name, email, or company...">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                <select name="status" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">All Status</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Package Type</label>
                <select name="package_type" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">All Packages</option>
                    <option value="basic" {{ request('package_type') == 'basic' ? 'selected' : '' }}>Basic</option>
                    <option value="premium" {{ request('package_type') == 'premium' ? 'selected' : '' }}>Premium</option>
                    <option value="enterprise" {{ request('package_type') == 'enterprise' ? 'selected' : '' }}>Enterprise</option>
                </select>
            </div>
            <div class="flex items-end space-x-2">
                <button type="submit" class="flex-1 bg-gray-600 text-white px-4 py-2 rounded-md hover:bg-gray-700 transition-colors">
                    <i class="fas fa-search mr-2"></i>Filter
                </button>
                <a href="{{ route('manage.clients.index') }}" class="bg-gray-400 text-white px-4 py-2 rounded-md hover:bg-gray-500 transition-colors">
                    <i class="fas fa-times"></i>
                </a>
            </div>
        </form>
    </div>

    <!-- Clients Table -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex justify-between items-center">
                <h2 class="text-lg font-semibold text-gray-900">Client List</h2>
                <div class="text-sm text-gray-600">
                    Showing {{ $clients->firstItem() ?? 0 }} to {{ $clients->lastItem() ?? 0 }} of {{ $clients->total() }} results
                </div>
            </div>
        </div>
        
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Client</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Package</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Registration</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Expiry</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($clients as $client)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div>
                                <div class="text-sm font-medium text-gray-900">{{ $client->name }}</div>
                                <div class="text-sm text-gray-500">{{ $client->email }}</div>
                                <div class="text-sm text-gray-500">{{ $client->company_name }}</div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                {{ $client->package_type == 'basic' ? 'bg-blue-100 text-blue-800' : '' }}
                                {{ $client->package_type == 'premium' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                {{ $client->package_type == 'enterprise' ? 'bg-purple-100 text-purple-800' : '' }}">
                                {{ ucfirst($client->package_type) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                {{ $client->status == 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ ucfirst($client->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $client->registration_date->format('d/m/Y') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            @php
                                $daysUntilExpiry = now()->diffInDays($client->expiry_date, false);
                                $isExpired = $daysUntilExpiry < 0;
                                $isExpiringSoon = $daysUntilExpiry <= 30 && $daysUntilExpiry >= 0;
                            @endphp
                            
                            <div class="flex items-center">
                                <span class="{{ $isExpired ? 'text-red-600' : ($isExpiringSoon ? 'text-yellow-600' : 'text-gray-900') }}">
                                    {{ $client->expiry_date->format('d/m/Y') }}
                                </span>
                                @if($isExpired)
                                    <span class="ml-2 text-xs text-red-600">(Expired)</span>
                                @elseif($isExpiringSoon)
                                    <span class="ml-2 text-xs text-yellow-600">({{ $daysUntilExpiry }} days left)</span>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex space-x-2">
                                <a href="{{ route('manage.clients.show', $client) }}" class="text-blue-600 hover:text-blue-900" title="View Details">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('manage.clients.edit', $client) }}" class="text-indigo-600 hover:text-indigo-900" title="Edit Client">
                                    <i class="fas fa-edit"></i>
                                </a>
                                @if($client->status == 'active')
                                <form method="POST" action="{{ route('manage.clients.deactivate', $client) }}" class="inline">
                                    @csrf
                                    <button type="submit" class="text-yellow-600 hover:text-yellow-900" title="Deactivate Client" onclick="return confirm('Deactivate this client?')">
                                        <i class="fas fa-pause"></i>
                                    </button>
                                </form>
                                @else
                                <form method="POST" action="{{ route('manage.clients.activate', $client) }}" class="inline">
                                    @csrf
                                    <button type="submit" class="text-green-600 hover:text-green-900" title="Activate Client" onclick="return confirm('Activate this client?')">
                                        <i class="fas fa-play"></i>
                                    </button>
                                </form>
                                @endif
                                <form method="POST" action="{{ route('manage.clients.destroy', $client) }}" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900" title="Delete Client" onclick="return confirm('Are you sure you want to delete this client? This action cannot be undone.')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                            <div class="flex flex-col items-center">
                                <i class="fas fa-users text-4xl text-gray-300 mb-2"></i>
                                <p class="text-lg font-medium">No clients found</p>
                                <p class="text-sm">Try adjusting your search or filter criteria</p>
                                @if(request('search') || request('status') || request('package_type'))
                                <a href="{{ route('manage.clients.index') }}" class="mt-2 text-blue-600 hover:text-blue-900 text-sm">
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
        @if($clients->hasPages())
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $clients->links() }}
        </div>
        @endif
    </div>
</div>

<script>
// Auto-submit form when select values change
document.querySelectorAll('select[name="status"], select[name="package_type"]').forEach(select => {
    select.addEventListener('change', function() {
        this.closest('form').submit();
    });
});

// Debounce search input
let searchTimeout;
document.querySelector('input[name="search"]').addEventListener('input', function() {
    clearTimeout(searchTimeout);
    searchTimeout = setTimeout(() => {
        this.closest('form').submit();
    }, 500);
});
</script>
@endsection 