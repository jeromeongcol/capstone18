<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Avatar;

class AvatarTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $avatar1 = new Avatar();
        $avatar1->user_id = '1';
        $avatar1->photo = '/storage/users/default.png';
        $avatar1->photo_thumb = '/storage/users/default.png';
        $avatar1->save();
        
        $avatar2 = new Avatar();
        $avatar2->user_id = '2';
        $avatar2->photo = '/storage/users/default.png'; 
        $avatar2->photo_thumb = '/storage/users/default.png';         
        $avatar2->save();

        $avatar3 = new Avatar();
        $avatar3->user_id = '3';
        $avatar3->photo = '/storage/users/default.png'; 
        $avatar3->photo_thumb = '/storage/users/default.png';
        $avatar3->save();
        
        $avatar4 = new Avatar();
        $avatar4->user_id = '4';
        $avatar4->photo = '/storage/users/default.png'; 
        $avatar4->photo_thumb = '/storage/users/default.png';         
        $avatar4->save();
        
        
    }
}

