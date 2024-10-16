<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        // Завантаження замовлень користувача з деталями квитків і подій
        $orders = Auth::user()->orders()->with('items.ticket.event')->get();
        return view('orders.index', compact('orders'));
    }


    public function store()
    {
        $cart = Auth::user()->cart;

        if ($cart && $cart->items->isNotEmpty()) {
            $order = Order::create([
                'user_id' => Auth::id(),
                'status' => 'pending',
            ]);

            foreach ($cart->items as $cartItem) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'ticket_id' => $cartItem->ticket_id,
                    'quantity' => $cartItem->quantity,
                    'price' => $cartItem->ticket->price,
                ]);

                $cartItem->ticket->decrement('quantity', $cartItem->quantity);
            }

            $cart->items()->delete();

            return redirect()->route('orders.index')->with('success', 'Order placed successfully.');
        }

        return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
    }

    public function cancel(Order $order)
    {
        $this->authorize('cancel', $order); // тут перевіряємо, чи користувач має право скасувати замовлення

        foreach ($order->items as $item) {
            $item->ticket->increment('quantity', $item->quantity);
        }

        $order->update(['status' => 'canceled']);

        return redirect()->route('orders.index')->with('success', 'Order canceled successfully.');
    }
    public function confirm(Order $order)
    {
        $this->authorize('confirm', $order); // перевірка прав доступу

        // Оновлюємо статус на "confirmed"
        $order->update(['status' => 'confirmed']);

        return redirect()->route('bookings.index')->with('success', 'Order confirmed successfully.');
    }

}
