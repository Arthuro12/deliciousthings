<?php

namespace App\Policies;

use App\Enums\ServiceRequestStatus;
use App\Models\ServiceRequest;
use App\Models\User;

class ServiceRequestPolicy
{
    public function view(?User $user, ServiceRequest $request): bool
    {
        if ($user && (int) $request->user_id === (int) $user->id) {
            return true;
        }

        if (
            $user?->artisan
            && (int) $request->artisan_id === (int) $user->artisan->id
            && ! in_array($request->status, [
                ServiceRequestStatus::Draft,
                ServiceRequestStatus::Confirmed,
            ], true)
        ) {
            return true;
        }

        return $request->user_id === null
            && in_array($request->status->value, ['draft', 'confirmed'], true)
            && (int) request()->session()->get('request_builder_request_id') === (int) $request->id;
    }

    public function update(?User $user, ServiceRequest $request): bool
    {
        return in_array($request->status->value, ['draft', 'confirmed'], true)
            && $this->view($user, $request);
    }

    public function confirm(?User $user, ServiceRequest $request): bool
    {
        return $request->status === ServiceRequestStatus::Draft
            && $this->view($user, $request);
    }

    public function submit(?User $user, ServiceRequest $request): bool
    {
        return $request->status === ServiceRequestStatus::Confirmed
            && $request->artisan_id !== null
            && $this->view($user, $request);
    }

    public function complete(User $user, ServiceRequest $request): bool
    {
        return $request->status === ServiceRequestStatus::Responded
            && (int) $request->user_id === (int) $user->id;
    }

    public function cancel(User $user, ServiceRequest $request): bool
    {
        return (int) $request->user_id === (int) $user->id
            && in_array($request->status, [
                ServiceRequestStatus::Draft,
                ServiceRequestStatus::Confirmed,
                ServiceRequestStatus::Sent,
                ServiceRequestStatus::Responded,
                ServiceRequestStatus::Declined,
            ], true);
    }

    public function respond(User $user, ServiceRequest $request): bool
    {
        $artisan = $user->artisan;

        return $artisan !== null
            && $request->status === ServiceRequestStatus::Sent
            && (int) $request->artisan_id === (int) $artisan->id;
    }
}