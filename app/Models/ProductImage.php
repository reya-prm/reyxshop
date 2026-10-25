<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class ProductImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'image_path',
        'alt_text',
        'sort_order',
        'is_primary',
    ];

    protected function casts(): array
    {
        return [
            'sort_order' => 'integer',
            'is_primary' => 'boolean',
        ];
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function getUrlAttribute(): string
    {
        if (empty($this->image_path)) {
            return asset('images/placeholder-product.svg');
        }

        if (str_starts_with($this->image_path, 'http://') || str_starts_with($this->image_path, 'https://')) {
            return $this->image_path;
        }

        $trimmed = ltrim($this->image_path, '/');
        if (str_starts_with($trimmed, 'storage/')) {
            $trimmed = substr($trimmed, 8);
        }

        if (Storage::disk('public')->exists($trimmed)) {
            return Storage::disk('public')->url($trimmed);
        }

        if (file_exists(public_path($trimmed))) {
            return asset($trimmed);
        }

        return asset('images/placeholder-product.svg');
    }
}
