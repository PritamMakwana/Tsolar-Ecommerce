<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'cart';

    protected $fillable = [
        'customer_id',
        'products_id',
        'size_id',
        'quantity',
        'order_id',
        'payment_status',
        'checked_out_at',
    ];

    public function customer()
    {
        return $this->belongsTo(Customers::class);
    }

    public function products()
    {
        return $this->belongsTo(Products::class);
    }

    public function getTotalAttribute()
    {

        return $this->products->price * $this->quantity + $this->products->shipping;

    }

    public function orderstatus()
    {
        return $this->hasOne(OrderStatus::class);
    }

    public function size()
    {
        return $this->belongsTo(SizeQuantity::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

}
