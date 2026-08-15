<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Inertia\Inertia;

use App\Http\Controllers\Controller;
use App\Models\User;

class RegistrationController extends Controller
{
    public function create()
    {
        return view('signup');
    }

    public function store(Request $request)
    {
        $attrs = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'password' => ['required', Password::min(5)],
        ]);

        $user = User::create($attrs);

        Auth::login($user);

        return to_route('app.user.dashboard', ['id' => $user->id]);
    }
}