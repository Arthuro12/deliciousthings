<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

use App\Http\Requests\CreateProfileRequest;

class ProfileController extends Controller
{
    public function create()
    {
        return Inertia::render('profile/CreateProfile');
    }

    public function store(CreateProfileRequest $request)
    {
        // return back()->withInput();
    }
}