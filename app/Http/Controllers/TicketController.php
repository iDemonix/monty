<?php

namespace App\Http\Controllers;

use App\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Show a ticket.
     */
    public function show(Ticket $ticket)
    {
        return view('tickets.show')->with('ticket', $ticket);
    }

    /**
     * Show a ticket.
     */
    public function updatePriority(Ticket $ticket, Request $request)
    {
        $ticket->priority = $request->input('priority');
        $ticket->save();
        return redirect('ticket/' . $ticket->id);
    }
}
