@extends('components.layout')
@section('content')
    <div class="container mt-5">
        <h2>User List</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Balance</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="userTableBody">
                @foreach ($users as $i => $user)
                    <tr>
                        <td>{{ $i+1 }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>${{ $user->balance }}</td>
                        <td>
                            <a href="{{ route('admin.profiles.edit',$user->id) }}" class="btn btn-primary btn-sm">
                                Edit
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
