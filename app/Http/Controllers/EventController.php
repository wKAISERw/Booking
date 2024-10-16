<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Venue;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Event::class);
        $events = Event::with('venue')->paginate(10);
        return view('events.index', compact('events'));
    }

    public function create()
    {
        $this->authorize('create', Event::class);
        $venues = Venue::all();
        return view('events.create', compact('venues'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', Event::class);
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'date' => 'required|date',
            'venue_id' => 'required|exists:venues,id',
        ]);

        Event::create($validated);

        return redirect()->route('events.index')->with('success', 'Event created successfully.');
    }

    public function show(Event $event)
    {
        $this->authorize('view', $event);
        return view('events.show', compact('event'));
    }

    public function edit(Event $event)
    {
        $this->authorize('update', $event);
        $venues = Venue::all();
        return view('events.edit', compact('event', 'venues'));
    }

    public function update(Request $request, Event $event)
    {
        $this->authorize('update', $event);
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'date' => 'required|date',
            'venue_id' => 'required|exists:venues,id',
        ]);

        $event->update($validated);

        return redirect()->route('events.index')->with('success', 'Event updated successfully.');
    }

    public function destroy(Event $event)
    {
        $this->authorize('delete', $event);
        $event->delete();

        return redirect()->route('events.index')->with('success', 'Event deleted successfully.');
    }
}
