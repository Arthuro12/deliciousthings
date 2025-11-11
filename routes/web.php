<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\Auth\SessionController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return Inertia::render('Home');
})->name('home');

Route::controller(RegistrationController::class)->group(function () {
    Route::get('/register', 'create');
    Route::post('/register', 'store');
});

Route::controller(SessionController::class)->group(function () {
    Route::get('/login', 'create')->name('login');
    Route::post('/login', 'store');
    Route::post('/logout', 'destroy');
});

Route::group(['prefix' => 'users/{user}/', 'middleware' => 'auth:sanctum'], function () {
    Route::controller(ProfileController::class)->group(function () {
        Route::get('profile/create', 'create')->name('profile');
        Route::post('profile', 'store');
    });
});
