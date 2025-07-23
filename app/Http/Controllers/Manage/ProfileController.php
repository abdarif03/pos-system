<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::guard('manage')->user();
        return view('manage.profile.show', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::guard('manage')->user();
        // Ensure $user is an Eloquent model
        if (!($user instanceof \App\Models\ManageUser)) {
            $user = \App\Models\ManageUser::findOrFail($user->id);
        }
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:manage_users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->save();
        return redirect()->route('manage.profile')->with('success', 'Profile updated successfully.');
    }
} 