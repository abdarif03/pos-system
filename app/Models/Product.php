<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['sku', 'name', 'stock', 'price'];
    protected $casts = [
        'stock' => 'integer',
        'price' => 'integer',
    ];
}
