<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;

use App\Models\Service;

class ServiceController
{
    public function index(): JsonResponse
    {
        return response()->json([
            'data' => Service::all()
        ]);
    }
}