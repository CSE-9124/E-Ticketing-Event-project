<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\EventOrganizerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\Admin;
use App\Http\Middleware\Organizer;
use App\Http\Middleware\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {

    // Admin Routes
    Route::middleware([Admin::class])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

        // User Management
        Route::get('/users', [AdminController::class, 'manageUsers'])->name('users');
        Route::get('/users/create', [AdminController::class, 'createUser'])->name('users.create');
        Route::post('/users/store', [AdminController::class, 'storeUser'])->name('users.store');
        Route::get('/users/{id}/edit', [AdminController::class, 'editUser'])->name('users.edit');
        Route::put('/users/{id}/update', [AdminController::class, 'updateUser'])->name('users.update');
        Route::delete('/users/{id}/delete', [AdminController::class, 'deleteUser'])->name('users.delete');

        // Event Management
        Route::get('/events', [AdminController::class, 'manageEvents'])->name('events');
        Route::get('/events/create', [AdminController::class, 'createEvent'])->name('events.create');
        Route::post('/events/store', [AdminController::class, 'storeEvent'])->name('events.store');
        Route::get('/events/{id}/edit', [AdminController::class, 'editEvent'])->name('events.edit');
        Route::put('/events/{id}/update', [AdminController::class, 'updateEvent'])->name('events.update');
        Route::delete('/events/{id}/delete', [AdminController::class, 'deleteEvent'])->name('events.delete');
    });

    // Event_Organizer Routes
    Route::middleware([Organizer::class])->prefix('organizer')->name('organizer.')->group(function () {
        Route::get('/dashboard', [EventOrganizerController::class, 'dashboard'])->name('dashboard');
    });

    // User Routes
    Route::middleware([User::class])->prefix('user')->name('user.')->group(function () {
        Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
