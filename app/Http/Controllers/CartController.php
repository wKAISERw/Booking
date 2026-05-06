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

        // Скільки таких квитків вже є в корзині?
        $existingPivot = $cart->tickets()->where('ticket_id', $ticket->id)->first();
        $existingQuantity = $existingPivot ? $existingPivot->pivot->quantity : 0;

        // Перевіряємо, чи влізе ще
        $availableToAdd = min(4 - $existingQuantity, $ticket->quantity - $existingQuantity);

        if ($availableToAdd <= 0) {
            return back()->with('error', 'You have reached the maximum allowed quantity for this ticket.');
        }

        $request->validate([
            'quantity' => ['required', 'integer', 'min:1', 'max:' . $availableToAdd]
        ]);

        $newQuantity = $existingQuantity + $request->input('quantity');

        // Оновлюємо кількість у корзині
        $cart->tickets()->syncWithoutDetaching([
            $ticket->id => ['quantity' => $newQuantity]
        ]);

        return redirect()->route('cart.index')->with('success', 'Ticket successfully added to your cart!');
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
