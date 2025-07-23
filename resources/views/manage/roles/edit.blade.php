@extends('manage.layouts.app')

@section('title', 'Edit Role')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-lg mx-auto bg-white rounded-lg shadow p-8">
        <h1 class="text-2xl font-bold mb-6">Edit Role</h1>
        <form method="POST" action="{{ route('manage.roles.update', $role) }}">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-semibold mb-2">Role Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $role->name) }}" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300" required>
                @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div class="mb-6">
                <label for="description" class="block text-gray-700 font-semibold mb-2">Description</label>
                <textarea name="description" id="description" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300">{{ old('description', $role->description) }}</textarea>
                @error('description')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 font-semibold mb-2">Permissions</label>
                <div class="grid grid-cols-2 gap-2">
                    @foreach($availablePermissions as $permKey => $permLabel)
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="permissions[]" value="{{ $permKey }}" class="form-checkbox text-blue-600" {{ in_array($permKey, old('permissions', $role->permissions ?? [])) ? 'checked' : '' }}>
                        <span class="ml-2">{{ $permLabel }}</span>
                    </label>
                    @endforeach
                </div>
                @error('permissions')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div class="flex justify-end">
                <a href="{{ route('manage.roles.index') }}" class="mr-4 text-gray-600 hover:underline">Cancel</a>
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition-colors">Update Role</button>
            </div>
        </form>
    </div>
</div>
@endsection 