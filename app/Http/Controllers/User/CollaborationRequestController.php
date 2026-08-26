<?php

namespace App\Http\Controllers\User;

use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class CollaborationRequestController extends Controller
{
    public function create(): Response
    {
        return Inertia::render('user/Requests');
    }
}