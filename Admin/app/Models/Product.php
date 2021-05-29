<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
		'quantity',
		'price',
		'content',
		'discount',
		'status',
		'user_id',
		'category_id',
		'feauture_image_name',
		'feature_image_path'
    ];

    public function images()
    {
    	return $this->hasMany(ProductImage::class);
    }

    public function category()
    {
    	return $this->belongsto(Category::class, 'category_id');
    }

    

    
}
