<?php

use App\Http\Controllers\User\CollaborationRequestController;
use App\Http\Controllers\User\MessageController;
use App\Http\Controllers\User\ProfileController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Middleware\HandleInertiaRequests;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ServiceRequestController;
use App\Http\Controllers\User\ProjectController;
// use App\Http\Controllers\Auth\RegistrationController;
// use App\Http\Controllers\Auth\SessionController;
// use App\Http\Controllers\Artisan\ProfileController;
// use App\Http\Controllers\Artisan\MessageController;
// use App\Http\Controllers\SearchController;

// Route::get('app/', function () {
//     return Inertia::render('Home');
// })->name('home');

// Route::get('/codura', function () {
//     return view('codura');
// })->name('codura');


// Route::controller(ServiceRequestController::class)->group(function () {
//     Route::get('/app/requests/create', 'create')->withoutMiddleware('auth:sanctum')->name('requests.create');
//     Route::post('/app/requests', 'store')->name('requests.store');
//     Route::patch('/app/requests/{serviceRequest}', 'update')->name('requests.update');
//     Route::post('/app/requests/{serviceRequest}/submit', 'submit')->name('requests.submit');
//     Route::post('/app/requests/{serviceRequest}/confirm', 'confirm')->name('requests.confirm');
// });

// Route::controller(ProjectController::class)->group(function () {
//     Route::get('app/projects', 'index')->name('user.projects');
//     Route::get('app/projects/create', 'create')->name('user.projects.create');
// });

// Route::get('app/projects/', [ProjectController::class, 'index'])->name('user.projects');

// Route::get('app/messages', [MessageController::class, 'index'])->name('user.messages');

// Route::get('app/requests', [CollaborationRequestController::class, 'index'])->name('user.requests');

// Route::get('app/profile', [ProfileController::class, 'index'])->name('user.profile');

// Route::get('app/artisan/create', function () {
//     return Inertia::render('artisan/CreateArtisan');
// });


// Route::middleware(['auth:sanctum', HandleInertiaRequests::class])->group(function () {
//     Route::controller(ProfileController::class)->group(function () {
//         Route::get('/artisan/profile/create', 'create')->name('artisan.profile.create');
//         Route::get('/artisan/profile/edit', 'edit')->name('artisan.profile.edit');
//         Route::get('/artisan/profile', 'show')->name('artisan.profile.show');
//         Route::post('/artisan/profile', 'store');
//         Route::put('/artisan/profile/photo', 'storeProfilePhoto');
//         Route::delete('/artisan/profile/photo/{media}', 'deleteProfilePhoto');
//         Route::patch('/artisan/profile/basic', 'updateBasicProfile');
//         Route::put('/artisan/profile/baked-goods', 'syncBakedGoods');
//         Route::put('/artisan/profile/dietary-options', 'syncDietaryOptions');
//         Route::patch('/artisan/profile/services', 'updateServices');
//         Route::post('/artisan/profile/addresses', 'storeAddress');
//         Route::patch('/artisan/profile/addresses/{address}', 'updateAddress');
//         Route::delete('/artisan/profile/addresses/{address}', 'deleteAddress');
//         Route::patch('/artisan/profile/addresses/{address}/visibility', 'updateAddressVisibility');
//         Route::post('/artisan/profile/gallery', 'uploadPhotos');
//         Route::delete('/artisan/profile/gallery/{media}', 'deletePhoto');
//         Route::patch('/artisan/profile/pickup-methods', 'updatePickupMethods');
//         Route::patch('/artisan/profile/network', 'updateNetwork');
//     });

//     Route::controller(MessageController::class)->group(function () {
//         Route::get('/artisan/messages/{message}', 'show');
//         Route::get('/artisan/messages', 'index');
//     });
// });