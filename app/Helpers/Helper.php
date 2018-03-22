<?php
 
use Illuminate\Support\Str;
 
class Helper {
 
    public static function makeSlug($str) 
    {
 
      return Str::slug($str);
 
    }

    public static function labelForPriority($priority) 
    {
        switch($priority) {
            case 1:
            return '<span class="badge badge-danger">Critical</span>';
            break;

            case 2:
            return '<span class="badge badge-warning">High</span>';
            break;

            case 3:
            return '<span class="badge badge-info">Normal</span>';
            break;

            default:
            return '<span class="badge badge-secondary">Low</span>';
            break;
        }
    }

    public static function labelForStatus($status) 
    {
        switch($status) {
            case 0:
            return '<span class="badge badge-danger">Closed</span>';
            break;

            case 1:
            return '<span class="badge badge-success">Open</span>';
            break;

            default:
            return '<span class="badge badge-warning">Overdue</span>';
            break;
        }
    }

    public static function userUrl($user) 
    {
        if ($user == NULL) 
        {
            return 'Unknown';
        } else {
            $name = ($user->display_name == NULL) ? $user->name : $user->display_name;
            return '<a class="user" href="/user/' . $user->id . '">' . $name . '</a>';
        }
     }

    public static function labelForQueueCount($count)
    {
        $string = '';
        
        switch($count->priority)
        {
            case 1:
            $string .= '<span class="badge badge-danger">' . $count->total . '</span>';
            break;

            case 2:
            $string .= '<span class="badge badge-warning">' . $count->total . '</span>';
            break;

            case 3:
            $string .= '<span class="badge badge-info">' . $count->total . '</span>';
            break;

            default:
            $string .= '<span class="badge badge-secondary">' . $count->total . '</span>';
            break;
        }

        return $string;
    }
 
}