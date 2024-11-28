<?php

namespace App\Providers;

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\ServiceProvider;

class BroadcastServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Додає маршрути для /broadcasting/auth
        Broadcast::routes();

        // Підключає routes/channels.php
        require base_path('routes/channels.php');
    }
}
