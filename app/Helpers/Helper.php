<?php
 
use Illuminate\Support\Str;
 
class Helper {
 
    public static function makeSlug($str) {
 
      return Str::slug($str);
 
    }

    public static function labelForPriority($priority) {
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

    public static function labelForStatus($status) {
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
 
}