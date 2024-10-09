<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Ticket;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with('ticket.event')->paginate(10);
        return view('bookings.index', compact('bookings'));
    }

    public function create()
    {
        $tickets = Ticket::with('event')->get();
        return view('bookings.create', compact('tickets'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'ticket_id' => 'required|exists:tickets,id',
            'customer_name' => 'required|max:255',
            'customer_email' => 'required|email',
            'quantity' => 'required|integer|min:1',
        ]);

        $ticket = Ticket::findOrFail($validated['ticket_id']);

        if ($ticket->quantity < $validated['quantity']) {
            return back()->withErrors(['quantity' => 'Not enough tickets available.'])->withInput();
        }

        Booking::create($validated);
        $ticket->decrement('quantity', $validated['quantity']);

        return redirect()->route('bookings.index')->with('success', 'Booking created successfully.');
    }

    public function show(Booking $booking)
    {
        return view('bookings.show', compact('booking'));
    }

    public function edit(Booking $booking)
    {
        $tickets = Ticket::with('event')->get();
        return view('bookings.edit', compact('booking', 'tickets'));
    }

    public function update(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'ticket_id' => 'required|exists:tickets,id',
            'customer_name' => 'required|max:255',
            'customer_email' => 'required|email',
            'quantity' => 'required|integer|min:1',
        ]);

        $ticket = Ticket::findOrFail($validated['ticket_id']);

        $quantityDifference = $validated['quantity'] - $booking->quantity;

        if ($quantityDifference > 0 && $ticket->quantity < $quantityDifference) {
            return back()->withErrors(['quantity' => 'Not enough tickets available.'])->withInput();
        }

        $booking->update($validated);
        $ticket->increment('quantity', $booking->quantity);
        $ticket->decrement('quantity', $validated['quantity']);

        return redirect()->route('bookings.index')->with('success', 'Booking updated successfully.');
    }

    public function destroy(Booking $booking)
    {
        $ticket = $booking->ticket;
        $ticket->increment('quantity', $booking->quantity);

        $booking->delete();

        return redirect()->route('bookings.index')->with('success', 'Booking deleted successfully.');
    }
}
