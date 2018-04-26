<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\User;
use App\Role;
use App\AgentRanks;
use App\AgentRankTypes;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {       


            $super_admin = new User();
            $super_admin->email = 'superadmin@gmail.com';
            $super_admin->password = bcrypt('superadmin');
            $super_admin->role_id = Role::where('name','SuperAdmin')->first()->id;
            $super_admin->added_by = 1;
            $super_admin->person_id = 1;
            $super_admin->save();


            $admin = new User();
            $admin->email = 'admin@gmail.com';
            $admin->password = bcrypt('admin');
            $admin->role_id = Role::where('name','admin')->first()->id;
            $admin->added_by = 2;
            $admin->person_id = 2;
            $admin->save();
            


            $agent1 = new User();
            $agent1->email = 'superagent@gmail.com';
            $agent1->password = bcrypt('superagent'); 
            $agent1->role_id = Role::where('name','Agent')->first()->id;
            $agent1->added_by = 3;
            $agent1->person_id = 3;          
            $agent1->save();

            $rank = new AgentRanks();
            $rank->agent_id = User::where('email' , $agent1->email )->first()->id;
            $rank->rank_type_id = AgentRankTypes::where("rank","PTM")->first()->id;
            $rank->save();


            $staff = new User();
            $staff->email = 'staff@gmail.com';
            $staff->password = bcrypt('staff');
            $staff->role_id = Role::where('name','Staff')->first()->id;
            $staff->added_by = 4; 
            $staff->person_id = 4;          
            $staff->save();
            

 
    }
}
