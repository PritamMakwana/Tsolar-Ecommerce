<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table='order';

    protected $fillable=[
        'order_id',
        'customer_id',
        'bunch',
        'token',
        'PayerID',
        'address_id',
    ];

    public function customer()
    {
        return $this->belongsTo(Customers::class);
    }

    public function cart()
    {
        return $this->hasMany(Cart::class);
    }

    public function carts()
    {
        return $this->hasOne(Cart::class);
    }

    public function getTotalAttribute()
    {
        $products = $this->cart;

        $total = 0;
        foreach ($products as $product) {
            $total += $product->total ;
        }

        return $total;

    }

    public function address()
    {
        return $this->belongsTo(Addresses::class, 'address_id');
    }

}
