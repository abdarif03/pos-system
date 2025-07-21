<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'company_name',
        'package_type',
        'status',
        'registration_date',
        'expiry_date',
        'notes'
    ];

    protected $casts = [
        'registration_date' => 'date',
        'expiry_date' => 'date',
    ];

    /**
     * Get the payments for this client
     */
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * Get the users for this client
     */
    public function users()
    {
        return $this->hasMany(User::class, 'client_id');
    }

    /**
     * Get the user limit based on package_type
     */
    public function getUserLimit()
    {
        switch ($this->package_type) {
            case 'basic':
                return 3;
            case 'premium':
                return 10;
            case 'enterprise':
                return 50;
            default:
                return 1;
        }
    }

    /**
     * Scope for active clients
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope for inactive clients
     */
    public function scopeInactive($query)
    {
        return $query->where('status', 'inactive');
    }
} 