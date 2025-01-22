@extends('components.layout')

@section('content')
    <div class="container mt-4">
        <x-admin-header />
    </div>
    <div class="container">
        <h1>Venues</h1>
        <a href="{{ route('venues.create') }}" class="btn btn-primary">Create Venue</a>
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($venues as $venue)
                    <tr>
                        <td>{{ $venue->name }}</td>
                        <td>{{ $venue->address }}</td>
                        <td>
                            <a href="{{ route('venues.show', $venue->id) }}" class="btn btn-info">View</a>
                            <a href="{{ route('venues.edit', $venue->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('venues.destroy', $venue->id) }}" method="POST" style="display:inline;">
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
@endsection
