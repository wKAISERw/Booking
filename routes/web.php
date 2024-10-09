<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VenueController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\BookingController;


Route::get('/', function () {
    return view('home');
});
Route::resources([
    'venues' => VenueController::class,
    'events' => EventController::class,
    'tickets' => TicketController::class,
    'bookings' => BookingController::class,
]);
