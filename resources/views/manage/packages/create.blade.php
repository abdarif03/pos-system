@extends('manage.layouts.app')

@section('title', 'Add Package')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-xl mx-auto bg-white rounded shadow p-6">
        <h1 class="text-2xl font-bold mb-4">Add Package</h1>
        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul class="list-disc pl-5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('manage.packages.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                <input type="text" name="name" value="{{ old('name') }}" class="w-full border rounded px-3 py-2" required>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <textarea name="description" class="w-full border rounded px-3 py-2">{{ old('description') }}</textarea>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Price</label>
                <input type="number" name="price" value="{{ old('price') }}" class="w-full border rounded px-3 py-2" min="0" required>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Duration (months)</label>
                <input type="number" name="duration_months" value="{{ old('duration_months', 1) }}" class="w-full border rounded px-3 py-2" min="1" required>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Features (one per line)</label>
                <textarea name="features[]" class="w-full border rounded px-3 py-2" rows="4">{{ old('features') ? implode("\n", (array)old('features')) : '' }}</textarea>
            </div>
            <div class="mb-4 flex items-center">
                <input type="checkbox" name="is_active" value="1" class="mr-2" {{ old('is_active', true) ? 'checked' : '' }}>
                <label class="text-sm font-medium text-gray-700">Active</label>
            </div>
            <div class="flex justify-end">
                <a href="{{ route('manage.packages.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded mr-2">Cancel</a>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Save</button>
            </div>
        </form>
    </div>
</div>
@endsection 