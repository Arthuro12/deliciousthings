<?php

namespace App\Actions;

use App\Enums\ServiceRequestStatus;
use App\Models\ServiceRequest;
use Illuminate\Validation\ValidationException;

class ConfirmRequest
{
    public function handle(ServiceRequest $serviceRequest): ServiceRequest
    {
        if (! in_array($serviceRequest->status, [
            ServiceRequestStatus::Draft,
            ServiceRequestStatus::Confirmed,
        ], true)) {
            throw ValidationException::withMessages([
                'request' => 'Diese Anfrage kann nicht mehr bestätigt werden.',
            ]);
        }

        $serviceRequest->forceFill([
            'status' => ServiceRequestStatus::Confirmed,
        ])->save();

        return $serviceRequest->fresh();
    }
}