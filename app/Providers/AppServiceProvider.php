<?php

namespace App\Providers;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Booking;
use App\Models\Ticket;
use App\Models\Venue;
use App\Models\Event;
use App\Models\Order;
use App\Policies\BookingPolicy;
use App\Policies\TicketPolicy;
use App\Policies\VenuePolicy;
use App\Policies\EventPolicy;
use App\Policies\OrderPolicy;
use Illuminate\Support\Facades\View;
use App\View\Composers\BookingsComposer;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public const HOME = '/';
    protected $policies = [
        Booking::class => BookingPolicy::class,
        Ticket::class => TicketPolicy::class,
        Venue::class => VenuePolicy::class,
        Event::class => EventPolicy::class,
        Order::class => OrderPolicy::class,
    ];

    public function boot(): void
    {

        $this->registerPolicies();

        // Реєстрація Composer для всіх шаблонів в bookings
        View::composer('bookings.index', 'App\View\Composers\BookingsComposer');
    }
}
