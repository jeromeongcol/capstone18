<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectPhoto extends Model
{
    public $table = "project_photos";
	
    public function projects(){
    	return $this->hasMany(Project::class);
    }
}
