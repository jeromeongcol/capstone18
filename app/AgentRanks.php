<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgentRanks extends Model
{
    public $table = "agent_ranks";

    protected $fillable = [
        'agent_id', '	rank_type_id',
    ];
}
