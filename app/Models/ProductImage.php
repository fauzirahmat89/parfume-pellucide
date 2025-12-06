<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductImage extends Model
{
    protected $fillable = [
        'product_id',
        'path',
        'sort_order',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function getUrlAttribute(): string
    {
        if ($this->path && str_starts_with($this->path, 'http')) {
            return $this->path;
        }

        if ($this->path && str_starts_with($this->path, 'images/')) {
            return asset($this->path);
        }

        if ($this->path && str_starts_with($this->path, '/images/')) {
            return asset(ltrim($this->path, '/'));
        }

        if ($this->path) {
            return asset('storage/' . ltrim($this->path, '/'));
        }

        return asset('images/placeholder-product.svg');
    }
}
