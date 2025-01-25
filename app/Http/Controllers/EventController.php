<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRequest;
use App\Models\Category;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $currentDateTime = Carbon::now();
        $search = $request->input('search');

        $eventsQuery = Event::where('start_time', '>=', $currentDateTime);

        if ($search) {
            $eventsQuery->where('name', 'like', '%' . $search . '%');
        }

        $events = $eventsQuery->orderBy('start_time', 'asc')->get();

        $categories = Category::all();

        return view('events.index', compact('events', 'search', 'categories'));
    }


    public function create()
    {
        return view('events.create');
    }

    public function store(EventRequest $request)
    {
        $attributes = $request->validated();

        if ($request->hasFile('thumbnail')) {
            $uniqueName = uniqid() . '-' . $request->file('thumbnail')->getClientOriginalName();
            $thumbnailPath = $request->file('thumbnail')->storeAs('images', $uniqueName, 'public');
            $attributes['thumbnail'] = $thumbnailPath;
        }

        Event::create($attributes);

        return redirect()->route('index')->with('message', 'Event created successfully.');
    }

    public function show(Event $event)
    {
        return view('events.show', compact('event'));
    }

    public function edit(Event $event)
    {
        return view('events.edit', compact('event'));
    }

    public function update(EventRequest $request, Event $event)
    {
        $attributes = $request->validated();

        if ($request->hasFile('thumbnail')) {
            $uniqueName = uniqid() . '-' . $request->file('thumbnail')->getClientOriginalName();
            $thumbnailPath = $request->file('thumbnail')->storeAs('images', $uniqueName, 'public');
            $attributes['thumbnail'] = $thumbnailPath;
        } else {
            $attributes['thumbnail'] = $event->thumbnail;
        }

        $event->update($attributes);

        return redirect()->route('index')->with('message', 'Event updated successfully.');
    }


    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('index')->with('message', 'Event deleted successfully.');
    }
}
