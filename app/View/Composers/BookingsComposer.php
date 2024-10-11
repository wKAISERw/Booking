<?php

namespace App\View\Composers;

use Illuminate\View\View;
use App\Models\Booking;

class BookingsComposer
{
    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        $view->with('bookings', Booking::all());
    }
}
