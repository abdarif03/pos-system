@extends('manage.layouts.app')

@section('title', 'Add User to Client')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Page Header -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Add User to Client</h1>
            <p class="text-gray-600">Tambah user untuk client: <span class="font-semibold">{{ $client->name }}</span> ({{ $userCount }}/{{ $userLimit }})</p>
        </div>
        <a href="{{ route('manage.clients.show', $client) }}" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition-colors">
            <i class="fas fa-arrow-left mr-2"></i>Back to Client
        </a>
    </div>

    <!-- Form -->
    <div class="bg-white rounded-lg shadow p-6">
        <form method="POST" action="{{ route('manage.clients.users.store', $client) }}">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Name *</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('name') border-red-500 @enderror"
                           placeholder="Enter user name">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('email') border-red-500 @enderror"
                           placeholder="Enter email address">
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password *</label>
                    <input type="password" id="password" name="password"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('password') border-red-500 @enderror"
                           placeholder="Enter password">
                    @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <!-- Password Confirmation -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Confirm Password *</label>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                           placeholder="Confirm password">
                </div>
                <!-- Role -->
                <div>
                    <label for="role_id" class="block text-sm font-medium text-gray-700 mb-2">Role *</label>
                    <select id="role_id" name="role_id" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('role_id') border-red-500 @enderror">
                        <option value="">Select role</option>
                        @foreach($roles as $role)
                        <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>{{ ucfirst($role->name) }}</option>
                        @endforeach
                    </select>
                    @error('role_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <!-- Form Actions -->
            <div class="mt-8 flex justify-end space-x-4">
                <a href="{{ route('manage.clients.show', $client) }}" class="bg-gray-600 text-white px-6 py-2 rounded-lg hover:bg-gray-700 transition-colors">
                    Cancel
                </a>
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                    <i class="fas fa-save mr-2"></i>Save User
                </button>
            </div>
        </form>
    </div>
</div>
@endsection 