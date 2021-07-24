<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

//    protected $with = ['images'];

    protected $fillable = [
        'title','price','qty','description','category_id','created_by','updated_by'
    ];

    /**
     * Get the images for the product
     */
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    /**
     * Get the category for the product
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
