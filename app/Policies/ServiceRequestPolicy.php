<?php

namespace App\Policies;

use App\Models\ServiceRequest;
use App\Models\User;

class ServiceRequestPolicy
{
    public function view(?User $user, ServiceRequest $request): bool
    {
        if ($user && (int) $request->user_id === (int) $user->id) {
            return true;
        }

        return $request->user_id === null
            && in_array($request->status->value, ['draft', 'confirmed'], true)
            && $this->belongsToCurrentGuestSession($request);
    }

    public function update(?User $user, ServiceRequest $request): bool
    {
        return in_array($request->status->value, ['draft', 'confirmed'], true)
            && $this->view($user, $request);
    }

    public function confirm(?User $user, ServiceRequest $request): bool
    {
        return $request->status->value === 'draft'
            && $this->view($user, $request);
    }

    public function submit(?User $user, ServiceRequest $request): bool
    {
        return $request->status->value === 'confirmed'
            && $this->view($user, $request);
    }
    private function belongsToCurrentGuestSession(ServiceRequest $request): bool
    {
        return (int) request()->session()->get('request_builder_request_id') === (int) $request->id;
    }
}