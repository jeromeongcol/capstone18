<?php

use Illuminate\Database\Seeder;
use App\Developer;

class DeveloperSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $developer = new Developer();
        $developer->name = 'Avida Land';
		$developer->contact = '1111111';
		$developer->address = 'Talisay City, Cebu';
        $developer->save();

        $developer = new Developer();
        $developer->name = 'Cebu Land Master Inc.';
		$developer->contact = '22222222';
		$developer->address = 'Talisay City, Cebu';
        $developer->save();

        
    }
}
