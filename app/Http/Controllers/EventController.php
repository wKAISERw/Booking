<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Venue;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::with('venue')->paginate(9);
        return view('events.index', compact('events'));
    }

    public function create()
    {
        $venues = Venue::all();
        return view('events.create', compact('venues'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|max:255',
            'description' => 'required',
            'date'        => 'required|date',
            'venue_id'    => 'required|exists:venues,id',
            'image'       => 'nullable|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('images', 'public');
        }

        Event::create($validated);

        return redirect()->route('events.index')->with('success', 'Event created successfully.');
    }

    public function edit(Event $event)
    {
        $venues = Venue::all();
        return view('events.edit', compact('event', 'venues'));
    }

    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'name'        => 'required|max:255',
            'description' => 'required',
            'date'        => 'required|date',
            'venue_id'    => 'required|exists:venues,id',
            'image'       => 'nullable|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

        if ($request->hasFile('image')) {
            // Видаляємо старе зображення
            if ($event->image) {
                \Storage::disk('public')->delete($event->image);
            }
            $validated['image'] = $request->file('image')->store('images', 'public');
        } else {
            // Не чіпаємо поточне зображення
            unset($validated['image']);
        }

        $event->update($validated);

        return redirect()->route('events.index')->with('success', 'Event updated successfully.');
    }

    public function show(Event $event)
    {
        return view('events.show', compact('event'));
    }

    public function destroy(Event $event)
    {
        $this->authorize('delete', $event);

        if ($event->image) {
            \Storage::disk('public')->delete($event->image);
        }

        $event->delete();

        return redirect()->route('events.index')->with('success', 'Event deleted successfully.');
    }
}
