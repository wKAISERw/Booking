<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venue;



class VenueController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Venue::class);
        $venues = Venue::all();
        return view('venues.index', compact('venues'));
    }

    public function create()
    {
        $this->authorize('create', Venue::class);
        return view('venues.create');
    }

    public function store(Request $request)
    {
        $this->authorize('create', Venue::class);
        $validated = $request->validate([
            'name' => 'required|max:255',
            'address' => 'required',
            'capacity' => 'required|integer|min:1',
        ]);

        Venue::create($validated);

        return redirect()->route('venues.index')->with('success', 'Venue created successfully.');
    }

    public function show(Venue $venue)
    {
        $this->authorize('view', $venue);
        return view('venues.show', compact('venue'));
    }

    public function edit(Venue $venue)
    {
        $this->authorize('update', $venue);
        return view('venues.edit', compact('venue'));
    }

    public function update(Request $request, Venue $venue)
    {
        $this->authorize('update', $venue);
        $validated = $request->validate([
            'name' => 'required|max:255',
            'address' => 'required',
            'capacity' => 'required|integer|min:1',
        ]);

        $venue->update($validated);

        return redirect()->route('venues.index')->with('success', 'Venue updated successfully.');
    }

    public function destroy(Venue $venue)
    {
        $this->authorize('delete', $venue);

        return redirect()->route('venues.index')->with('success', 'Venue deleted successfully.');
    }
}
