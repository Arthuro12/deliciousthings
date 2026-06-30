<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\Auth\SessionController;
use App\Http\Controllers\Artisan\ProfileController;
use App\Http\Controllers\Artisan\PublicProfileController;
use App\Http\Controllers\Artisan\MessageController;
use App\Http\Controllers\Artisan\PreOrderController;
use App\Http\Controllers\SearchController;

Route::get('/', function () {
    return view('pages.home');
})->name('home');

// Route::get('/', HomeController::class)->name('home');

// Route::group(['middleware' => 'auth:sanctum'], function () {
//     Route::controller(MessageController::class)->group(function () {
//         Route::get('/artisans/pre-orders/{message}', 'show');
//         Route::get('/artisans/messages', 'index');
//     });
// });

// Route::get('/artisans/{artisan:name}', [PublicProfileController::class, 'show']);
// Route::post('/artisans/{artisan}/messages', [MessageController::class, 'store']);
// Route::post('/artisans/{artisan}/pre-orders', [PreOrderController::class, 'store']);

require __DIR__ . '/plattform.php';