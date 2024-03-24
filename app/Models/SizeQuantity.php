<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SizeQuantity extends Model
{
    use HasFactory;

    protected $fillable = [
        'size',
        'quantity',
        'products_id',
        'status',
    ];

    public function product()
    {
        return $this->belongsTo(Products::class);
    }

}
