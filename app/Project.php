<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public $table = "projects";

    protected $fillable = [
        'name', 'address' , 'price' , 'project_type'
    ];

    public function developers(){
    	return $this->hasOne(Developer::class);
    }

    public function type(){
    	return $this->hasOne(ProjectType::class);
    }
}
