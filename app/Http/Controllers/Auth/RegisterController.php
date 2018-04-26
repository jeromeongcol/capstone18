<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegistrationForm;
use App\Repositories\UsersRepositories;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Http\Request;
use Auth;
use DB;
use Validator;
use App\Person;
use App\Address;
use App\User;
use App\Role;
use App\Avatar;
use App\AgentRanks;
use App\AgentRankTypes;
use Image;
use Storage;
use App\AgentDetails;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */


    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/users';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function showRegistrationForm()
    {  

        $user_repo = new UsersRepositories;

        $user = $user_repo->getUser( Hashids::encode ( Auth::user()->id ) );

        $ranks = DB::table('agent_rank_types')->get();
        $roles = DB::table('roles')->get();
        $title = 'register';
        

        return view('auth.register', compact( 'user', 'ranks', 'roles' ,'title'));
    }

        /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    public function register( Request $request )
    {

      $validator = Validator::make( $request->all(), [

            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
            'firstname' => 'required|string|max:50',
            'lastname' => 'required|string|max:50',
            'middlename' => 'string|max:50',
            'gender' => 'required|string|max:10',
            'datebirth' => 'required|date|max:255',

      ]);


      $validator->sometimes('recruiter', 'required', function($request) {
            return $request->userrole == Role::where( 'name', 'Agent' )->first()->id;
      });


      if ($validator->passes()) {

                
        $user = new User();
        $avatar = new Avatar();
        $person = new Person();
            
        
        $person->firstname = ucfirst( strtolower( $request->firstname ) );
        $person->lastname = ucfirst( strtolower( $request->lastname ) );
        $person->middlename = ucfirst( strtolower( $request->middlename ) );
        $person->gender = ucfirst( strtolower( $request->gender ) );
        $person->datebirth = $request->datebirth;
        $person->save();

        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role_id = $request->userrole;
        $user->added_by = Auth::User()->id;
        $user->person_id = $person->id;
        $user->save();

        

        if( Role::where( 'id', $user->role_id )->first()->name == "Agent" ){
           
            $rank = new AgentRanks();
            $rank->agent_id = User::where('email' , $user->email )->first()->id;
            $rank->rank_type_id = AgentRankTypes::where( 'id' , $request->agentrank )->first()->id;
            $rank->save();

            $agentdetails = new AgentDetails();
            $agentdetails->recruiter = Hashids::decode ( $request->recruiter )[0];
            $agentdetails->agent_id = $user->id;
            $agentdetails->save();

            if( ( Role::where( 'id', Auth::user()->role_id )->first()->name == "Admin" ) || ( Role::where( 'id', Auth::user()->role_id )->first()->name == "SuperAdmin" ) ){

                $agentdetails->approved = 1;
                $agentdetails->approved_by = Auth::user()->id;
                $agentdetails->save();

                $recruiterdetails = AgentDetails::where('agent_id', Hashids::decode ( $request->recruiter )[0] )->first();

                $recruiterdetails->recruits = $recruiterdetails->recruits + 1;
                $recruiterdetails->update();


            }else{

                // if not adming send notification to the admin for approvation

                $agentdetails->approved = 0;
                $agentdetails->save();
            }


        }

        if( !empty( $request->avatar ) ){

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


        return response()->json(['success'=>'Successfully added new user.']);
      }else{
        return response()->json(['error'=>$validator->getMessageBag()->toArray()]);
      }



    }



    public function uploadAvatar($id){

        $data = $request->avatar;

        //generating unique file name;
        $file_name = 'photo_'.time().'.png';
        $file_name_thumb = 'thumb_'.time().'.png';
        @list($type, $data) = explode(';', $data);
        @list(, $data)      = explode(',', $data);


        $destinationPath = '/public/users/'.$id.'/';

        if( Storage::exists( $destinationPath ) ) Storage::deleteDirectory( $destinationPath );

        if($data!=""){

        $thumb = Image::make( base64_decode($data)  )->resize(150, 150);
        $image = Image::make( base64_decode($data)  )->resize(400, 400);

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
