<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
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
}
