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
        'main_occupation',
        'e164phone',
        'email',
        'short_description',
        'about',
        'website_url',
        'instagram_url',
        'average_rate',
        'offers_delivery',
        'pick_up_on_site'
    ];

    protected $appends = ['first_address'];

    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class);
    }

    public function dietTypes(): BelongsToMany
    {
        return $this->belongsToMany(DietType::class);
    }

    public function getFirstAddressAttribute()
    {
        return $this->addresses()->first();
    }

    public function medias(): MorphMany
    {
        return $this->morphMany(Media::class, 'mediable');
    }

    public function specialities(): BelongsToMany
    {
        return $this->belongsToMany(Speciality::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}