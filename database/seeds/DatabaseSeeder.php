<?php

use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $this->call(AgentRankTypesTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(PersonsTableSeeder::class);
        $this->call(UsersTableSeeder::class);        
        $this->call(AvatarTableSeeder::class);
        $this->call(ProjectTypeSeeder::class);
        $this->call(AgentDetailsSeeder::class);
        $this->call(DeveloperSeeder::class);
    }
}
