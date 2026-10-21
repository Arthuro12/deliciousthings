<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\Auth\SessionController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\ServiceRequestController;
use App\Http\Controllers\Artisan\PublicProfileController;
use App\Http\Middleware\HandleInertiaRequests;

Route::get('/', function () {
    return view('landing');
})->name('landing');

Route::get('/prototype', function () {
    return view('prototype');
})->name('prototype');

Route::middleware(HandleInertiaRequests::class)
    ->get('/artisans/{artisan}', [PublicProfileController::class, 'show'])
    ->name('artisan.public.show');

Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])
    ->name('newsletter.subscribe');

Route::get('/newsletter/confirmed', [NewsletterController::class, 'confirmed'])
    ->name('newsletter.confirmed');

// The request builder is public so visitors can see value before signing up.
Route::middleware(HandleInertiaRequests::class)
    ->prefix('app')
    ->name('app.')
    ->group(function () {
        Route::get('/requests/create', [ServiceRequestController::class, 'create'])->name('requests.create');
        Route::post('/requests', [ServiceRequestController::class, 'store'])->name('requests.store');
        Route::patch('/requests/{serviceRequest}', [ServiceRequestController::class, 'update'])->name('requests.update');
        Route::post('/requests/{serviceRequest}/confirm', [ServiceRequestController::class, 'confirm'])->name('requests.confirm');
        Route::post('/requests/{serviceRequest}/submit', [ServiceRequestController::class, 'submit'])->name('requests.submit');
    });

// Route::controller(RegistrationController::class)->group(function () {
//     Route::get('signup', 'create')->name('signup');
//     Route::post('signup', 'signup')->name('signup.store');
// });

// Route::post('logout', [SessionController::class, 'logout'])->name('logout')->middleware('auth');

// Route::controller(SessionController::class)->group(function () {
//     Route::get('/login', 'create')->name('login');
//     Route::post('/login', 'login')->name('login.store');
// });
Route::controller(RegistrationController::class)->group(function () {
    Route::get('/signup', 'create')->name('signup');
    Route::post('/signup', 'signup')->name('signup.store');
});

Route::controller(SessionController::class)->group(function () {
    Route::get('/login', 'create')->name('login');
    Route::post('/login', 'login')->name('login.store');
    Route::post('/logout', 'logout')->middleware('auth')->name('logout');
});
