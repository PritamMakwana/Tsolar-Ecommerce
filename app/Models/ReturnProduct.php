<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReturnProduct extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'return_product';

    protected $dates = ['deleted_at'];
    protected $fillable =
        [
            'order_id',
            'cart_id',
            'quantity',
            'reason',
            'comments',
        ];

    public function order()
    {
        return $this->belongsTo(Order::class,'order_id');
    }

    public function cart()
    {
        return $this->belongsTo(Cart::class,'cart_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customers::class,'customer_id');
    }


}
