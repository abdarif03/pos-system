<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserAccessController extends Controller
{
    /**
     * Display a listing of users
     */
    public function index()
    {
        $users = User::with('role')->paginate(15);
        return view('manage.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new user
     */
    public function create()
    {
        $roles = Role::all();
        return view('manage.users.create', compact('roles'));
    }

    /**
     * Store a newly created user
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role_id' => 'required|exists:roles,id',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
        ]);

        return redirect()->route('manage.users.index')
            ->with('success', 'User berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified user
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('manage.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified user
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'role_id' => 'required|exists:roles,id',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => $request->role_id,
        ]);

        if ($request->filled('password')) {
            $request->validate([
                'password' => 'string|min:8|confirmed',
            ]);
            $user->update(['password' => Hash::make($request->password)]);
        }

        return redirect()->route('manage.users.index')
            ->with('success', 'User berhasil diperbarui.');
    }

    /**
     * Remove the specified user
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('manage.users.index')
            ->with('success', 'User berhasil dihapus.');
    }
} 