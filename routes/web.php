<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VenueController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartController;

use Illuminate\Support\Facades\Route;


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
        Route::resource('orders', OrderController::class); // для CRUD операцій з замовленнями
    });

    // Cart routes
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{ticket}', [CartController::class, 'addItem'])->name('cart.add');

    Route::delete('/cart/remove/{cartItem}', [CartController::class, 'removeItem'])->name('cart.remove');
    Route::patch('/cart/update/{cartItem}', [CartController::class, 'updateItem'])->name('cart.update');


    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::post('/orders/{order}/cancel', [OrderController::class, 'cancel'])->name('orders.cancel');
    Route::post('/orders/{order}/confirm', [OrderController::class, 'confirm'])->name('orders.confirm');



    // Booking routes (if you still need them separately from orders)
    Route::resource('bookings', BookingController::class);
});

// Public event routes
Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');
