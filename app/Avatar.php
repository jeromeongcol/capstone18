<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Avatar extends Model
{
     public $table = "avatars";

    protected $fillable = [
        'mime_type', 'url',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
