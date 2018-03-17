<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Note;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    public function create(Request $request) 
    {
        // TODO: validation
        $note = new Note;

        $note->body = $request->input('body');
        $note->ticket_id = $request->input('ticket');
        $note->user_id = Auth::user()->id;

        $note->save();

        return redirect('/ticket/' . $request->input('ticket'));

    }
}
