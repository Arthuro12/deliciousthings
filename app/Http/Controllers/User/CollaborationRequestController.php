<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ServiceRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class CollaborationRequestController extends Controller
{
    public function index(Request $request): Response
    {
        $requests = ServiceRequest::query()
            ->with('artisan:id,name,company_name')
            ->where('user_id', $request->user()->id)
            ->latest()
            ->get()
            ->map(fn (ServiceRequest $item) => [
                'id' => $item->id,
                'status' => $item->status->value,
                'description' => $item->description,
                'occasion' => $item->occasion,
                'event_date' => $item->event_date?->format('Y-m-d'),
                'participants' => $item->participants,
                'location_text' => $item->location_text,
                'quote_amount' => $item->quote_amount !== null ? (float) $item->quote_amount : null,
                'currency' => $item->currency,
                'artisan_response' => $item->artisan_response,
                'artisan_name' => $item->artisan?->company_name ?: $item->artisan?->name,
                'created_at' => $item->created_at?->toIso8601String(),
            ]);

        return Inertia::render('user/Requests', ['requests' => $requests]);
    }
}