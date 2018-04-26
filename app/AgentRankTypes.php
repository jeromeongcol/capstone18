<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgentRankTypes extends Model
{
    public $table = "agent_rank_types";

    protected $fillable = [
        'rank', 'description' , 'commision_rate',
    ];
}
