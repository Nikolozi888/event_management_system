@extends('components.layout')

@section('content')
<div class="container">
    <h1>Edit Ticket</h1>
    <form action="{{ route('tickets.update', $ticket->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="type">Type</label>
            <input type="text" name="type" id="type" class="form-control" value="{{ $ticket->type }}" required>
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" step="0.01" name="price" id="price" class="form-control" value="{{ $ticket->price }}" required>
        </div>
        <div class="form-group">
            <label for="quantity">Quanitity</label>
            <input type="number" step="0.01" name="quantity" id="quantity" class="form-control" value="{{ $ticket->quantity }}" required>
        </div>
        <div class="form-group">
            <label for="event_id">Event</label>
            <select name="event_id" id="event_id" class="form-control" required>
                @foreach(App\Models\Event::all() as $event)
                <option value="{{ $event->id }}" {{ $ticket->event_id == $event->id ? 'selected' : '' }}>{{ $event->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
