<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    protected $fillable = ['sku', 'name', 'stock', 'base_price', 'price', 'category_id'];
    protected $casts = [
        'stock' => 'integer',
        'base_price' => 'integer',
        'price' => 'integer',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
