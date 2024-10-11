<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\View\Composers\BookingsComposer;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Реєстрація Composer для всіх шаблонів в bookings
        View::composer('bookings.*', BookingsComposer::class);
    }
}
