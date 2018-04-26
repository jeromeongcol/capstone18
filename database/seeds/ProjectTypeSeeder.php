<?php

use Illuminate\Database\Seeder;
use App\ProjectType;

class ProjectTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = new ProjectType();
        $category->type = 'House and Lot';
        $category->deleted = 0;
        $category->save();

        $category = new ProjectType();
        $category->type = 'Lot Only';
        $category->deleted = 0;
        $category->save();

        $category = new ProjectType();
        $category->type = 'Condominium';
        $category->deleted = 0;
        $category->save();

        $category = new ProjectType();
        $category->type = 'Commercial Building';
        $category->deleted = 0;
        $category->save();

        $category = new ProjectType();
        $category->type = 'Memorial';
        $category->deleted = 0;
        $category->save();


        $category = new ProjectType();
        $category->type = 'Farm Land';
        $category->deleted = 0;
        $category->save();

        $category = new ProjectType();
        $category->type = 'Raw Land';
        $category->deleted = 0;
        $category->save();

        $category = new ProjectType();
        $category->type = 'Beach Lot';
        $category->deleted = 0;
        $category->save();

        $category = new ProjectType();
        $category->type = 'Subdivision';
        $category->deleted = 0;
        $category->save();
    
        $category = new ProjectType();
        $category->type = 'Town House';
        $category->deleted = 0;
        $category->save();
    }
}
