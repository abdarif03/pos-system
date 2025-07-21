<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::orderBy('name')->paginate(15);
        return view('manage.packages.index', compact('packages'));
    }

    public function create()
    {
        return view('manage.packages.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:packages,name',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'duration_months' => 'required|integer|min:1',
            'features' => 'nullable|array',
            'is_active' => 'boolean',
        ]);
        $data['slug'] = Str::slug($data['name']);
        $data['features'] = $data['features'] ?? [];
        $package = Package::create($data);
        return redirect()->route('manage.packages.index')->with('success', 'Package created successfully.');
    }

    public function show(Package $package)
    {
        return view('manage.packages.show', compact('package'));
    }

    public function edit(Package $package)
    {
        return view('manage.packages.edit', compact('package'));
    }

    public function update(Request $request, Package $package)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:packages,name,' . $package->id,
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'duration_months' => 'required|integer|min:1',
            'features' => 'nullable|array',
            'is_active' => 'boolean',
        ]);
        $data['slug'] = Str::slug($data['name']);
        $data['features'] = $data['features'] ?? [];
        $package->update($data);
        return redirect()->route('manage.packages.index')->with('success', 'Package updated successfully.');
    }

    public function destroy(Package $package)
    {
        $package->delete();
        return redirect()->route('manage.packages.index')->with('success', 'Package deleted successfully.');
    }
} 