<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules\Password;
use Inertia\Inertia;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Actions\ClaimGuestRequest;

class SessionController extends Controller
{
    public function create()
    {
        return view('login');
    }

    public function login(
        Request $request,
        ClaimGuestRequest $claimGuestRequest,
    ) {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string', Password::min(8)],
        ]);

        if (!Auth::attempt($credentials)) {
            return back()
                ->withErrors(
                    ['message' => __('The provided credentials do not match our records.')],
                    'login',
                )
                ->withInput($request->except('password'));
        }

        $request->session()->regenerate();
        $claimGuestRequest->handle($request, $request->user());

        if ($request->session()->pull('request_builder_after_auth', false)) {
            return to_route('app.requests.create', [
                'step' => 'preview',
            ]);
        }

        return to_route('app.home');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        Log::notice(now()->toString() . json_encode(Auth::user()));

        return to_route('home');
    }
}