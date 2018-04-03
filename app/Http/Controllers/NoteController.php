<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Note;
use App\Attachment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

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

        // attachments - TODO: validation
        if ($request->input('attachments_array')) 
        {
            $ids = explode(',', $request->input('attachments_array'));

            for ($i=0; $i<count($ids)-1; $i++)
            {
                $attachment = Attachment::find($ids[$i]);
                $attachment->note()->associate($note);
                $attachment->save();
            }
        }

        return redirect('/ticket/' . $request->input('ticket'));
    }

    public function delete(Request $request)
    {
        // TODO: validation of ownership etc
        $note = Note::find($request->input('delete-note-id'));
        $note->delete();

        return Redirect::back();
    }
}
