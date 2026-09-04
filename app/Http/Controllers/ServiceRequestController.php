<?php

namespace App\Http\Controllers;

use App\Actions\ConfirmRequest;
use App\Actions\ExtractRequestData;
use App\Actions\UpdateRequest;
use App\Enums\ServiceRequestStatus;
use App\Http\Requests\ServiceRequest\StoreRequest;
use App\Http\Requests\ServiceRequest\UpdateRequest as UpdateRequestForm;
use App\Models\ServiceRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Inertia\Response;

class ServiceRequestController extends Controller
{
    public function create(Request $request): Response
    {
        $serviceRequest = null;
        $requestId = $request->integer('request_id')
            ?: $request->session()->get('request_builder_request_id');

        if ($requestId) {
            $candidate = ServiceRequest::find($requestId);

            if ($candidate && Gate::forUser($request->user())->allows('view', $candidate)) {
                $serviceRequest = $candidate;
            }
        }

        return Inertia::render('user/requests/Create', [
            'intent' => $request->string('intent')->trim()->toString(),
            'request' => $serviceRequest ? $this->transform($serviceRequest) : null,
            'initialStep' => $request->string('step')->toString(),
            'occasions' => $this->occasions(),
        ]);
    }

    public function store(StoreRequest $request, ExtractRequestData $extractRequestData): RedirectResponse
    {
        $description = trim($request->validated('description'));
        $extracted = $extractRequestData->handle($description);

        $serviceRequest = ServiceRequest::create([
            'user_id' => $request->user()?->id,
            'status' => ServiceRequestStatus::Draft,
            'description' => $description,
            ...$extracted,
            'currency' => 'EUR',
        ]);

        $request->session()->put('request_builder_request_id', $serviceRequest->id);

        return to_route('app.requests.create', [
            'request_id' => $serviceRequest->id,
            'step' => 'preview',
        ]);
    }

    public function update(
        UpdateRequestForm $request,
        ServiceRequest $serviceRequest,
        UpdateRequest $updateRequest,
    ): RedirectResponse {
        Gate::forUser($request->user())->authorize('update', $serviceRequest);

        $updateRequest->handle($serviceRequest, $request->validated());

        $request->session()->put('request_builder_request_id', $serviceRequest->id);

        return to_route('app.requests.create', [
            'request_id' => $serviceRequest->id,
            'step' => 'preview',
        ]);
    }

    public function confirm(
        Request $request,
        ServiceRequest $serviceRequest,
        ConfirmRequest $confirmRequest,
    ): RedirectResponse {
        Gate::forUser($request->user())->authorize('confirm', $serviceRequest);

        $confirmRequest->handle($serviceRequest);

        $request->session()->put('request_builder_request_id', $serviceRequest->id);

        return to_route('app.requests.create', [
            'request_id' => $serviceRequest->id,
            'step' => 'preview',
        ]);
    }

    public function submit(Request $request, ServiceRequest $serviceRequest): RedirectResponse
    {
        Gate::forUser($request->user())->authorize('submit', $serviceRequest);

        if (! $request->user()) {
            $request->session()->put('request_builder_request_id', $serviceRequest->id);
            $request->session()->put('request_builder_after_auth', true);

            return to_route('login');
        }

        $serviceRequest->update([
            'user_id' => $request->user()->id,
            'status' => ServiceRequestStatus::Sent,
        ]);

        $request->session()->forget([
            'request_builder_request_id',
            'request_builder_after_auth',
        ]);

        return to_route('app.home');
    }

    private function transform(ServiceRequest $request): array
    {
        return [
            'id' => $request->id,
            'status' => $request->status->value,
            'description' => $request->description,
            'category' => $request->category,
            'occasion' => $request->occasion,
            'event_date' => $request->event_date?->format('Y-m-d'),
            'event_time' => $request->event_time,
            'participants' => $request->participants,
            'location_text' => $request->location_text,
            'budget_min' => $request->budget_min !== null ? (float) $request->budget_min : null,
            'budget_max' => $request->budget_max !== null ? (float) $request->budget_max : null,
            'currency' => $request->currency,
            'fulfillment_method' => $request->fulfillment_method,
            'style' => $request->style ?? [],
            'flavors' => $request->flavors ?? [],
            'requirements' => $request->requirements,
        ];
    }

    private function occasions(): array
    {
        return [
            ['value' => 'birthday', 'label' => 'Geburtstag'],
            ['value' => 'wedding', 'label' => 'Hochzeit'],
            ['value' => 'engagement', 'label' => 'Verlobung'],
            ['value' => 'baptism', 'label' => 'Taufe'],
            ['value' => 'baby-shower', 'label' => 'Baby Shower'],
            ['value' => 'anniversary', 'label' => 'Jubiläum'],
            ['value' => 'graduation', 'label' => 'Abschluss'],
            ['value' => 'retirement', 'label' => 'Ruhestand'],
            ['value' => 'other', 'label' => 'Etwas anderes'],
        ];
    }
}