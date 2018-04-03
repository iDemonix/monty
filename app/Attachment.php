<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    public function note()
    {
        return $this->belongsTo('App\Note');
    }
}
