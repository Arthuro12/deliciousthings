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
        'name',
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

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'offers_delivery' => 'boolean',
            'pick_up_on_site' => 'boolean',
        ];
    }

    public function addresses(): MorphMany
    {
        return $this->morphMany(Address::class, 'addressable');
    }

    public function bakedGoods(): BelongsToMany
    {
        return $this->belongsToMany(BakedGood::class)
            ->withTimestamps();
    }

    public function dietaryOptions(): BelongsToMany
    {
        return $this->belongsToMany(DietaryOption::class)
            ->withTimestamps();;
    }

    public function medias(): MorphMany
    {
        return $this->morphMany(Media::class, 'mediable');
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }

    public function profilePhoto()
    {
        return $this->medias()->where('category', 'profile_photo')->first();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getFirstAddressAttribute()
    {
        return $this->addresses()->first();
    }
}