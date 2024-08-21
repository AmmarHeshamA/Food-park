<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function productImage()
    {
        return $this->hasMany(ProductGallery::class);
    }

    public function productSizes()
    {
        return $this->hasMany(ProductSize::class);
    }
    public function productOptions()
    {
        return $this->hasMany(ProductOption::class);
    }
    function reviews(): HasMany
    {
        return $this->hasMany(ProductRating::class, 'product_id', 'id');
    }
}
