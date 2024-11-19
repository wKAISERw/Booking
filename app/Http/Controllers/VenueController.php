<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venue;



class VenueController extends Controller
{
    public function index()
    {
        $venues = Venue::paginate(9);
        return view('venues.index', compact('venues'));
    }

    public function create()
    {
        return view('venues.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'address' => 'required',
            'capacity' => 'required|integer|min:1',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('images', 'public');
        }

        Venue::create($validated);

        return redirect()->route('venues.index')->with('success', 'Venue created successfully.');
    }

    public function edit(Venue $venue)
    {
        return view('venues.edit', compact('venue'));
    }

    public function update(Request $request, Venue $venue)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'address' => 'required',
            'capacity' => 'required|integer|min:1',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('images', 'public');
        }

        $venue->update($validated);

        return redirect()->route('venues.index')->with('success', 'Venue updated successfully.');
    }

    public function show(Venue $venue)
    {
        return view('venues.show', compact('venue'));
    }

    public function destroy(Venue $venue)
    {
        $this->authorize('delete', $venue);

        // Видалення запису з бази даних
        if ($venue->image) {
            // Видалення файлу зображення з `storage`
            \Storage::disk('public')->delete($venue->image);
        }

        $venue->delete();

        return redirect()->route('venues.index')->with('success', 'Venue deleted successfully.');
    }
}
