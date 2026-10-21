<?php

namespace App\Http\Controllers\Artisan;

use App\Enums\ServiceRequestStatus;
use App\Http\Controllers\Controller;
use App\Models\ServiceRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;

class ServiceRequestController extends Controller
{
    public function index(Request $request): Response|RedirectResponse
    {
        $artisan = $request->user()->artisan;
        if (! $artisan) {
            return to_route('app.artisan.profile.create')->with('info', 'Erstelle zuerst dein Backprofi-Profil.');
        }

        $requests = ServiceRequest::query()
            ->with('user:id,first_name,last_name')
            ->where('status', ServiceRequestStatus::Sent->value)
            ->where('artisan_id', $artisan->id)
            ->latest()
            ->get()
            ->map(fn (ServiceRequest $item) => [
                'id' => $item->id,
                'description' => $item->description,
                'category' => $item->category,
                'occasion' => $item->occasion,
                'event_date' => $item->event_date?->format('Y-m-d'),
                'event_time' => $item->event_time,
                'participants' => $item->participants,
                'location_text' => $item->location_text,
                'budget_min' => $item->budget_min !== null ? (float) $item->budget_min : null,
                'budget_max' => $item->budget_max !== null ? (float) $item->budget_max : null,
                'currency' => $item->currency,
                'fulfillment_method' => $item->fulfillment_method,
                'style' => $item->style ?? [],
                'flavors' => $item->flavors ?? [],
                'requirements' => $item->requirements,
                'customer_name' => $item->user?->full_name,
                'created_at' => $item->created_at?->toIso8601String(),
            ]);

        return Inertia::render('artisan/Requests', ['requests' => $requests]);
    }

    public function respond(Request $request, ServiceRequest $serviceRequest): RedirectResponse
    {
        $this->authorize('respond', $serviceRequest);

        $data = $request->validate([
            'decision' => ['required', 'in:responded,declined'],
            'artisan_response' => ['required', 'string', 'min:10', 'max:3000'],
            'quote_amount' => ['nullable', 'numeric', 'min:0', 'max:99999999.99'],
        ]);

        DB::transaction(function () use ($request, $serviceRequest, $data) {
            $lockedRequest = ServiceRequest::query()->lockForUpdate()->findOrFail($serviceRequest->id);
            $this->authorize('respond', $lockedRequest);

            $lockedRequest->update([
                'artisan_id' => $request->user()->artisan->id,
                'status' => $data['decision'] === 'declined'
                    ? ServiceRequestStatus::Declined
                    : ServiceRequestStatus::Responded,
                'artisan_response' => trim($data['artisan_response']),
                'quote_amount' => $data['decision'] === 'declined' ? null : ($data['quote_amount'] ?? null),
                'responded_at' => now(),
            ]);
        });

        return to_route('app.artisan.requests')->with('success', 'Deine Antwort wurde an den Kunden gesendet.');
    }
}