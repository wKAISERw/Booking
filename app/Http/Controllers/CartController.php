<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Ticket;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = auth()->user()->cart()->with('tickets.event')->firstOrCreate();
        return view('cart.index', compact('cart'));
    }

    public function addItem(Request $request, Ticket $ticket)
    {
        $cart = auth()->user()->cart()->firstOrCreate();

        $cart->tickets()->syncWithoutDetaching([
            $ticket->id => ['quantity' => $request->input('quantity', 1)]
        ]);

        return redirect()->route('tickets.index')->with('success', 'Ticket added to cart!');
    }

    public function showAddForm(Ticket $ticket)
    {
        return view('cart.add', compact('ticket'));
    }

    public function removeItem($ticketId)
    {
        $cart = auth()->user()->cart()->first();
        $cart->tickets()->detach($ticketId);

        return back()->with('success', 'Ticket removed from cart.');
    }
}
