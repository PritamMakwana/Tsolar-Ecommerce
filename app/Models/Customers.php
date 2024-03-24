<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customers extends Authenticatable
{
    use HasFactory;

    protected $table = 'customers';


    protected $fillable = [
        'customer_id',
        'name',
        'email',
        'phone',
        'address',
        'image',
        'password',
        'email_verified_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function cart()
    {
        return $this->hasMany(Cart::class, 'customer_id');
    }

    public function getCartCountAttribute()
    {
        return $this->cart->where('order_id', null)->count();
    }

    public function address()
    {
        return $this->hasMany(Addresses::class);
    }

}
