<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
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
        if ($primary) {
            return str_starts_with($primary->image_path, 'http')
                ? $primary->image_path
                : asset('storage/' . $primary->image_path);
        }

        return 'https://images.unsplash.com/photo-1558981403-c5f9899a28bc?w=800';
    }

    /**
     * Calculate average rating.
     */
    public function getAverageRatingAttribute(): float
    {
        $avg = $this->approvedReviews->avg('rating');
        return $avg ? round((float)$avg, 1) : 5.0;
    }
}
