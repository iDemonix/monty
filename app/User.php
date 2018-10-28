<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'display_name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function tickets()
    {
        return $this->hasMany('App\Ticket');
    }

    public function actions()
    {
        return $this->hasMany('App\Action');
    }

    public function name()
    {
        return ($this->display_name ? $this->display_name : $this->name);
    }

    public function gravatar()
    {
        return 'https://www.gravatar.com/avatar/' . md5(strtolower($this->email)) . '?s=38';
    }
}
