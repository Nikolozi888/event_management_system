<?php

namespace App\Http\Controllers;

use App\Mail\TicketDeleteMail;
use App\Models\SoldTicket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SoldTicketController extends Controller
{
    public function destroy($id)
    {
        $user = User::find(auth()->id());

        $ticket = SoldTicket::find($id);

        if (!$ticket || $ticket->user_id !== $user->id) {
            return redirect()->back()->with('error', 'Ticket not found or unauthorized.');
        }

        $user->balance += $ticket->price;
        $user->save();

        if ($ticket->delete()) {
            Mail::to($user->email)->send(new TicketDeleteMail([
                'name' => $user->name,
                'email' => $user->email,
                'event' => $ticket->event->name,
                'price' => $ticket->price,
            ]));

            return redirect()->back()->with('message', 'Your ticket has been deleted successfully. Please check your email.');
        }

        return redirect()->back()->with('message', 'Ticket not Delete');
    }
}
