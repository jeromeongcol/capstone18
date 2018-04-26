<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    public $table = "persons";

    protected $fillable = [
        'firstname', 'lastname', 'middlename',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

}
