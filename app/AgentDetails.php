<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgentDetails extends Model
{
    public $table = "agents_details";

    protected $fillable = [
        'agent_id', 'recruiter', 'recruits','approved','approved_by',
    ];

   public function childs() {
           return $this->hasMany(AgentDetails::class,'recruiter','agent_id') ;
   }


}
