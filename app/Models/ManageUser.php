<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class ManageUser extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'manage_users';

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function hasRole($role)
    {
        return $this->role === $role;
    }

    public function isSuperAdmin()
    {
        return $this->hasRole('superadmin');
    }

    public function isAdmin()
    {
        return $this->hasRole('admin');
    }

    public function isStaff()
    {
        return $this->hasRole('staff');
    }

    public function permissions()
    {
        if (strtolower($this->role) === 'superadmin') {
            // Grant all permissions for superadmin
            return ['dashboard', 'clients', 'payments', 'users', 'packages'];
        }
        $role = \App\Models\Role::whereRaw('LOWER(name) = ?', [strtolower($this->role)])->first();
        return $role ? ($role->permissions ?? []) : [];
    }

    public function hasPermission($permission)
    {
        if (strtolower($this->role) === 'superadmin') {
            return true;
        }
        return in_array($permission, $this->permissions());
    }
} 