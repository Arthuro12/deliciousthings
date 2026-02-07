<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BakedGood extends Model
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