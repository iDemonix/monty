<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Queue;

class QueueController extends Controller
{
    /**
     * Show the create page.
     */
    public function create()
    {
        return view('queues.create');
    }

    /**
     * Store a new queue.
     */
    public function store(Request $request)
    {
        // TODO: validation
        $queue = new Queue;
        $queue->name = $request->input('name');
        $queue->save();

        return redirect('queue/' . $queue->id);
    }

    /**
     * Show a queue's dashboard.
     */
    public function show(Queue $queue)
    {
        return view('queues.dashboard')->with('queue', $queue);
    }
}
