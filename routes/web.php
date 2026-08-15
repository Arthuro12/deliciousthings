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
    Route::post('signup', 'store')->name('signup.store');
});

Route::post('logout', [SessionController::class, 'logout'])->name('logout')->middleware('auth');

Route::controller(SessionController::class)->group(function () {
    Route::get('/login', 'create')->name('login');
    Route::post('/login', 'store')->name('login.store');
});

Route::get('/login', function () {
    return view('login');
})->name('login');