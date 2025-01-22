@extends('components.layout')

@section('content')
    @can('admin')
        <div class="container mt-4">
            <x-admin-header />
        </div>
        <div class="container">
            <h1>Events</h1>
            <a href="{{ route('events.create') }}" class="btn btn-primary">Create Event</a>
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($events as $event)
                        <tr>
                            <td>{{ $event->name }}</td>
                            <td>{{ $event->description }}</td>
                            <td>{{ $event->start_time }}</td>
                            <td>{{ $event->end_time }}</td>
                            <td>
                                <a href="{{ route('events.show', $event->id) }}" class="btn btn-info">View</a>
                                <a href="{{ route('events.edit', $event->id) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('events.destroy', $event->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endcan


    @guest
        <br>
        <form class="d-flex mx-auto w-50" action="{{ route('index') }}" method="GET" onsubmit="return false;">
            <input class="form-control me-2" type="text" placeholder="Search events" name="search"
                value="{{ old('search', $search) }}" aria-label="Search" readonly>
            <button class="btn btn-light" type="button" disabled>Search</button>
        </form>
        <div class="container my-5">
            <div class="row">
                @forelse ($events as $event)
                    <div class="col-md-4 mb-4">
                        <x-event_card :event="$event" :interactive="false" />
                    </div>
                @empty
                    <div class="col-12">
                        <p>No upcoming events are available at the moment. Please check back later.</p>
                    </div>
                @endforelse
            </div>
        </div>
    @endguest

    @can('user')
        <br>
        <form class="d-flex mx-auto w-50" action="{{ route('index') }}" method="GET">
            <input class="form-control me-2" type="text" placeholder="Search events" name="search"
                value="{{ old('search', $search) }}" aria-label="Search">
            <button class="btn btn-light" type="submit">Search</button>
        </form>
        <div class="d-flex">
            <x-sidebar :categories="$categories" />
        <div class="container my-5">
            <div class="row">
                @forelse ($events as $event)
                    <div class="col-md-4 mb-4">
                        <x-event_card :event="$event" :interactive="true" />
                    </div>
                @empty
                    <div class="col-12">
                        <p>No upcoming events are available at the moment. Please check back later.</p>
                    </div>
                @endforelse
            </div>
        </div>
        </div>
    @endcan



@endsection
