<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ClientUserController extends Controller
{
    public function create(Client $client)
    {
        $userLimit = $client->getUserLimit();
        $userCount = $client->users()->count();
        if ($userCount >= $userLimit) {
            return redirect()->route('manage.clients.show', $client)
                ->with('error', 'User limit reached for this client package.');
        }
        $roles = Role::all();
        return view('manage.clients.users.create', compact('client', 'roles', 'userLimit', 'userCount'));
    }

    public function store(Request $request, Client $client)
    {
        $userLimit = $client->getUserLimit();
        $userCount = $client->users()->count();
        if ($userCount >= $userLimit) {
            return redirect()->route('manage.clients.show', $client)
                ->with('error', 'User limit reached for this client package.');
        }
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => 'required|string|min:8|confirmed',
            'role_id' => 'required|exists:roles,id',
        ]);
        $validated['client_id'] = $client->id;
        $validated['password'] = Hash::make($validated['password']);
        User::create($validated);
        return redirect()->route('manage.clients.show', $client)
            ->with('success', 'User berhasil ditambahkan ke client.');
    }

    public function edit(Client $client, User $user)
    {
        $roles = Role::all();
        return view('manage.clients.users.edit', compact('client', 'user', 'roles'));
    }

    public function update(Request $request, Client $client, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($user->id)],
            'role_id' => 'required|exists:roles,id',
        ]);
        $user->update($validated);
        if ($request->filled('password')) {
            $request->validate([
                'password' => 'string|min:8|confirmed',
            ]);
            $user->update(['password' => Hash::make($request->password)]);
        }
        return redirect()->route('manage.clients.show', $client)
            ->with('success', 'User berhasil diperbarui.');
    }

    public function destroy(Client $client, User $user)
    {
        $user->delete();
        return redirect()->route('manage.clients.show', $client)
            ->with('success', 'User berhasil dihapus dari client.');
    }
} 