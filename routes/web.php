<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::resource('users', UserController::class);
Route::resource('events', EventController::class);
Route::resource('tickets', TicketController::class);
Route::resource('bookings', BookingController::class);
Route::resource('venues', VenueController::class);
Route::resource('categories', CategoryController::class);
