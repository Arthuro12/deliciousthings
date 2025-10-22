<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\Auth\SessionController;

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

Route::get('/profile', function () {
    return Inertia::render('profile/CreateProfile', ['user' => null]);
})->middleware('auth')->name('profile.create');