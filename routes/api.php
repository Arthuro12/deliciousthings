<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\DietTypeController;
use App\Http\Controllers\Api\SpecialityController;

Route::get('/specialities', [SpecialityController::class, 'index'])->middleware('auth:sanctum');
Route::get('/diet-types', [DietTypeController::class, 'index'])->middleware('auth:sanctum');