<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'cart_id',
        'bulk',
        'status',
    ];

    protected $casts = [
        'status' => 'array',
    ];

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

}
