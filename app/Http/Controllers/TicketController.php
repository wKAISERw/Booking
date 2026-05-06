<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class TicketController extends Controller
{
    public function index(Request $request)
    {
        // 1. ЯКЩО ЦЕ АДМІН: Показуємо красиву таблицю для керування
        if (auth()->check() && auth()->user()->hasRole('admin')) {
            $tickets = Ticket::with('event')->latest()->paginate(15);
            return view('tickets.admin_index', compact('tickets'));
        }

        // 2. ЯКЩО ЦЕ ЮЗЕР: Показуємо вітрину магазину
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

        // Отримуємо події і відразу рахуємо залишок місць для зручності у формі!
        $events = Event::with('venue')->get()->map(function ($event) {
            $unsold = Ticket::where('event_id', $event->id)->sum('quantity');
            $sold = DB::table('order_ticket')
                ->join('orders', 'order_ticket.order_id', '=', 'orders.id')
                ->join('tickets', 'order_ticket.ticket_id', '=', 'tickets.id')
                ->where('tickets.event_id', $event->id)
                ->where('orders.status', 'successful')
                ->sum('order_ticket.quantity');

            $event->remaining_capacity = max(0, $event->venue->capacity - ($unsold + $sold));
            return $event;
        });

        return view('tickets.create', compact('events'));
    }
    private function validateVenueCapacity($eventId, $requestedQuantity, $excludeTicketId = null)
    {
        $event = Event::with('venue')->findOrFail($eventId);
        $venueCapacity = $event->venue->capacity;

        // Рахуємо НЕпродані квитки (якщо це update - віднімаємо поточну категорію)
        $unsoldOther = Ticket::where('event_id', $eventId)
            ->when($excludeTicketId, function ($query, $id) {
                return $query->where('id', '!=', $id);
            })
            ->sum('quantity');

        // Рахуємо всі ПРОДАНІ квитки на цю подію
        $soldTotal = DB::table('order_ticket')
            ->join('orders', 'order_ticket.order_id', '=', 'orders.id')
            ->join('tickets', 'order_ticket.ticket_id', '=', 'tickets.id')
            ->where('tickets.event_id', $eventId)
            ->where('orders.status', 'successful')
            ->sum('order_ticket.quantity');

        $existing = $unsoldOther + $soldTotal;

        // Повертаємо доступний залишок, якщо ліміт перевищено
        if (($existing + $requestedQuantity) > $venueCapacity) {
            return max(0, $venueCapacity - $existing);
        }
        return true;
    }
    public function store(Request $request)
    {
        $this->authorize('create', Ticket::class);
        $validated = $request->validate([
            'event_id'  => 'required|exists:events,id',
            'type'      => 'required|max:255',
            'price'     => 'required|numeric|min:0',
            'quantity'  => 'required|integer|min:1',
            'seat_info' => 'nullable|string|max:255', // <--- Додай цей рядок
        ]);

        $capacityCheck = $this->validateVenueCapacity($request->event_id, $request->quantity);

        if ($capacityCheck !== true) {
            return back()
                ->withErrors(['quantity' => "Ліміт закладу! Ви можете додати максимум ще {$capacityCheck} квитків."])
                ->withInput();
        }

        Ticket::create($validated);
        return redirect()->route('tickets.index')->with('success', 'Ticket category created successfully.');
    }

    public function show(Ticket $ticket)
    {
        $this->authorize('view', $ticket);
        return view('tickets.show', compact('ticket'));
    }

    public function edit(Ticket $ticket)
    {
        $this->authorize('update', $ticket);

        $events = Event::with('venue')->get()->map(function ($event) use ($ticket) {
            // Рахуємо НЕпродані квитки (АЛЕ віднімаємо ту категорію, яку зараз редагуємо!)
            $unsoldOther = Ticket::where('event_id', $event->id)
                ->where('id', '!=', $ticket->id)
                ->sum('quantity');

            $sold = DB::table('order_ticket')
                ->join('orders', 'order_ticket.order_id', '=', 'orders.id')
                ->join('tickets', 'order_ticket.ticket_id', '=', 'tickets.id')
                ->where('tickets.event_id', $event->id)
                ->where('orders.status', 'successful')
                ->sum('order_ticket.quantity');

            $event->remaining_capacity = max(0, $event->venue->capacity - ($unsoldOther + $sold));
            return $event;
        });

        return view('tickets.edit', compact('ticket', 'events'));
    }

    public function update(Request $request, Ticket $ticket)
    {
        $this->authorize('update', $ticket);
        $validated = $request->validate([
            'event_id'  => 'required|exists:events,id',
            'type'      => 'required|max:255',
            'price'     => 'required|numeric|min:0',
            'quantity'  => 'required|integer|min:1',
            'seat_info' => 'nullable|string|max:255', // <--- Додай цей рядок
        ]);

        $capacityCheck = $this->validateVenueCapacity($request->event_id, $request->quantity, $ticket->id);

        if ($capacityCheck !== true) {
            return back()
                ->withErrors(['quantity' => "Ліміт закладу! Ви можете встановити максимум {$capacityCheck} квитків."])
                ->withInput();
        }

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
