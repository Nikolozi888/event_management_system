@extends('components.layout')
@section('title', 'Register')
@section('content')

    <div class="container mt-5">
        <h1 class="text-center mb-4">რეგისტრაცია</h1>
        <form action="{{ route('register.handler') }}" method="POST" enctype="multipart/form-data" class="bg-light p-5 rounded shadow">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">სახელი</label>
                <input type="text" name="name" id="name" class="form-control">
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">სრული სახელი</label>
                <input type="text" name="username" id="username" class="form-control">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">ელფოსტა</label>
                <input type="email" name="email" id="email" class="form-control">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">პაროლი</label>
                <input type="password" name="password" id="password" class="form-control">
            </div>
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">დაადასტურეთ პაროლი</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
            </div>
            <div class="mb-3">
                <label for="thumbnail" class="form-label">სურათი</label>
                <input type="file" name="thumbnail" id="thumbnail" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary w-100">რეგისტრაცია</button>
            <div class="text-center mt-3">
                <a href="{{ route('login') }}" class="text-primary">ავტორიზაცია</a>
            </div>
        </form>
    </div>

@endsection
