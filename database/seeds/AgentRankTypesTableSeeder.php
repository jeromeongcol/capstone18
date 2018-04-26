<?php

use Illuminate\Database\Seeder;
use App\AgentRankTypes;

class AgentRankTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $PC = new AgentRankTypes();
        $PC->rank = 'PC';
        $PC->description = 'Property Consultant';
        $PC->commission_rate = 0.03;
        $PC->save();

        $RPC = new AgentRankTypes();
        $RPC->rank = 'RPC';
        $RPC->description = 'Regional Property Consultant';
        $RPC->commission_rate = 0.035;
        $RPC->save();

        $GID = new AgentRankTypes();
        $GID->rank = 'GID';
        $GID->description = 'Global Invest Director';
        $GID->commission_rate = 0.04;
        $GID->save();

        $PTM = new AgentRankTypes();
        $PTM->rank = 'PTM';
        $PTM->description = 'Project Team Manager';
        $PTM->commission_rate = 0.05;
        $PTM->save();
    }
}
