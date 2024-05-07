<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'description',
        'weight',
        'discount',
        'images',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function getImagesAttribute($value)
    {
        // Decode JSON array of image paths
        $imagePaths = json_decode($value, true);
    
        // Create array of image URLs
        $imageURLs = [];
        foreach ($imagePaths as $path) {
            // Ubah path relatif menjadi URL yang valid
            $imageURLs[] = asset($path);
        }
    
        return $imageURLs;
    }
    
}
