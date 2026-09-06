<?php

namespace App\Actions;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\ServiceRequest;

class ClaimGuestRequest
{
    public function handle(Request $request, User $user): ?ServiceRequest
    {
        $requestId = $request->session()->pull('request_builder_request_id');

        if (!$requestId) {
            return null;
        }

        $serviceRequest = ServiceRequest::query()
            ->whereKey((int) $requestId)
            ->whereNull('user_id')
            ->where('status', 'draft')
            ->first();

        if (!$serviceRequest) {
            return null;
        }

        $serviceRequest->forceFill([
            'user_id' => $user->id,
        ])->save();

        return $serviceRequest->fresh();
    }
}