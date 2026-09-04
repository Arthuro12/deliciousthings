<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Inertia\Inertia;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Actions\ClaimGuestRequest;

class RegistrationController extends Controller
{
    public function create()
    {
        return view('signup');
    }

    public function signup(
        Request $request,
        ClaimGuestRequest $claimGuestRequest,
    ) {
        $attrs = $request->validate([
            'first_name' => 'nullable',
            'last_name' => 'nullable',
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string', Password::min(8)],
        ]);

        $user = User::create($attrs);

        Auth::login($user);
        $request->session()->regenerate();

        $guestRequest = $claimGuestRequest->handle($request, $user);
        if ($guestRequest) {
            return to_route('app.requests.create', [
                'request_id' => $guestRequest->id,
                'step' => 'preview',
            ]);
        }

        return to_route('app.home');
    }
}