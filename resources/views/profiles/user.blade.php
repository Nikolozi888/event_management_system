@extends('components.layout')
@section('content')
    <div class="container my-5">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                        <img src="{{ asset('storage/' . $user->thumbnail) }}" alt="User Avatar"
                            class="mb-3 user-avatar img-fluid" style="width: 80%; object-fit: cover;">
                        <h4 id="user-name">{{ $user->name }}</h4>
                        <p id="user-email" class="text-muted">{{ $user->email }}</p>
                        <br>
                        <form action="{{ route('forgot.password', $user->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary">Click if Forgot Password?</button>
                        </form>
                        <br>
                        <a href="{{ route('password.edit') }}" class="btn btn-info">
                            Password Update
                        </a>
                        <br><br>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger">Logout</button>
                        </form>

                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5>Balance: ${{ $user->balance }}</h5>
                    </div>
                    <div class="card-body">
                        <p>Your current balance is:</p>
                        <h3 class="text-success" id="user-balance">${{ $user->balance }}</h3>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5>Your Tickets</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Event Name</th>
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                    <th>Quantity</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="ticket-list">
                                @foreach ($user->soldTickets as $i => $soldTicket)
                                    <tr>
                                        <td>{{ $i + 1 }}</td>
                                        <td>{{ $soldTicket->event->name }}</td>
                                        <td>{{ $soldTicket->event->start_time }}</td>
                                        <td>{{ $soldTicket->event->end_time }}</td>
                                        <td>{{ $soldTicket->quantity }}</td>
                                        <td>
                                            <form action="{{ route('soldTicket.destroy', $soldTicket->id) }}"
                                                method="POST">
                                                @csrf
                                                <button class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
