<?php

namespace App\Http\Controllers;

use App\Ticket;
use App\Action;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use GrahamCampbell\Markdown\Facades\Markdown;

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

        // sort so newest are first
        usort($events, function ($a, $b)
        {
            if ($a->created_at == $b->created_at) {
                return 0;
            }
            return ($a->created_at > $b->created_at) ? -1 : 1;
        });

        if ( Auth::user()->sort_reverse )
        {
            $events = array_reverse($events, true);
        }

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
        $action->activity = 'update';
        $action->field = 'priority';
        $action->old = $old_priority;
        $action->new = $new_priority;
        $action->ticket_id = $ticket->id;
        $action->user_id = Auth::user()->id;

        $action->save();

        return redirect('tickets/' . $ticket->id);
    }

   /**
     * Rename a ticket
     */
    public function rename(Ticket $ticket, Request $request)
    {
        // TODO: validation
        $new_subject = $request->input('subject');
        $old_subject = $ticket->subject;

        $ticket->subject = $new_subject;
        $ticket->save();

        // log action
        $action = new Action;
        $action->activity = 'rename';
        $action->field = 'subject';
        $action->old = $old_subject;
        $action->new = $new_subject;
        $action->ticket_id = $ticket->id;
        $action->user_id = Auth::user()->id;

        $action->save();

        return redirect('tickets/' . $ticket->id);
    }

    /**
     * Store a ticket (triggered from web UI)
     */
    public function store(Request $request) 
    {
        $ticket = new Ticket;

        // TODO: validation
        $ticket->subject = $request->input('subject');
        $ticket->status = 1; // open
        $ticket->priority = $request->input('priority');
        $ticket->queue_id = $request->input('queue');
        $ticket->user_id = $request->input('owner');

        $ticket->save();

        // log action
        

        return redirect('tickets/' . $ticket->id);

    }

    /**
     * Close a ticket (triggered from web UI)
     */
    public function close(Ticket $ticket, Request $request) 
    {
    

        // log action
        $action = new Action;
        $action->activity = 'close';
        $action->old = $ticket->status;
        $action->field = 'status';
        $action->new = 0;

        $action->ticket_id = $ticket->id;
        $action->user_id = Auth::user()->id;

        // TODO: validation
        $ticket->status = 0;
        $ticket->save();

        $action->save();

        return redirect('tickets/' . $ticket->id);

    }

    public function reopen(Ticket $ticket, Request $request) 
    {

        // log action
        $action = new Action;
        $action->activity = 'reopen';
        $action->old = $ticket->status;
        $action->field = 'status';
        $action->new = 1;

        $action->ticket_id = $ticket->id;
        $action->user_id = Auth::user()->id;

        // TODO: validation
        $ticket->status = 1;
        $ticket->save();

        $action->save();

        return redirect('tickets/' . $ticket->id);

    }


}
