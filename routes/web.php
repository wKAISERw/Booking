<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VenueController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\MessageController;

use Illuminate\Support\Facades\Route;


// Public routes
Route::get('/', function () {
    return view('home');
});
Route::get('/dashboard', function () {
    return redirect('/');
})->name('dashboard');

Route::get('/test/admins', function () {
    $admins = App\Models\User::where('role', 'admin')->get();
    return view('chat.admins', compact('admins'));
});


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

    // Cart routes
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{ticket}', [CartController::class, 'addItem'])->name('cart.add');
    Route::delete('/cart/remove/{ticket}', [CartController::class, 'removeItem'])->name('cart.remove');
    Route::get('/cart/add/{ticket}', [CartController::class, 'showAddForm'])->name('cart.showAddForm');

    // Order routes
    Route::get('/orders/confirm', [OrderController::class, 'confirm'])->name('orders.confirm');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::post('/orders/{order}/cancel', [OrderController::class, 'cancel'])->name('orders.cancel');
    Route::get('/orders/history', [OrderController::class, 'history'])->name('orders.history');

    Route::middleware(['auth', 'role:user'])->get('/messages', [MessageController::class, 'userIndex'])->name('user.messages');
    Route::middleware(['auth', 'role:admin'])->get('/messages/admin', [MessageController::class, 'adminIndex'])->name('admin.messages');
    Route::middleware('auth')->get('/chat/{id}', [MessageController::class, 'chat'])->name('chat');
    Route::post('/chat/send', [MessageController::class, 'send'])->name('chat.send');
});

// Public event routes
Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');

// Public ticket routes
Route::get('/tickets', [TicketController::class, 'index'])->name('tickets.index');
Route::get('/tickets/{ticket}', [TicketController::class, 'show'])->name('tickets.show');

// Public venue routes
Route::get('/venues/{venue}', [VenueController::class, 'show'])->name('venues.show');

// Authentication routes (provided by Breeze)
require __DIR__.'/auth.php';