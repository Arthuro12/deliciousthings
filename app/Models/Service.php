<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'key',
        'name',
        'label',
        'category',
    ];

    protected $visible = [
        'key',
        'name',
        'label',
        'category',
    ];
}