<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Address;
use App\Person;
use App\User;

class PersonsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $person = new Person();
        $person->firstname = 'Super';
        $person->lastname = 'Admin';
        $person->middlename = 'Super';
        $person->save();

        $person1 = new Person();
        $person1->firstname = 'Admin';
        $person1->lastname = 'Admin';
        $person1->middlename = 'Admin';
        $person1->save();


        $person2 = new Person();
        $person2->firstname = 'Agent';
        $person2->lastname = 'Super';
        $person2->middlename = '';
        $person2->save();

        $person3 = new Person();
        $person3->firstname = 'Staff';
        $person3->lastname = 'Staff';
        $person3->middlename = 'Staff';
        $person3->save();
        

    }
}
