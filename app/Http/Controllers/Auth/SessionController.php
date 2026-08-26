<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

use App\Http\Controllers\Controller;
use Illuminate\Validation\Rules\Password;
use Inertia\Inertia;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function create()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string', Password::min(8)],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return to_route('app.home');
        }

        return back()
            ->withErrors(['message' => __('The provided credential do not match our records.')], 'login')
            ->withInput($request->except('password'));
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