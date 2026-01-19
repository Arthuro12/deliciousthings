<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Models\Artisan;

class Message extends Model
{
    protected $fillable = [
        'sender_email', 
        'sender_name', 
        'content',
        'sent_at'
    ];

    public function artisan(): BelongsTo
    {
        return $this->belongsTo(Artisan::class);
    }
}