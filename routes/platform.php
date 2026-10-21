<?php

use App\Http\Controllers\Artisan\ProfileController as ArtisanProfileController;
use App\Http\Controllers\Artisan\CreationController as ArtisanCreationController;
use App\Http\Controllers\Artisan\ServiceRequestController as ArtisanServiceRequestController;
use App\Http\Controllers\ServiceRequestController;
use App\Http\Controllers\User\CollaborationRequestController;
use App\Http\Controllers\User\MessageController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\ProjectController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/app', fn () => Inertia::render('Home'))->name('home');

Route::post('/app/requests/{serviceRequest}/complete', [ServiceRequestController::class, 'complete'])->name('requests.complete');
Route::post('/app/requests/{serviceRequest}/cancel', [ServiceRequestController::class, 'cancel'])->name('requests.cancel');

Route::get('/app/projects', [ProjectController::class, 'index'])->name('user.projects');
Route::get('/app/projects/create', [ProjectController::class, 'create'])->name('user.projects.create');
Route::get('/app/messages', [MessageController::class, 'index'])->name('user.messages');
Route::get('/app/requests', [CollaborationRequestController::class, 'index'])->name('user.requests');
Route::get('/app/profile', [ProfileController::class, 'index'])->name('user.profile');

Route::get('/app/artisan/requests', [ArtisanServiceRequestController::class, 'index'])->name('artisan.requests');
Route::patch('/app/artisan/requests/{serviceRequest}/respond', [ArtisanServiceRequestController::class, 'respond'])->name('artisan.requests.respond');
Route::get('/app/artisan/creations', [ArtisanCreationController::class, 'index'])->name('artisan.creations.index');
Route::get('/app/artisan/creations/create', [ArtisanCreationController::class, 'create'])->name('artisan.creations.create');
Route::post('/app/artisan/creations', [ArtisanCreationController::class, 'store'])->name('artisan.creations.store');
Route::get('/app/artisan/creations/{creation}/edit', [ArtisanCreationController::class, 'edit'])->name('artisan.creations.edit');
Route::put('/app/artisan/creations/{creation}', [ArtisanCreationController::class, 'update'])->name('artisan.creations.update');
Route::patch('/app/artisan/creations/{creation}/publication', [ArtisanCreationController::class, 'togglePublication'])->name('artisan.creations.publication');
Route::delete('/app/artisan/creations/{creation}', [ArtisanCreationController::class, 'destroy'])->name('artisan.creations.destroy');
Route::get('/app/artisan/profile/create', [ArtisanProfileController::class, 'create'])->name('artisan.profile.create');
Route::post('/app/artisan/profile', [ArtisanProfileController::class, 'store'])->name('artisan.profile.store');
