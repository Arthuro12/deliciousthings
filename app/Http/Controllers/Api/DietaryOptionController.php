<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;

use App\Models\DietaryOption;

class DietaryOptionController
{
    public function index(): JsonResponse
    {
        return response()->json([
            'data' => DietaryOption::all()
        ]);
    }
}