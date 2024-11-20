<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Event;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index(Request $request)
{
    $this->authorize('viewAny', Ticket::class);

    // Отримуємо фільтри
    $eventIds = $request->input('event_id', []);
    $minPrice = $request->input('min_price');
    $maxPrice = $request->input('max_price');
    $sort = $request->input('sort');

    // Формуємо запит
    $query = Ticket::with('event');

    if ($eventIds) {
        $query->whereIn('event_id', $eventIds);
    }

    if ($minPrice) {
        $query->where('price', '>=', $minPrice);
    }

    if ($maxPrice) {
        $query->where('price', '<=', $maxPrice);
    }

    // Сортування
    if ($sort == 'price_asc') {
        $query->orderBy('price', 'asc');
    } elseif ($sort == 'price_desc') {
        $query->orderBy('price', 'desc');
    }

    // Пагінація
    $tickets = $query->paginate(10);

    // Події з підрахунком квитків
    $events = Event::withCount('tickets')->get();

    return view('tickets.index', compact('tickets', 'events'));
}



    public function create()
    {
        $this->authorize('create', Ticket::class);
        $events = Event::all();
        return view('tickets.create', compact('events'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', Ticket::class);
        $validated = $request->validate([
            'event_id' => 'required|exists:events,id',
            'type' => 'required|max:255',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:1',
        ]);

        Ticket::create($validated);

        return redirect()->route('tickets.index')->with('success', 'Ticket created successfully.');
    }

    public function show(Ticket $ticket)
    {
        $this->authorize('view', $ticket);
        return view('tickets.show', compact('ticket'));
    }

    public function edit(Ticket $ticket)
    {
        $this->authorize('update', $ticket);
        $events = Event::all();
        return view('tickets.edit', compact('ticket', 'events'));
    }

    public function update(Request $request, Ticket $ticket)
    {
        $this->authorize('update', $ticket);
        $validated = $request->validate([
            'event_id' => 'required|exists:events,id',
            'type' => 'required|max:255',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:1',
        ]);

        $ticket->update($validated);

        return redirect()->route('tickets.index')->with('success', 'Ticket updated successfully.');
    }

    public function destroy(Ticket $ticket)
    {
        $this->authorize('delete', $ticket);
        $ticket->delete();

        return redirect()->route('tickets.index')->with('success', 'Ticket deleted successfully.');
    }
}
