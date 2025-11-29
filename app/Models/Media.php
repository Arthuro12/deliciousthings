<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Media extends Model
{
    protected $fillable = ['category', 'path', 'caption'];

    /**
     * Get the parent commentable model (post or video).
     */
    public function mediable(): MorphTo
    {
        return $this->morphTo();
    }
}