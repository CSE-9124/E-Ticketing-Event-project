<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventOrganizerController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\Admin;
use App\Http\Middleware\Organizer;
use App\Http\Middleware\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Home Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/events', [EventController::class, 'index'])->name('events');
Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');
Route::post('/events/{event}/favorite', [EventController::class, 'toggleFavorite'])->middleware('auth')->name('events.favorite');


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

        // Ticket Management
        Route::get('/tickets', [AdminController::class, 'manageTickets'])->name('tickets');
        Route::get('/tickets/event/{event}', [AdminController::class, 'viewEventTickets'])->name('tickets.event');
        Route::post('/tickets/{ticket}/approve', [AdminController::class, 'approveTicket'])->name('tickets.approve');
        Route::post('/tickets/{ticket}/cancel', [AdminController::class, 'cancelTicket'])->name('tickets.cancel');

        // Reports Management
        Route::get('/reports/sales', [AdminController::class, 'salesReport'])->name('reports.sales');
        Route::get('/reports/user-activity', [AdminController::class, 'userActivityReport'])->name('reports.user_activity');
    });

    // Event_Organizer Routes
    Route::middleware([Organizer::class])->prefix('organizer')->name('organizer.')->group(function () {
        Route::get('/dashboard', [EventOrganizerController::class, 'dashboard'])->name('dashboard');

        // Event Management
        Route::get('/events', [EventOrganizerController::class, 'manageEvents'])->name('events');
        Route::get('/events/create', [EventOrganizerController::class, 'createEvent'])->name('events.create');
        Route::post('/events/store', [EventOrganizerController::class, 'storeEvent'])->name('events.store');
        Route::get('/events/{id}/edit', [EventOrganizerController::class, 'editEvent'])->name('events.edit');
        Route::put('/events/{id}/update', [EventOrganizerController::class, 'updateEvent'])->name('events.update');
        Route::delete('/events/{id}/delete', [EventOrganizerController::class, 'deleteEvent'])->name('events.delete');

        // Ticket Management
        Route::get('/tickets', [EventOrganizerController::class, 'manageTickets'])->name('tickets');
        Route::get('/tickets/event/{event}', [EventOrganizerController::class, 'viewEventTickets'])->name('tickets.event');
        Route::post('/tickets/{ticket}/approve', [EventOrganizerController::class, 'approveTicket'])->name('tickets.approve');
        Route::post('/tickets/{ticket}/cancel', [EventOrganizerController::class, 'cancelTicket'])->name('tickets.cancel');
    });

    // User Routes
    Route::middleware([User::class])->prefix('user')->name('user.')->group(function () {
        Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');

        // Booking Management
        Route::get('/bookings', [BookingController::class, 'index'])->name('bookings');
        Route::post('/events/{event}/book', [BookingController::class, 'store'])->name('bookings.store');
        Route::get('/bookings/{ticket}', [BookingController::class, 'show'])->name('bookings.show');
        Route::post('/bookings/{ticket}/cancel', [BookingController::class, 'cancel'])->name('bookings.cancel');

        // Favorite Events Routes
        Route::get('/favorites', [UserController::class, 'favoriteEvents'])->name('favorites');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
