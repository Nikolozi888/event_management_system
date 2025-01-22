@props(['event'])
<div class="card shadow-lg">
    <div class="row g-0">
        <div class="col-md-6">
            <img src="{{ asset('storage/' . $event->thumbnail) }}" class="img-fluid rounded-start" alt="Event Image" style="max-width: 100%; height: auto;">
        </div>
        <div class="col-md-6">
            <div class="card-body">
                <h5 class="card-title">{{ $event->name }}</h5>
                <p class="card-text">{{ $event->description }}</p>
                <ul class="list-unstyled">
                    <li><strong>Start:</strong> {{ $event->start_time }}</li>
                    <li><strong>End:</strong> {{ $event->end_time }}</li>
                    <li><strong>Location:</strong> {{ $event->venue->address }}</li>
                    <li><strong>In stock:</strong> {{ $event->tickets->sum('quantity') }}</li>
                </ul>
                <a href="{{ route('ticket.create', $event->id) }}" class="btn btn-primary">Buy Ticket</a>
            </div>
        </div>
    </div>
</div>
