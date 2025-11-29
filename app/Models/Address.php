<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'street',
        'house_number',
        'postal_code',
        'city',
        'country',
        'address_line_2',
    ];
}