<?php

namespace App\Http\Controllers;

use App\Http\Requests\VenueRequest;
use App\Models\Venue;
use Illuminate\Http\Request;

class VenueController extends Controller
{
    public function index()
    {
        $venues = Venue::all();
        return view('venues.index', compact('venues'));
    }

    public function create()
    {
        return view('venues.create');
    }

    public function store(VenueRequest $request)
    {
        $attributes = $request->validated();

        Venue::create($attributes);

        return redirect()->route('venues.index')->with('message', 'Venue created successfully.');
    }

    public function show(Venue $venue)
    {
        return view('venues.show', compact('venue'));
    }

    public function edit(Venue $venue)
    {
        return view('venues.edit', compact('venue'));
    }

    public function update(VenueRequest $request, Venue $venue)
    {
        $attributes = $request->validated();

        $venue->update($attributes);

        return redirect()->route('venues.index')->with('message', 'Venue updated successfully.');
    }

    public function destroy(Venue $venue)
    {
        $venue->delete();

        return redirect()->route('venues.index')->with('message', 'Venue deleted successfully.');
    }
}
