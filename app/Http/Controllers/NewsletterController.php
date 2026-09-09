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

            $this->unblockContact($request->string('email'));

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
                ]); 
            Log::info('Brevo subscription response received.', [ 'email' => $validated['email'], 'status' => $response->status(), 'successful' => $response->successful(), 'body' => $response->json(), ]); 
            $response->throw(); 
        } catch (RequestException $exception) { 
            Log::error('Brevo newsletter subscription failed.', [ 'email' => $validated['email'], 'status' => $exception->response?->status(), 'response' => $exception->response?->json(), 'message' => $exception->getMessage(), ]);
            report($exception); 
            return back() ->withInput() ->withErrors([ 'email' => 'We could not process your subscription. Please try again.', ]); 
        } 
        
        return back()->with( 'newsletter_success', 'Please check your inbox to confirm your subscription.' ); 
    }

    /** 
     * Remove an email address from Brevo's transactional blocklist. 
     * @return bool If the contact was blocked and has been unblocked or if the contact was not found in the blocklist 
     * @throws RequestException 
     */
    private function unblockContact(string $email): bool 
    { 
        $response = Http::withHeaders([ 
            'api-key' => config('services.brevo.api_key'), 
            'Accept' => 'application/json', 
        ])->delete('https://api.brevo.com/v3/smtp/blockedContacts/' . rawurlencode($email) ); 
        
        /* 
        * Brevo returns 404 when the email address is not in the 
        * transactional blocklist. This is not an error for us: 
        * the contact simply does not need to be unblocked. 
        */
        if ($response->status() === 404) { 
            Log::info('Brevo contact was not blocked.', ['email' => $email,]); 
            return false; 
        } 
        Log::info('Brevo contact unblock response received.', [
            'email' => $email, 
            'status' => $response->status(), 
            'successful' => $response->successful(), 
            'body' => $response->json(), 
        ]); 
        $response->throw(); 
        return true; 
    }

    public function confirmed()
    {
        return view('newsletter.confirmed');
    }
}