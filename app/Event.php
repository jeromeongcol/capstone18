<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    public $table = "events";

    protected $fillable = [
        'title', 'description', 'start', 'end', 'added_by'
    ];

}
