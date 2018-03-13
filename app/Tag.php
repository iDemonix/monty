<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function tickets()
    {
        return $this->belongsToMany('App\Ticket');
    }
}
