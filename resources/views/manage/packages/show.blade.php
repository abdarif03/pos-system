@extends('manage.layouts.app')

@section('title', 'Package Details')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-xl mx-auto bg-white rounded shadow p-6">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold">Package Details</h1>
            <div>
                <a href="{{ route('manage.packages.edit', $package) }}" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 mr-2"><i class="fas fa-edit mr-1"></i>Edit</a>
                <form action="{{ route('manage.packages.destroy', $package) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700" onclick="return confirm('Delete this package?')">
                        <i class="fas fa-trash mr-1"></i>Delete
                    </button>
                </form>
            </div>
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
            <div class="text-lg font-semibold">{{ $package->name }}</div>
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
            <div>{{ $package->description }}</div>
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Price</label>
            <div>Rp {{ number_format($package->price, 0, ',', '.') }}</div>
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Duration</label>
            <div>{{ $package->duration_months }} month(s)</div>
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Features</label>
            <ul class="list-disc pl-5">
                @foreach((array)$package->features as $feature)
                    <li>{{ $feature }}</li>
                @endforeach
            </ul>
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $package->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                {{ $package->is_active ? 'Active' : 'Inactive' }}
            </span>
        </div>
        <div class="flex justify-end">
            <a href="{{ route('manage.packages.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Back to List</a>
        </div>
    </div>
</div>
@endsection 