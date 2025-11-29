<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Artisan extends Model
{
    protected $fillable = [
        'username',
        'company_name',
        'e164phone',
        'email',
        'biography',
        'website_url',
        'instagram_url',
        'average_rate',
        'offers_delivery',
    ];

    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class);
    }

    public function medias(): MorphMany
    {
        return $this->morphMany(Media::class, 'mediable');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function specialities(): BelongsToMany
    {
        return $this->belongsToMany(Speciality::class);
    }
}