<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\File;
use App\Person;
use App\Address;
use App\User;
use App\Role;
use App\Avatar;
use App\AgentRanks;
use App\AgentRankTypes;
use Image;
use Auth;
use Storage;
use App\AgentDetails;
use Vinkla\Hashids\Facades\Hashids;

class RegistrationForm extends FormRequest
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
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
            'firstname' => 'required|regex:/^[a-zA-Z]+$/u|string|max:50',
            'lastname' => 'required|regex:/^[a-zA-Z]+$/u|string|max:50',
            'middlename' => 'required|regex:/^[a-zA-Z]+$/u|string|max:50',
            'gender' => 'required|string|max:10',
            'datebirth' => 'required|date|max:255',
            ];

    }



    public function persist(){

        
        $user = new User();
        $avatar = new Avatar();
        $person = new Person();
            
        
        $person->firstname = ucfirst( strtolower( $this->get('firstname') ) );
        $person->lastname = ucfirst( strtolower( $this->get('lastname') ) );
        $person->middlename = ucfirst( strtolower( $this->get('middlename') ) );
        $person->gender = ucfirst( strtolower( $this->get('gender') ) );
        $person->datebirth = $this->get('datebirth');
        $person->save();

        $user->email = $this->get('email');
        $user->password = bcrypt($this->get('password'));
        $user->role_id = $this->get('userrole');
        $user->added_by = Auth::User()->id;
        $user->person_id = $person->id;
        $user->save();

        

        if( Role::where( 'id', $user->role_id )->first()->name == "Agent" ){
           
            $rank = new AgentRanks();
            $rank->agent_id = User::where('email' , $user->email )->first()->id;
            $rank->rank_type_id = AgentRankTypes::where( 'id' , $this->get('agentrank') )->first()->id;
            $rank->save();

            $agentdetails = new AgentDetails();
            $agentdetails->recruiter = Hashids::decode ( $this->get('recruiter') )[0];
            $agentdetails->agent_id = $user->id;
            $agentdetails->save();

            if( ( Role::where( 'id', Auth::user()->role_id )->first()->name == "Admin" ) || ( Role::where( 'id', Auth::user()->role_id )->first()->name == "SuperAdmin" ) ){

                $agentdetails->approved = 1;
                $agentdetails->approved_by = Auth::user()->id;
                $agentdetails->save();

                $recruiterdetails = AgentDetails::where('agent_id', Hashids::decode ( $this->get('recruiter') )[0] )->first();

                $recruiterdetails->recruits = $recruiterdetails->recruits + 1;
                $recruiterdetails->update();


            }else{

                // if not adming send notification to the admin for approvation

                $agentdetails->approved = 0;
                $agentdetails->save();
            }

            

        }

        if( !empty( $this->get('avatar') ) ){

            $path = $this->uploadAvatar($user->id);

            $avatar->user_id = $user->id;
            $avatar->photo =  $path[0];
            $avatar->photo_thumb = $path[1];
            $avatar->save();

        }else{

            $avatar->user_id = $user->id;
            $avatar->photo = '/storage/users/default.png';
            $avatar->photo_thumb = '/storage/users/default.png';
            $avatar->save();
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
