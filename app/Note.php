<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    public function ticket()
    {
        return $this->belongsTo('App\Ticket');
    }

    public function attachments()
    {
        return $this->hasMany('App\Attachment');
    }
}
