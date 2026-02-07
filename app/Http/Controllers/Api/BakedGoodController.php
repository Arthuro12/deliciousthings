<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\JsonResponse; 

use App\Http\Controllers\Controller;
use App\Models\BakedGood;

class BakedGoodController extends Controller
{
    public function index(): JsonResponse 
    {
        return response()->json([
            'data' => BakedGood::all()
        ]);
    }
}