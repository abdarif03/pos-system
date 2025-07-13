<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['transaction_date', 'total', 'status'];
    protected $casts = [
        'transaction_date' => 'datetime',
        'total' => 'float',
    ];
    
    // Status constants
    const STATUS_NEW = 'new';
    const STATUS_PAID = 'paid';
    const STATUS_CANCEL = 'cancel';
    const STATUS_EXPIRED = 'expired';
    
    public function items()
    {
        return $this->hasMany(TransactionItem::class);
    }
    
    public function total()
    {
        return $this->items->sum('subtotal');
    }
    
    public function transactionDate()
    {
        return $this->transaction_date->format('d/m/Y');
    }
    
    public function transactionTime()
    {
        return $this->transaction_date->format('H:i:s');
    }
    
    public function transactionDateTime()
    {
        return $this->transaction_date->format('d/m/Y H:i:s');
    }
    
    /**
     * Get status badge class
     */
    public function getStatusBadgeClass()
    {
        return match($this->status) {
            self::STATUS_PAID => 'bg-success',
            self::STATUS_NEW => 'bg-primary',
            self::STATUS_CANCEL => 'bg-danger',
            self::STATUS_EXPIRED => 'bg-warning',
            default => 'bg-secondary'
        };
    }
    
    /**
     * Get status label
     */
    public function getStatusLabel()
    {
        return match($this->status) {
            self::STATUS_PAID => 'Lunas',
            self::STATUS_NEW => 'Baru',
            self::STATUS_CANCEL => 'Dibatalkan',
            self::STATUS_EXPIRED => 'Kadaluarsa',
            default => 'Tidak Diketahui'
        };
    }
    
    /**
     * Check if transaction is completed
     */
    public function isCompleted()
    {
        return $this->status === self::STATUS_PAID;
    }
    
    /**
     * Check if transaction is cancelled
     */
    public function isCancelled()
    {
        return $this->status === self::STATUS_CANCEL;
    }
    
    /**
     * Check if transaction is expired
     */
    public function isExpired()
    {
        return $this->status === self::STATUS_EXPIRED;
    }
}
