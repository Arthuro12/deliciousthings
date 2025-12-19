<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function create()
    {
        return Inertia::render('auth/Login');
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $createArtisanPageUrl = route('artisan.profile.create');
            return redirect()->intended($createArtisanPageUrl);
        }

        return back()->withErrors(['message' => __('The provided credential do not match our records.')], 'login');
    }

    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}