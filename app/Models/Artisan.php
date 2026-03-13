<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Attributes\Scope;

use App\Enums\PriceLevel;

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
        'price_level',
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
            'price_level' => PriceLevel::class,
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

    /**
     * Scope a query to include only records within a given radius.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  float|int  $distance
     * @param  float  $lat
     * @param  float  $lng
     * @param  string  $units
     * @return \Illuminate\Database\Eloquent\Builder
     */
    #[Scope]
    public function distance(Builder $query, float|int $distance, float $lat, float $lng, string $units = 'kilometers')
    {
        if (is_null($distance) || is_null($lat) || is_null($lng)) {
            return $query; // nothing to filter
        }

        $radius = $units === 'miles' ? 3959 : 6371; // Earth radius

        // Haversine formula (placeholders only)
        $haversine = "(
            ? * ACOS(
                COS(RADIANS(?)) *
                COS(RADIANS(addresses.lat)) *
                COS(RADIANS(addresses.lon) - RADIANS(?)) +
                SIN(RADIANS(?)) *
                SIN(RADIANS(lat))
            )
        )";

        $bindings = [$radius, $lat, $lng, $lat];
    return $query->whereHas('addresses', fn ($q) =>
        $q->selectRaw("ROUND($haversine, 2) AS distance", $bindings)
            ->having('distance', '<=', $distance)
            ->orderBy('distance', 'asc'));
    }
}