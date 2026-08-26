<?php

namespace App\Http\Controllers\User;

use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class ProjectController extends Controller
{
    public function create(Request $request): Response
    {
        return Inertia::render(
            'user/Projects',
            [
                'projects' => $request->user()->projects->toArray(),
            ],
        );
    }
}