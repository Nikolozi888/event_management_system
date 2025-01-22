@extends('components.layout')
@section('title', 'Login')
@section('content')

    <div class="container my-5">
        <h1 class="text-center mb-4">ავტორიზაცია</h1>
        <form action="{{ route('login.handler') }}" method="POST" class="bg-white p-4 shadow rounded">
            @csrf
            <div class="form-group mb-3">
                <label for="email" class="form-label">ელფოსტა</label>
                <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="password" class="form-label">პაროლი</label>
                <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-check mb-3">
                <input type="checkbox" name="remember" id="remember" class="form-check-input">
                <label for="remember" class="form-check-label">დამახსოვრება</label>
            </div>
            <button type="submit" class="btn btn-primary w-100">ავტორიზაცია</button>
            <div class="text-center mt-3">
                <a href="{{ route('register') }}" class="text-decoration-none text-primary">რეგისტრაცია</a>
            </div>
        </form>
    </div>

@endsection
