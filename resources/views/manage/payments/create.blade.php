@extends('manage.layouts.app')

@section('title', 'Add New Payment')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Page Header -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Add New Payment</h1>
            <p class="text-gray-600">Tambah pembayaran baru untuk client</p>
        </div>
        <a href="{{ route('manage.payments.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition-colors">
            <i class="fas fa-arrow-left mr-2"></i>Back to List
        </a>
    </div>

    <!-- Form -->
    <div class="bg-white rounded-lg shadow p-6">
        <form method="POST" action="{{ route('manage.payments.store') }}">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Client -->
                <div>
                    <label for="client_id" class="block text-sm font-medium text-gray-700 mb-2">Client *</label>
                    <select id="client_id" name="client_id" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('client_id') border-red-500 @enderror">
                        <option value="">Select client</option>
                        @foreach($clients as $client)
                        <option value="{{ $client->id }}" {{ old('client_id', $selectedClient ?? null) == $client->id ? 'selected' : '' }}>
                            {{ $client->name }} - {{ $client->company_name }}
                        </option>
                        @endforeach
                    </select>
                    @error('client_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <!-- Amount -->
                <div>
                    <label for="amount" class="block text-sm font-medium text-gray-700 mb-2">Amount (Rp) *</label>
                    <input type="number" id="amount" name="amount" value="{{ old('amount') }}" min="0" step="1000"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('amount') border-red-500 @enderror"
                           placeholder="Enter amount">
                    @error('amount')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <!-- Payment Method -->
                <div>
                    <label for="payment_method" class="block text-sm font-medium text-gray-700 mb-2">Payment Method *</label>
                    <select id="payment_method" name="payment_method" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('payment_method') border-red-500 @enderror">
                        <option value="">Select method</option>
                        <option value="bank_transfer" {{ old('payment_method') == 'bank_transfer' ? 'selected' : '' }}>Bank Transfer</option>
                        <option value="cash" {{ old('payment_method') == 'cash' ? 'selected' : '' }}>Cash</option>
                        <option value="credit_card" {{ old('payment_method') == 'credit_card' ? 'selected' : '' }}>Credit Card</option>
                        <option value="other" {{ old('payment_method') == 'other' ? 'selected' : '' }}>Other</option>
                    </select>
                    @error('payment_method')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <!-- Status -->
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status *</label>
                    <select id="status" name="status" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('status') border-red-500 @enderror">
                        <option value="">Select status</option>
                        <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="approved" {{ old('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                        <option value="rejected" {{ old('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                    @error('status')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <!-- Payment Date -->
                <div>
                    <label for="payment_date" class="block text-sm font-medium text-gray-700 mb-2">Payment Date *</label>
                    <input type="date" id="payment_date" name="payment_date" value="{{ old('payment_date', date('Y-m-d')) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('payment_date') border-red-500 @enderror">
                    @error('payment_date')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <!-- Due Date -->
                <div>
                    <label for="due_date" class="block text-sm font-medium text-gray-700 mb-2">Due Date *</label>
                    <input type="date" id="due_date" name="due_date" value="{{ old('due_date', date('Y-m-d', strtotime('+7 days'))) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('due_date') border-red-500 @enderror">
                    @error('due_date')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <!-- Description -->
            <div class="mt-6">
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                <textarea id="description" name="description" rows="3"
                          class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('description') border-red-500 @enderror"
                          placeholder="Enter description (optional)">{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <!-- Reference Number -->
            <div class="mt-6">
                <label for="reference_number" class="block text-sm font-medium text-gray-700 mb-2">Reference Number</label>
                <input type="text" id="reference_number" name="reference_number" value="{{ old('reference_number') }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('reference_number') border-red-500 @enderror"
                       placeholder="Enter reference number (optional)">
                @error('reference_number')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <!-- Form Actions -->
            <div class="mt-8 flex justify-end space-x-4">
                <a href="{{ route('manage.payments.index') }}" class="bg-gray-600 text-white px-6 py-2 rounded-lg hover:bg-gray-700 transition-colors">
                    Cancel
                </a>
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                    <i class="fas fa-save mr-2"></i>Save Payment
                </button>
            </div>
        </form>
    </div>
</div>
@endsection 