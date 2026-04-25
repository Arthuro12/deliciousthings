<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Enums\AddressVisibility;

class Address extends Model
{
    protected $fillable = [
        'street',
        'house_number',
        'postal_code',
        'city',
        'country',
        'address_line_2',
        'lat',
        'lon',
        'visibility',
        'formatted',
    ];

    protected function casts(): array
    {
        return [
            'visibility' => AddressVisibility::class,
        ];
    }
}