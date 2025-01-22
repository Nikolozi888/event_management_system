@extends('components.layout')

@section('content')
    @if (!App\Models\SoldTicket::where('event_id', $event->id)->where('user_id', auth()->user()->id)->exists() && $event->tickets->sum('quantity') > 0)
        <div class="container mt-5">
            <h2 class="mb-4">Checkout</h2>
            <div class="row">
                <div class="col-md-8">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h4>Payment</h4>
                            <div class="mb-3">
                                <input type="text" class="form-control" value="{{ auth()->user()->name }}" disabled>
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control" value="{{ auth()->user()->email }}" disabled>
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control" value="{{ $event->name }}" disabled>
                            </div>
                            <div class="mb-3">
                                <input type="number" class="form-control"
                                    value="{{ $event->tickets->first()?->price ?? 'No tickets available' }}" disabled>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h4>Order Summary</h4>
                            <ul class="list-unstyled">
                                <li>
                                    <div class="d-flex justify-content-between">
                                        <span>{{ $event->name }}</span>
                                        <span>${{ $event->tickets->first()?->price ?? 'No tickets available' }}</span>
                                    </div>
                                </li>
                            </ul>
                            <form action="{{ route('ticket.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                <input type="hidden" name="event_id" value="{{ $event->id }}">
                                <input type="hidden" name="ticket" value="{{ $event->tickets->first()?->id }}">
                                <input type="hidden" name="price" value="{{ $event->tickets->first()?->price }}">
                                <input type="hidden" name="quantity" value="1"> <!-- Set the quantity -->
                                <button type="submit" class="btn btn-primary w-100">Complete Purchase</button>
                            </form>

                            @if ($errors->any())
                                <div class="alert alert-danger mt-3">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <h1>You have already purchased this ticket</h1>
    @endif
@endsection
