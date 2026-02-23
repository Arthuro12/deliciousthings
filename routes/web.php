<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\Auth\SessionController;
use App\Http\Controllers\Artisan\ProfileController;
use App\Http\Controllers\Artisan\PublicProfileController;
use App\Http\Controllers\Artisan\MessageController;
use App\Http\Controllers\SearchController;

Route::get('/', HomeController::class)->name('home');

Route::get('/search', SearchController::class);

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
        Route::post('/artisan/profile/addresses', 'storeAddress');
        Route::patch('/artisan/profile/addresses/{address}', 'updateAddress');
        Route::delete('/artisan/profile/addresses/{address}', 'deleteAddress');
        Route::post('/artisan/profile/gallery', 'uploadPhotos');
        Route::delete('/artisan/profile/gallery/{media}', 'deletePhoto');
        Route::patch('/artisan/profile/services', 'updateServices');
        Route::patch('/artisan/profile/network', 'updateNetwork');
    });
});

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::controller(MessageController::class)->group(function () {
        Route::get('/artisan/messages', 'index');
        Route::get('/artisan/messages/{message}', 'show');
        Route::post('/artisan/messages', 'store');
    });
});

Route::get('/artisan/{artisan:name}', [PublicProfileController::class, 'show']);