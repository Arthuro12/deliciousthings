<?php

namespace App\Http\Controllers;

use Illuminate\Http\Client\RequestException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class NewsletterController extends Controller
{
    public function subscribe(Request $request): RedirectResponse { 
        $validated = $request->validate([ 'email' => [ 'required', 'email', 'max:255', ], ]); 
        
        try { 
            Log::info('Newsletter subscription requested.', [ 'email' => $validated['email'], ]); 

            $response = Http::withHeaders([ 
                'api-key' => config('services.brevo.api_key'), 
                'Content-Type' => 'application/json', 
                'Accept' => 'application/json', 
            ])->post( 'https://api.brevo.com/v3/contacts/doubleOptinConfirmation', 
                [ 
                    'email' => $validated['email'], 
                    'includeListIds' => [ (int) config('services.brevo.newsletter_list_id'), ], 
                    'templateId' => (int) config('services.brevo.doi_template_id'), 
                    'redirectionUrl' => route('newsletter.confirmed'), 
                ] ); 
            Log::info('Brevo subscription response received.', [ 'email' => $validated['email'], 'status' => $response->status(), 'successful' => $response->successful(), 'body' => $response->json(), ]); 
            $response->throw(); 
        } catch (RequestException $exception) { 
            Log::error('Brevo newsletter subscription failed.', [ 'email' => $validated['email'], 'status' => $exception->response?->status(), 'response' => $exception->response?->json(), 'message' => $exception->getMessage(), ]);
            report($exception); 
            return back() ->withInput() ->withErrors([ 'email' => 'We could not process your subscription. Please try again.', ]); 
        } 
        
        return back()->with( 'newsletter_success', 'Please check your inbox to confirm your subscription.' ); 
    }

    public function confirmed()
    {
        return view('newsletter.confirmed');
    }
}