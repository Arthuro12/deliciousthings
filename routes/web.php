<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\Auth\SessionController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::controller(RegistrationController::class)->group(function () {
    Route::get('signup', 'create')->name('signup');
    Route::post('signup', 'signup')->name('signup.store');
});

Route::post('logout', [SessionController::class, 'logout'])->name('logout')->middleware('auth');

Route::controller(SessionController::class)->group(function () {
    Route::get('/login', 'create')->name('login');
    Route::post('/login', 'login')->name('login.store');
});