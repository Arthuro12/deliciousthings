<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Speciality extends Model
{
    protected $fillable = ['key', 'name', 'label'];

    protected $visible = ['key', 'name', 'label'];

    public function artisans(): BelongsToMany
    {
        return $this->belongsToMany(Speciality::class)
            ->withTimestamps();
    }
}