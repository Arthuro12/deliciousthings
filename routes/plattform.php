<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Middleware\HandleInertiaRequests;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\Auth\SessionController;
use App\Http\Controllers\Artisan\ProfileController;
use App\Http\Controllers\Artisan\MessageController;
use App\Http\Controllers\SearchController;

Route::middleware(HandleInertiaRequests::class)->group(function () {
    Route::controller(RegistrationController::class)->group(function () {
        Route::get('/register', 'create')->name('register.create');
        Route::post('/register', 'store');
    });

    Route::controller(SessionController::class)->group(function () {
        Route::get('/login', 'create')->name('login');
        Route::post('/login', 'store')->name('login.store');
        Route::post('/logout', 'destroy')->name('login.destroy')->middleware('auth');
    });
});

Route::middleware(['auth:sanctum', HandleInertiaRequests::class])->group(function () {
    // Route::get('/inspirations', function () {
    //     return Inertia::render('Inspirations');
    // });

    // Route::controller(SearchController::class)->group(function () {
    //     Route::get('/search', 'index');
    //     Route::get('/artisans', 'index');
    //     Route::get('/creations', 'index');
    // });

    Route::controller(ProfileController::class)->group(function () {
        Route::get('/artisan/profile/create', 'create')->name('artisan.profile.create');
        Route::get('/artisan/profile/edit', 'edit')->name('artisan.profile.edit');
        Route::get('/artisan/profile', 'show')->name('artisan.profile.show');
        Route::post('/artisan/profile', 'store');
        Route::put('/artisan/profile/photo', 'storeProfilePhoto');
        Route::delete('/artisan/profile/photo/{media}', 'deleteProfilePhoto');
        Route::patch('/artisan/profile/basic', 'updateBasicProfile');
        Route::put('/artisan/profile/baked-goods', 'syncBakedGoods');
        Route::put('/artisan/profile/dietary-options', 'syncDietaryOptions');
        Route::patch('/artisan/profile/services', 'updateServices');
        Route::post('/artisan/profile/addresses', 'storeAddress');
        Route::patch('/artisan/profile/addresses/{address}', 'updateAddress');
        Route::delete('/artisan/profile/addresses/{address}', 'deleteAddress');
        Route::patch('/artisan/profile/addresses/{address}/visibility', 'updateAddressVisibility');
        Route::post('/artisan/profile/gallery', 'uploadPhotos');
        Route::delete('/artisan/profile/gallery/{media}', 'deletePhoto');
        Route::patch('/artisan/profile/pickup-methods', 'updatePickupMethods');
        Route::patch('/artisan/profile/network', 'updateNetwork');
    });

    Route::controller(MessageController::class)->group(function () {
        Route::get('/artisan/messages/{message}', 'show');
        Route::get('/artisan/messages', 'index');
    });
});