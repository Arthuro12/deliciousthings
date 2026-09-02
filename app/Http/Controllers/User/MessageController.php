<?php

namespace App\Http\Controllers\User;

use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class MessageController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('user/Messages');
    }
}