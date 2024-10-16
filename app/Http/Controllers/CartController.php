<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cart = Auth::user()->cart->load('items.ticket.event');
        return view('cart.index', compact('cart'));
    }

    public function addItem(Request $request, Ticket $ticket)
    {
        $validated = $request->validate(['quantity' => 'required|integer|min:1']);
        $cart = Auth::user()->cart ?? Auth::user()->cart()->create();

        $cartItem = $cart->items()->where('ticket_id', $ticket->id)->first();
        if ($cartItem) {
            $cartItem->update(['quantity' => $cartItem->quantity + $validated['quantity']]);
        } else {
            $cart->items()->create([
                'ticket_id' => $ticket->id,
                'quantity' => $validated['quantity'],
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Item added to cart.');
    }



    public function removeItem(CartItem $cartItem)
    {
        $cartItem->delete();
        return redirect()->route('cart.index')->with('success', 'Item removed from cart.');
    }

    public function updateItem(Request $request, CartItem $cartItem)
    {
        $validated = $request->validate(['quantity' => 'required|integer|min:1']);
        $cartItem->update($validated);
        return redirect()->route('cart.index')->with('success', 'Cart updated.');
    }
}
