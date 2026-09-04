<?php

namespace App\Actions;

use App\Enums\ServiceRequestStatus;
use App\Models\ServiceRequest;

class UpdateRequest
{
    public function handle(ServiceRequest $serviceRequest, array $attributes): ServiceRequest
    {
        // Any edit invalidates the previous confirmation. The user must review it again.
        $serviceRequest->fill($attributes);
        $serviceRequest->status = ServiceRequestStatus::Draft;
        $serviceRequest->save();

        return $serviceRequest->fresh();
    }
}