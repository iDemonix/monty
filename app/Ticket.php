<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{

    public function note()
    {
        return $this->hasMany('App\Note');
    }

    public function queue()
    {
        return $this->belongsTo('App\Queue');
    }

    public function tags()
    {
        return $this->hasMany('App\Tag');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
