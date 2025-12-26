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

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::controller(ArtisanController::class)->group(function () {
        Route::get('/artisan/profile/create', 'create')->name('artisan.profile.create');
        Route::get('/artisan/profile/edit', 'edit')->name('artisan.profile.edit');
        Route::get('/artisan/profile', 'show')->name('artisan.profile.show');
        Route::post('/artisan/profile', 'store');
        Route::put('/artisan/profile', 'update');
    });
});