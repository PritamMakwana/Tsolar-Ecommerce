<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Products extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'category_id',
        'product_id',
        'product_name',
        'specification',
        'price',
        'shipping',
        'discount',
        'quantity',
        'image',
        'product_images',
        'material',
        'visible',
        'brand_id',
        'tags',
        'latest',
    ];

    protected $dates = ['deleted_at'];

    protected $casts = [
        'product_images' => 'json',
        'tags' => 'json',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function sizeQuantity()
    {
        return $this->hasMany(SizeQuantity::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

}
