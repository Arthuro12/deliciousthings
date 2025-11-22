<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;

use App\Models\Speciality;

class SpecialityController
{
    public function index(): JsonResponse
    {
        return response()->json([
            'data' => Speciality::all()
        ]);
    }
}