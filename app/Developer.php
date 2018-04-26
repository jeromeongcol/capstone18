<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Developer extends Model
{
    public $table = "developers";

    protected $fillable = [
        'name', 'contact','fax','address','profile', 'photo',
    ];

    public function projects(){
        return $this->hasMany(Projects::class);
    }
}
