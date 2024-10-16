<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VenueController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\BookingController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckRole; // Підключення middleware

// Public routes
Route::get('/', function () {
    return view('home');
});
Route::get('/dashboard', function () {
    return redirect('/');
})->name('dashboard');

// Authentication routes (provided by Breeze)
require __DIR__.'/auth.php';

// Protected routes
Route::middleware(['auth', 'verified'])->group(function () {

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Admin routes with 'role' middleware
    Route::middleware(['auth', 'role:admin'])->group(function () {
        Route::resource('venues', VenueController::class);
        Route::resource('events', EventController::class)->except(['index', 'show']);
        Route::resource('tickets', TicketController::class);
    });

    // User routes
    Route::resource('bookings', BookingController::class);
});

// Public event routes
Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');
