<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $guarded = [];

    /* Enum statuses for Task */
    protected static $statuses = [
        'Assigned',
        'Done',
        'Recycled'
    ];

    public static function getStatusList()
    {
        return static::$statuses;
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
