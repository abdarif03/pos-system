@extends('manage.layouts.app')

@section('title', 'Dashboard - Manage System')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Dashboard</h1>
        <p class="text-gray-600">Selamat datang di sistem manajemen POS</p>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Clients -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                    <i class="fas fa-users text-2xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Clients</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $totalClients }}</p>
                </div>
            </div>
        </div>

        <!-- Active Clients -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-600">
                    <i class="fas fa-user-check text-2xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Active Clients</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $activeClients }}</p>
                </div>
            </div>
        </div>

        <!-- Total Revenue -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                    <i class="fas fa-dollar-sign text-2xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Revenue</p>
                    <p class="text-2xl font-semibold text-gray-900">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>

        <!-- Pending Payments -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-red-100 text-red-600">
                    <i class="fas fa-clock text-2xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Pending Payments</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $pendingPayments }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Client Statistics by Package -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
        <!-- Client Statistics -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-semibold text-gray-900 mb-4">Client Statistics by Package</h2>
            <div class="space-y-4">
                @foreach($clientStats as $stat)
                <div class="flex justify-between items-center p-4 bg-gray-50 rounded-lg">
                    <div>
                        <h3 class="font-medium text-gray-900 capitalize">{{ $stat->package_type }}</h3>
                        <p class="text-sm text-gray-600">{{ $stat->active }} active / {{ $stat->total }} total</p>
                    </div>
                    <div class="text-right">
                        <p class="text-lg font-semibold text-blue-600">{{ $stat->total }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Recent Payments -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-semibold text-gray-900 mb-4">Recent Payments</h2>
            <div class="space-y-4">
                @forelse($recentPayments as $payment)
                <div class="flex justify-between items-center p-4 bg-gray-50 rounded-lg">
                    <div>
                        <h3 class="font-medium text-gray-900">{{ $payment->client->name }}</h3>
                        <p class="text-sm text-gray-600">{{ $payment->payment_method }} - {{ $payment->status }}</p>
                    </div>
                    <div class="text-right">
                        <p class="font-semibold text-gray-900">Rp {{ number_format($payment->amount, 0, ',', '.') }}</p>
                        <p class="text-sm text-gray-600">{{ $payment->payment_date->format('d/m/Y') }}</p>
                    </div>
                </div>
                @empty
                <p class="text-gray-500 text-center py-4">No recent payments</p>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-xl font-semibold text-gray-900 mb-4">Quick Actions</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <a href="{{ route('manage.clients.create') }}" class="flex items-center p-4 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors">
                <i class="fas fa-plus text-blue-600 mr-3"></i>
                <span class="text-blue-900 font-medium">Add New Client</span>
            </a>
            <a href="{{ route('manage.payments.create') }}" class="flex items-center p-4 bg-green-50 rounded-lg hover:bg-green-100 transition-colors">
                <i class="fas fa-money-bill text-green-600 mr-3"></i>
                <span class="text-green-900 font-medium">Record Payment</span>
            </a>
            <a href="{{ route('manage.users.create') }}" class="flex items-center p-4 bg-purple-50 rounded-lg hover:bg-purple-100 transition-colors">
                <i class="fas fa-user-plus text-purple-600 mr-3"></i>
                <span class="text-purple-900 font-medium">Add User</span>
            </a>
        </div>
    </div>
</div>
@endsection 