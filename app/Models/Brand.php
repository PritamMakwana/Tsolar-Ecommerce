<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'brand_name'
    ];

    protected $dates = ['deleted_at'];

    public function products()
    {
        return $this->hasMany(Products::class);
    }

    public function ProductsBrand(){
        return $this->belongsTo(Products::class,'id','id');
    }

}
