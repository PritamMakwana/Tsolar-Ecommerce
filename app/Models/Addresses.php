<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Addresses extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'line1',
        'line2',
        'state',
        'country',
        'zip',
    ];

    public function customer()
    {
        return $this->belongsTo(Customers::class);
    }

    public function order()
    {
        return $this->hasMany(Order::class);
    }

}
