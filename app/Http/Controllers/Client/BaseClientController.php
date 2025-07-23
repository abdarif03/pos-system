<?php

namespace App\Http\Controllers\Client;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BaseClientController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Check if user is authenticated
     *
     * @return bool
     */
    protected function isAuthenticated()
    {
        return Auth::check();
    }

    /**
     * Get current authenticated user
     *
     * @return \App\Models\User|null
     */
    protected function getCurrentUser()
    {
        return Auth::user();
    }

    /**
     * Check if user has specific role
     *
     * @param string $role
     * @return bool
     */
    protected function hasRole($role)
    {
        $user = $this->getCurrentUser();
        return $user && $user->role === $role;
    }

    /**
     * Redirect to login if not authenticated
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function redirectToLogin()
    {
        return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu');
    }
} 