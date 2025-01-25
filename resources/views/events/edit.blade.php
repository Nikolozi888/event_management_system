@extends('components.layout')

@section('content')
    <div class="container">
        <h1>Edit Event</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('events.update', $event->id) }}" enctype="multipart/form-data" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $event->name }}" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" required>{{ $event->description }}</textarea>
            </div>
            <div class="form-group">
                <label for="start_time">Start Time</label>
                <input type="datetime-local" name="start_time" id="start_time" class="form-control"
                    value="{{ $event->start_time }}" required>
            </div>
            <div class="form-group">
                <label for="end_time">End Time</label>
                <input type="datetime-local" name="end_time" id="end_time" class="form-control"
                    value="{{ $event->end_time }}" required>
            </div>
            <div class="form-group">
                <label for="thumbnail">Thumbnail</label>
                <input type="file" name="thumbnail" id="thumbnail" class="form-control">

                @if ($event->thumbnail)
                    <img src="{{ asset('storage/' . $event->thumbnail) }}" alt="Event Thumbnail" style="width: 25%;">
                @endif
            </div>

            <div class="form-group">
                <label for="venue_id">Venue</label>
                <select name="venue_id" id="venue_id" class="form-control" required>
                    @foreach (App\Models\Venue::all() as $venue)
                        <option value="{{ $venue->id }}" {{ $event->venue_id == $venue->id ? 'selected' : '' }}>
                            {{ $venue->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="category_id">Category</label>
                <select name="category_id" id="category_id" class="form-control" required>
                    @foreach (App\Models\Category::all() as $category)
                        <option value="{{ $category->id }}" {{ $event->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
