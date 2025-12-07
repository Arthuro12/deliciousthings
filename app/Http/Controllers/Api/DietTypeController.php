<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;

use App\Models\DietType;

class DietTypeController
{
    public function index(): JsonResponse
    {
        return response()->json([
            'data' => DietType::all()
        ]);
    }
}