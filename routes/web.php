<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\Auth\SessionController;
use App\Http\Controllers\NewsletterController;

Route::get('/', function () {
    return view('landing');
})->name('landing');

Route::get('/prototype', function () {
    return view('prototype');
})->name('prototype');

Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])
    ->name('newsletter.subscribe');

Route::get('/newsletter/confirmed', [NewsletterController::class, 'confirmed'])
    ->name('newsletter.confirmed');

// Route::controller(RegistrationController::class)->group(function () {
//     Route::get('signup', 'create')->name('signup');
//     Route::post('signup', 'signup')->name('signup.store');
// });

// Route::post('logout', [SessionController::class, 'logout'])->name('logout')->middleware('auth');

// Route::controller(SessionController::class)->group(function () {
//     Route::get('/login', 'create')->name('login');
//     Route::post('/login', 'login')->name('login.store');
// });