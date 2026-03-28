<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    public const TYPE_MANUAL = 'manual';

    public const TYPE_SUBSCRIPTION_RENEWAL = 'subscription_renewal';

    protected $fillable = [
        'client_id',
        'type',
        'package_id',
        'billing_period_end',
        'amount',
        'payment_method',
        'status',
        'payment_date',
        'due_date',
        'description',
        'reference_number',
    ];

    protected $casts = [
        'payment_date' => 'date',
        'due_date' => 'date',
        'billing_period_end' => 'date',
        'amount' => 'decimal:2',
    ];

    protected $attributes = [
        'type' => self::TYPE_MANUAL,
    ];

    /**
     * Get the client that owns the payment
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function scopeSubscriptionRenewal($query)
    {
        return $query->where('type', self::TYPE_SUBSCRIPTION_RENEWAL);
    }

    public function isPaid(): bool
    {
        return $this->status === 'approved';
    }

    /**
     * Scope for approved payments
     */
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    /**
     * Scope for pending payments
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope for rejected payments
     */
    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }
}
