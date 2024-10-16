<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Booking::class);
        $bookings = Booking::where('user_id', Auth::id())->with('ticket.event')->paginate(10);
        return view('bookings.index', compact('bookings'));
    }

    public function create()
    {
        $this->authorize('create', Booking::class);
        $tickets = Ticket::with('event')->get();
        return view('bookings.create', compact('tickets'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', Booking::class);
        $validated = $request->validate([
            'ticket_id' => 'required|exists:tickets,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $ticket = Ticket::findOrFail($validated['ticket_id']);

        if ($ticket->quantity < $validated['quantity']) {
            return back()->withErrors(['quantity' => 'Not enough tickets available.'])->withInput();
        }

        Booking::create([
            'ticket_id' => $validated['ticket_id'],
            'user_id' => Auth::id(),
            'quantity' => $validated['quantity'],
        ]);

        $ticket->decrement('quantity', $validated['quantity']);

        return redirect()->route('bookings.index')->with('success', 'Booking created successfully.');
    }

    public function destroy(Booking $booking)
    {
        $this->authorize('delete', $booking);
        $booking->ticket->increment('quantity', $booking->quantity);
        $booking->delete();

        return redirect()->route('bookings.index')->with('success', 'Booking canceled successfully.');
    }
}
