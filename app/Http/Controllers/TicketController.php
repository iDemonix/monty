<?php

namespace App\Http\Controllers;

use App\Ticket;
use App\Action;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Show a ticket.
     */
    public function show(Ticket $ticket)
    {
        $actions = $ticket->actions()->orderBy('created_at')->get();
        $notes = $ticket->notes()->orderBy('created_at')->get();

        $events = array();

        foreach($actions as $action) {
            $events[] = $action;
        }

        foreach($notes as $note) {
            $events[] = $note;
        }

        usort($events, function ($a, $b)
        {
            if ($a->created_at == $b->created_at) {
                return 0;
            }
            return ($a->created_at > $b->created_at) ? -1 : 1;
        });

        return view('tickets.show')->with(['ticket' => $ticket, 'events' => $events]);
    }

    /**
     * Update a ticket's priority level (triggered by user in UI)
     */
    public function updatePriority(Ticket $ticket, Request $request)
    {
        // TODO: validation
        $new_priority = $request->input('priority');
        $old_priority = $ticket->priority;

        $ticket->priority = $new_priority;
        $ticket->save();

        // log action
        $action = new Action;
        $action->field = 'priority';
        $action->old = $old_priority;
        $action->new = $new_priority;
        $action->ticket_id = $ticket->id;
        $action->save();

        return redirect('ticket/' . $ticket->id);
    }
}
