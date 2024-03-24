<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
    use HasFactory;
    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'phone',
        'address',
        'message',
    ];

    public function getFullNameAttribute($value)
    {
        return $this->firstname . ' ' . $this->lastname;
    }
}
