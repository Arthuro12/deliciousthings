<?php

use App\Enums\ServiceRequestStatus;
use App\Models\Artisan;
use App\Models\ServiceRequest;
use App\Models\User;
use App\Policies\ServiceRequestPolicy;

function requestPolicyFixture(int $artisanId = 20): array
{
    $user = new User();
    $user->id = 10;

    $artisan = new Artisan();
    $artisan->id = $artisanId;
    $user->setRelation('artisan', $artisan);

    $request = new ServiceRequest();
    $request->forceFill([
        'id' => 30,
        'user_id' => 10,
        'artisan_id' => $artisanId,
        'status' => ServiceRequestStatus::Sent,
        'description' => 'Eine individuelle Torte für den Geburtstag.',
    ]);

    return [$user, $request, $artisan];
}

it('allows only the exact recipient artisan to view and answer a submitted request', function () {
    [$recipient, $request] = requestPolicyFixture();
    [$otherArtisan] = requestPolicyFixture(21);
    $otherArtisan->id = 11;
    $policy = new ServiceRequestPolicy();

    expect($policy->view($recipient, $request))->toBeTrue()
        ->and($policy->respond($recipient, $request))->toBeTrue()
        ->and($policy->view($otherArtisan, $request))->toBeFalse()
        ->and($policy->respond($otherArtisan, $request))->toBeFalse();
});

it('does not expose or allow editing a confirmed request before it is sent', function () {
    [$recipient, $request] = requestPolicyFixture();
    $recipient->id = 11;
    $request->status = ServiceRequestStatus::Confirmed;
    $policy = new ServiceRequestPolicy();

    expect($policy->view($recipient, $request))->toBeFalse()
        ->and($policy->update($recipient, $request))->toBeFalse();
});
it('does not allow an unaddressed request to be submitted', function () {
    [$owner, $request] = requestPolicyFixture();
    $request->artisan_id = null;
    $request->status = ServiceRequestStatus::Confirmed;

    expect((new ServiceRequestPolicy())->submit($owner, $request))->toBeFalse();
});
