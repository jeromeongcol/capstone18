<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $role_agent = new Role();
        $role_agent->name = 'Agent';
        $role_agent->description = 'an Agent User';
        $role_agent->save();

        $role_admin = new Role();
        $role_admin->name = 'Admin';
        $role_admin->description = 'An Admin User';
        $role_admin->save();
        
        $role_staff = new Role();
        $role_staff->name = 'Staff';
        $role_staff->description = 'a Staff User';
        $role_staff->save();


        $role_super_admin = new Role();
        $role_super_admin->name = 'SuperAdmin';
        $role_super_admin->description = 'a Super Admin User';
        $role_super_admin->save();


    }
}

