<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\SpecialityController;

Route::get('/specialities', [SpecialityController::class, 'index'])->middleware('auth:sanctum');