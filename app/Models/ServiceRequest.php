<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Enums\ServiceRequestStatus;

class ServiceRequest extends Model
{
    protected $fillable = [
        'user_id',
        'status',
        'description',
        'category',
        'occasion',
        'event_date',
        'event_time',
        'participants',
        'location_text',
        'budget_min',
        'budget_max',
        'currency',
        'fulfillment_method',
        'style',
        'flavors',
        'requirements',
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
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}