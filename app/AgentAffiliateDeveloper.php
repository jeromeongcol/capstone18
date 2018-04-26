<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgentAffiliateDeveloper extends Model
{
    public $table = "agent_affiliate_developers";

    protected $fillable = [
        'agent_id', 'developer_id',
    ];
}
