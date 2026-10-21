<?php

namespace App\Models;

use App\Enums\ServiceRequestStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceRequest extends Model
{
    protected $fillable = [
        'user_id', 'artisan_id', 'status', 'description', 'category', 'occasion',
        'event_date', 'event_time', 'participants', 'location_text', 'budget_min',
        'budget_max', 'currency', 'fulfillment_method', 'style', 'flavors',
        'requirements', 'artisan_response', 'quote_amount', 'responded_at',
    ];

    protected function casts(): array
    {
        return [
            'status' => ServiceRequestStatus::class,
            'event_date' => 'date',
            'style' => 'array',
            'flavors' => 'array',
            'budget_min' => 'decimal:2',
            'budget_max' => 'decimal:2',
            'quote_amount' => 'decimal:2',
            'responded_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function artisan(): BelongsTo
    {
        return $this->belongsTo(Artisan::class);
    }
}