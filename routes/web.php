<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\Auth\SessionController;
use App\Http\Controllers\ArtisanController;

Route::get('/', function () {
    return Inertia::render('Home');
})->name('home');

Route::controller(RegistrationController::class)->group(function () {
    Route::get('/register', 'create')->name('register.create');
    Route::post('/register', 'store');
});

Route::controller(SessionController::class)->group(function () {
    Route::get('/login', 'create')->name('login');
    Route::post('/login', 'store')->name('login.store');
    Route::post('/logout', 'destroy')->name('login.destroy');
});

Route::group(['prefix' => 'users/{user}/', 'middleware' => 'auth:sanctum'], function () {
    Route::controller(ArtisanController::class)->group(function () {
        Route::get('artisan/create', 'create')->name('artisan.create');
        Route::get('artisan/{artisan}', 'show')->name('artisan.show');
        Route::post('artisan', 'store');
    });
});