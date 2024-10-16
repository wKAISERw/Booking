<?php
#created composer view
namespace App\View\Composers;

use Illuminate\View\View;
use App\Models\Booking;

use App\Models\Order;
class BookingsComposer
{
    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        $view->with('orders', Order::with('items.ticket.event')->where('user_id', auth()->id())->get());
    }
}
