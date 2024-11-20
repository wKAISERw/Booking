<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Ticket;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function confirm()
    {
        $cart = auth()->user()->cart;

        if (!$cart || $cart->tickets->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'No items in cart!');
        }

        return view('orders.confirm', compact('cart'));
    }

    public function store(Request $request)
    {
        $cart = auth()->user()->cart;

        if (!$cart || $cart->tickets->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'No items in cart!');
        }

        $order = Order::create([
            'user_id' => auth()->id(),
            'status' => 'successful',
            'total_price' => $cart->tickets->sum(fn($ticket) => $ticket->pivot->quantity * $ticket->price),
        ]);

        foreach ($cart->tickets as $ticket) {
            $quantity = $ticket->pivot->quantity;

            $order->tickets()->attach($ticket->id, ['quantity' => $quantity]);

            // Зменшуємо кількість квитків
            $ticket->decrement('quantity', $quantity);

            if ($ticket->quantity === 0) {
                $ticket->delete(); // Видаляємо, якщо квитки закінчились
            }
        }

        // Очищаємо корзину
        $cart->tickets()->detach();

        return redirect()->route('orders.history')->with('success', 'Order placed successfully!');
    }

    public function cancel(Order $order)
    {
        if ($order->status !== 'successful') {
            return redirect()->route('orders.history')->with('error', 'Order cannot be refunded!');
        }

        foreach ($order->tickets as $ticket) {
            $ticket->increment('quantity', $ticket->pivot->quantity);
        }

        $order->update(['status' => 'refunded']);

        return redirect()->route('orders.history')->with('success', 'Order refunded successfully!');
    }

    public function history()
    {
        $orders = auth()->user()->orders()->with('tickets')->get();

        return view('orders.history', compact('orders'));
    }
}
