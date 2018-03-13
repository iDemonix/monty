<?php

namespace App;

use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    // logging
    use LogsActivity;
    protected static $logOnlyDirty = true;
    protected static $logAttributes = ['subject', 'status', 'priority', 'due_at', 'closed_at', 'queue_id'];

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
}
