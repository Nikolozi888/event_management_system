<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketRequest;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::all();
        return view('tickets.index', compact('tickets'));
    }

    public function create()
    {
        return view('tickets.create');
    }

    public function store(TicketRequest $request)
    {
        $attributes = $request->validated();

        Ticket::create($attributes);

        return redirect()->route('tickets.index')->with('message', 'Ticket created successfully.');
    }

    public function show(Ticket $ticket)
    {
        return view('tickets.show', compact('ticket'));
    }

    public function edit(Ticket $ticket)
    {
        return view('tickets.edit', compact('ticket'));
    }

    public function update(TicketRequest $request, Ticket $ticket)
    {
        $attributes = $request->validated();

        $ticket->update($attributes);

        return redirect()->route('tickets.index')->with('message', 'Ticket updated successfully.');
    }

    public function destroy(Ticket $ticket)
    {
        $ticket->delete();

        return redirect()->route('tickets.index')->with('message', 'Ticket deleted successfully.');
    }
}
