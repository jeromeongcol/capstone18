<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\File;
use Image;
use App\Avatar;
use Storage;

class ChangeProfilePictureForm extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
       return [
            
        ];
    }

    public function persist($id){

        $avatar = Avatar::where('user_id',$id)->first();


        if( !empty( $this->get('avatar') ) ){

            $path = $this->uploadAvatar($id);

            $avatar->photo = $path[0];
            $avatar->photo_thumb = $path[1];
            $avatar->update();

        }else{

            $avatar->user_id = $id;
            $avatar->photo = 'storage/users/default.png';
            $avatar->photo_thumb = 'storage/users//default.png';
            $avatar->update();
        }

    }

    public function uploadAvatar($id){

        $data = $this->get('avatar');

        //generating unique file name;
        $file_name = 'photo_'.time().'.png';
        $file_name_thumb = 'thumb_'.time().'.png';
        @list($type, $data) = explode(';', $data);
        @list(, $data)      = explode(',', $data);


        $destinationPath = '/public/users/'.$id.'/';

        if( Storage::exists( $destinationPath ) ) Storage::deleteDirectory( $destinationPath );

        if($data!=""){

        $thumb = Image::make( base64_decode($data)  )->resize(150, 150);
        $image = Image::make( base64_decode($data)  );

        Storage::disk('local')->put( $destinationPath . $file_name_thumb,  $thumb->stream());
        Storage::disk('local')->put( $destinationPath . $file_name,  $image->stream());

        }


        $photos = [

            '/storage/users/'.$id.'/' .$file_name,
            '/storage/users/'.$id.'/' .$file_name_thumb

        ];

        return $photos;

    }
}
