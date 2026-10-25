<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'price',
        'stock',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'stock' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->name);
            }
        });
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class)->orderBy('sort_order', 'asc');
    }

    public function primaryImage(): HasOne
    {
        return $this->hasOne(ProductImage::class)->where('is_primary', true);
    }

    public function variants(): HasMany
    {
        return $this->hasMany(ProductVariant::class)->where('is_active', true);
    }

    public function marketplaceLinks(): HasMany
    {
        return $this->hasMany(MarketplaceLink::class)->where('is_active', true);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class)->latest();
    }

    public function approvedReviews(): HasMany
    {
        return $this->hasMany(Review::class)->where('status', 'approved')->latest();
    }

    public function questions(): HasMany
    {
        return $this->hasMany(ProductQuestion::class)->latest();
    }

    public function answeredQuestions(): HasMany
    {
        return $this->hasMany(ProductQuestion::class)->where('status', 'answered')->latest();
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Get primary image URL or fallback placeholder.
     */
    public function getImageUrlAttribute(): string
    {
        $primary = $this->images->firstWhere('is_primary', true) ?? $this->images->first();
        if ($primary && ! empty($primary->image_path)) {
            $path = $primary->image_path;

            if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
                return $path;
            }

            $trimmed = ltrim($path, '/');
            if (str_starts_with($trimmed, 'storage/')) {
                $trimmed = substr($trimmed, 8);
            }

            if (Storage::disk('public')->exists($trimmed)) {
                return Storage::disk('public')->url($trimmed);
            }

            if (file_exists(public_path($trimmed))) {
                return asset($trimmed);
            }
        }

        return asset('images/placeholder-product.svg');
    }

    /**
     * Calculate average rating.
     */
    public function getAverageRatingAttribute(): float
    {
        $avg = $this->approvedReviews->avg('rating');

        return $avg ? round((float) $avg, 1) : 5.0;
    }
}
