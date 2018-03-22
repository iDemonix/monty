<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Queue;
use App\Ticket;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $queues = Queue::all();
        $counts = [];

        foreach($queues as $queue) 
        {
            $counts[$queue->id] = DB::table('tickets')
                                 ->select('priority', DB::raw('count(*) as total'))
                                 ->where('queue_id', '=', $queue->id)
                                 ->groupBy('priority')
                                 ->get();

                                /// die($counts[$queue->id]);
        }
        

        return view('home')->with(['queues' => $queues, 'counts' => $counts]);
    }
}
