<?php

namespace App\Models;

use App\Models\ProductImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Product extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'size',
        'price',
        'category',
        'description',
        'benefits',
        'image',
        'is_hot',
        'is_active',
        'shopee_link',
        'tokopedia_link',
        'whatsapp_number',
        'sort_order',
    ];

    protected $casts = [
        'benefits' => 'array',
        'is_hot' => 'boolean',
        'is_active' => 'boolean',
        'price' => 'decimal:2',
    ];

    protected static function booted(): void
    {
        static::creating(function (Product $product): void {
            $product->slug = Str::slug($product->name);
        });

        static::updating(function (Product $product): void {
            if ($product->isDirty('name')) {
                $product->slug = Str::slug($product->name);
            }
        });
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeHot($query)
    {
        return $query->where('is_hot', true);
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class)->orderBy('sort_order');
    }

    public function getImageUrlAttribute(): string
    {
        return $this->primary_image_url;
    }

    public function getPrimaryImageUrlAttribute(): string
    {
        $path = $this->primaryImagePath();

        return $this->resolveImageUrl($path);
    }

    public function getGalleryImageUrlsAttribute(): array
    {
        $images = $this->relationLoaded('images')
            ? $this->images
            : $this->images()->orderBy('sort_order')->get();

        if ($images->isEmpty() && $this->image) {
            return [$this->resolveImageUrl($this->image)];
        }

        if ($images->isEmpty()) {
            return [asset('images/placeholder-product.svg')];
        }

        return $images->map(fn ($img) => $this->resolveImageUrl($img->path))->all();
    }

    protected function primaryImagePath(): ?string
    {
        $image = $this->relationLoaded('images')
            ? $this->images->first()
            : $this->images()->orderBy('sort_order')->first();

        return $image?->path ?? $this->image;
    }

    protected function resolveImageUrl(?string $path): string
    {
        if ($path && str_starts_with($path, 'http')) {
            return $path;
        }

        if ($path && str_starts_with($path, 'images/')) {
            return asset($path);
        }

        if ($path && str_starts_with($path, '/images/')) {
            return asset(ltrim($path, '/'));
        }

        if ($path) {
            return asset('storage/' . ltrim($path, '/'));
        }

        return asset('images/placeholder-product.svg');
    }

    public function getFormattedPriceAttribute(): string
    {
        return 'Rp ' . number_format((float) $this->price, 0, ',', '.');
    }

    public function getWhatsappLinkAttribute(): ?string
    {
        if (!$this->whatsapp_number) {
            return null;
        }

        $message = urlencode("Halo, saya tertarik dengan produk {$this->name} Pellucide. Apakah masih tersedia?");

        return "https://wa.me/{$this->whatsapp_number}?text={$message}";
    }
}
