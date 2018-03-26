<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Attachment;

class AttachmentController extends Controller
{
    public function upload(Request $request) 
    {
        $path = Storage::putFile('attachments', $request->file('file'));

        $attachment = new Attachment;
        $attachment->name = $request->file('file')->getClientOriginalName();
        $attachment->source = $path;
        $attachment->save();

        return response()
            ->json(['status' => 'ok', 'path' => 'test']);
    }
}
