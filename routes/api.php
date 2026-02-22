<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\BakedGoodController;
use App\Http\Controllers\Api\DietaryOptionController;

Route::get('/baked-goods', [BakedGoodController::class, 'index']);
Route::get('/dietary-options', [DietaryOptionController::class, 'index']);