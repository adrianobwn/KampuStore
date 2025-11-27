<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'seller_id',
        'name', 
        'slug', 
        'category_slug', 
        'condition', 
        'size',
        'price', 
        'stock', 
        'seller_name', 
        'seller_province',
        'seller_city', 
        'image_url', 
        'description',
    ];

    protected $casts = [
        'price' => 'integer',
        'stock' => 'integer',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function averageRating(): float
    {
        $avg = (float) $this->reviews()->avg('rating');
        return round($avg, 1);
    }

    public function reviewsCount(): int
    {
        return (int) $this->reviews()->count();
    }
    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }
}

