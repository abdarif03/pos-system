<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Models\ManageUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserAccessController extends Controller
{
    /**
     * Display a listing of users
     */
    public function index()
    {
        $users = ManageUser::paginate(15);
        return view('manage.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new user
     */
    public function create()
    {
        return view('manage.users.create');
    }

    /**
     * Store a newly created user
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:manage_users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:superadmin,admin,staff',
        ]);

        ManageUser::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('manage.users.index')
            ->with('success', 'User berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified user
     */
    public function edit(ManageUser $manage_user)
    {
        return view('manage.users.edit', ['user' => $manage_user]);
    }

    /**
     * Update the specified user
     */
    public function update(Request $request, ManageUser $manage_user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:manage_users,email,' . $manage_user->id,
            'role' => 'required|in:superadmin,admin,staff',
        ]);

        $manage_user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ]);

        if ($request->filled('password')) {
            $request->validate([
                'password' => 'string|min:8|confirmed',
            ]);
            $manage_user->update(['password' => Hash::make($request->password)]);
        }

        return redirect()->route('manage.users.index')
            ->with('success', 'User berhasil diperbarui.');
    }

    /**
     * Remove the specified user
     */
    public function destroy(ManageUser $manage_user)
    {
        $manage_user->delete();
        return redirect()->route('manage.users.index')
            ->with('success', 'User berhasil dihapus.');
    }
} 