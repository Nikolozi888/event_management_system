@extends('components.layout')

@section('content')
    <br><br>
    <form action="{{ route('admin.profiles.update', $user->id) }}" method="POST"
        class="container bg-white p-4 rounded shadow-lg">
        @csrf

        <h2 class="h2 mb-4 text-dark">Edit User</h2>

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" class="form-control"
                required>
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                class="form-control" required>
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="balance" class="form-label">Balance</label>
            <input type="number" id="balance" name="balance" value="{{ old('balance', $user->balance) }}"
                class="form-control" required>
            @error('balance')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">
                Update
            </button>
        </div>
    </form>
    <br>
    <br>
@endsection
