<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectType extends Model
{ 	
	public $table = "project_types";
	
    public function projects(){
    	return $this->hasMany(Project::class);
    }
}
