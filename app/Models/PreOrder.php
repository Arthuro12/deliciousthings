<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class PreOrder extends Model
{
    protected $fillable = [
        'owner_name',
        'owner_email',
        'withdrawal_at',
        'total_guests',
    ];

    public function bakedGoods(): BelongsToMany
    {
        return $this->belongsToMany(BakedGood::class)->withTimestamps();
    }

    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class)->withTimestamps();
    }
}