<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleAccessController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('manage.roles.index', compact('roles'));
    }

    public function create()
    {
        $availablePermissions = [
            'dashboard' => 'Dashboard',
            'clients' => 'Clients',
            'payments' => 'Payments',
            'users' => 'Users',
            'packages' => 'Packages',
        ];
        return view('manage.roles.create', compact('availablePermissions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:roles,name',
            'description' => 'nullable|string|max:255',
            'permissions' => 'nullable|array',
            'permissions.*' => 'string',
        ]);
        $validated['permissions'] = $request->permissions ?? [];
        Role::create($validated);
        return redirect()->route('manage.roles.index')->with('success', 'Role created successfully.');
    }

    public function edit(Role $role)
    {
        $availablePermissions = [
            'dashboard' => 'Dashboard',
            'clients' => 'Clients',
            'payments' => 'Payments',
            'users' => 'Users',
            'packages' => 'Packages',
        ];
        return view('manage.roles.edit', compact('role', 'availablePermissions'));
    }

    public function update(Request $request, Role $role)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $role->id,
            'description' => 'nullable|string|max:255',
            'permissions' => 'nullable|array',
            'permissions.*' => 'string',
        ]);
        $validated['permissions'] = $request->permissions ?? [];
        $role->update($validated);
        return redirect()->route('manage.roles.index')->with('success', 'Role updated successfully.');
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('manage.roles.index')->with('success', 'Role deleted successfully.');
    }
} 