<?php

namespace App\Http\Controllers;

use App\Mail\TicketSuccessMail;
use App\Models\Event;
use App\Models\SoldTicket;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    public function ticketCreate($id)
    {

        $event = Event::find($id);

        return view('checkout.ticket_create', compact('event'));
    }

    public function ticketStore(Request $request)
    {
        $attributes = $request->validate([
            'event_id' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric|min:1',
        ]);

        $user = User::find(auth()->user()->id);
        $ticket = Ticket::find($request->ticket);

        if (!is_numeric($user->balance) || !is_numeric($attributes['price']) || $user->balance < $attributes['price'] || !is_numeric($attributes['quantity']) || $attributes['quantity'] <= 0) {
            return redirect()->back()->with('message', 'Insufficient balance or invalid quantity');
        }


        $user->balance -= $attributes['price'] * $attributes['quantity'];
        $user->save();

        $ticket->quantity -= $attributes['quantity'];
        $ticket->save();

        SoldTicket::create([
            'user_id' => $user->id,
            'event_id' => $attributes['event_id'],
            'price' => $attributes['price'],
            'quantity' => $attributes['quantity'],
        ]);


        Mail::to($user->email)->send(new TicketSuccessMail([
            'name' => $user->name,
            'email' => $user->email,
            'price' => $attributes['price'],
            'quantity' => $attributes['quantity'],
            'event' => $ticket->event->name,
        ]));

        return redirect()->route('index')->with('message', 'You Buy Ticket, Please Checked Mail');
    }
}
