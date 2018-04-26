<?php

use Illuminate\Database\Seeder;
use App\agentDetails;

class AgentDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $agentDetails = new agentDetails();
        $agentDetails->agent_id = 3;
        $agentDetails->recruiter = 1;
        $agentDetails->recruits = 0;
        $agentDetails->approved = 1;
        $agentDetails->approved_by = 1;
        $agentDetails->save();

    }
}
