<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\ChannelManager;
use App\Http\Requests\RegistrationForm;
use App\Http\Requests\UpdateAccountForm;
use App\Http\Requests\UpdateInformationForm;
use App\Http\Requests\ChangePasswordForm;
use App\Http\Requests\ChangeProfilePictureForm;
use App\Repositories\UsersRepositories;
use App\Repositories\MasterRepositories;
use App\Notifications\AgentApprovation;
use Auth;
use Vinkla\Hashids\Facades\Hashids;
use Validator;
use App\User;
use App\Person;
use App\Role;
use Storage;
use App\Avatar;
use App\AgentRankTypes;
use App\AgentRanks;
use Image;
use App\AgentDetails;
use App\AgentAffiliateDeveloper;
use Route;
use DB;
use Notification;
use App\Repositories\DevelopersRepositories;

class UserController extends Controller
{
     




     /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function userProfile(Request $request)
    {  

        if($request->ajax()){

            $repositories = new UsersRepositories;
            $user = $repositories->getUser( $request->id );

            $master = new MasterRepositories;
            $downlines = $master->getDownlines( $request->id ) ;

            $view = view('dashboard.users.profile')->with(compact('user', 'downlines'))->render();

            return response()->json(['content'=> $view ]);

        }
    }
    

     /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateUser(Request $request)
    {  

        if($request->ajax()){

            $repositories = new UsersRepositories;
            $user = $repositories->getUser( $request->id );
            $auth = $repositories->getUser( Hashids::encode ( Auth::user()->id ) );
            $ranks = $repositories->AgentRanks();
            $agents = $repositories->Recruiters();
            $recruiter = null;

            if( !empty( $user->recruiter) ) {  
                $recruiter = $repositories->getRecruiter( $user->recruiter  );
            }

            $view = view('dashboard.users.forms.update')->with(compact('user','auth', 'ranks', 'agents', 'recruiter'))->render();

            return response()->json(['content'=> $view ]);

        }

    }



    public function verifyrights(Request $request)
    {

      if($request->ajax()){

         $repositories = new UsersRepositories;

         $result = $repositories->verifyrights( $request->verifypassword );

         return response()->json($result);

      }

    }


    public function getUser(Request $request)
    {
        if($request->ajax()){

            $repositories = new UsersRepositories;

            $result = $repositories->getUser( $request->id );

            return response()->json($result);
        }
    }


	 /**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
    public function users(Request $request)
    {  

    	$repositories = new UsersRepositories;
    	$auth = $repositories->getUser( Hashids::encode ( Auth::user()->id ) );
    	$users = $repositories->Agents();

    	if( $request->ajax() ){

            $content  = view('dashboard.users.partials.agents')->with(compact('users','auth'))->render();
	        return response()->json(['content'=> $content ]);

    	}

    	$content  = view('dashboard.users.partials.agents')->with(compact('users','auth'))->render();
        return view('dashboard.users.users', compact('content','auth'));

    }







	 /**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
    public function agents(Request $request)
    {  
        $repositories = new UsersRepositories;
    	$auth = $repositories->getUser( Hashids::encode ( Auth::user()->id ) );
    	$users = $repositories->Agents();


    	if( $request->ajax() ){

    		$content  = view('dashboard.users.partials.agents')->with(compact('users','auth'))->render();
	        return response()->json(['content'=> $content ]);
    	}


    	$content  = view('dashboard.users.partials.agents')->with(compact('users','auth'))->render();
        return view('dashboard.users.users', compact( 'content', 'auth' , 'sidebar'));
    }



     /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function agentRanks(Request $request)
    {  


        $repositories = new UsersRepositories;
        $auth = $repositories->getUser( Hashids::encode ( Auth::user()->id ) );
        $ranks = $repositories->AgentRanks();

        if( $request->ajax() ){

            $content  = view('dashboard.users.partials.agent-ranks')->with(compact('ranks'))->render();
            return response()->json(['content'=> $content ]);
        }

        $content  = view('dashboard.users.partials.agent-ranks')->with(compact('ranks'))->render();
        return view('dashboard.users.users', compact( 'content', 'auth' ));

    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAgentRank( Request $request )
    {

      $repositories = new UsersRepositories;

      $ranks = $repositories->getAgentRank( $request->id );

      return response()->json($ranks);
    }





    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateAgentRankType( Request $request )
    {

      $id = Hashids::decode( $request->id )[0] ;


      $validator = Validator::make( $request->all(), [

        'rank' => 'required|string|min:2|unique:agent_rank_types,rank,' . $id,
        'description' => 'required|string|min:2',
        'commission_rate' => 'required|numeric',

      ]);


      if ($validator->passes()) {

                
        $agentRank = AgentRankTypes::where('id',$id)->first();

        $agentRank->rank = $request->rank;
        $agentRank->description = $request->description;
        $agentRank->commission_rate = $request->commission_rate;
        $agentRank->update();


        $repositories = new UsersRepositories;
        $auth = $repositories->getUser( Hashids::encode ( Auth::user()->id ) );
        $ranks = $repositories->AgentRanks();
        $success = "Successfuly updated rank.";

        $content  = view('dashboard.users.partials.agent-ranks')->with(compact('ranks'))->render();
        return response()->json(['content'=> $content, 'success' => $success ]);

      }else{
        return response()->json(['error'=>$validator->getMessageBag()->toArray()]);
      }




    }








     /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function staffs(Request $request)
    {  
        $repositories = new UsersRepositories;
        $auth = $repositories->getUser( Hashids::encode ( Auth::user()->id ) );
        $users = $repositories->Staffs();


        if( $request->ajax() ){

            $content  = view('dashboard.users.partials.staffs')->with(compact('users','auth'))->render();
            return response()->json(['content'=> $content]);
        }

        $content  = view('dashboard.users.partials.staffs')->with(compact('users','auth'))->render();
        return view('dashboard.users.users', compact( 'content','auth' ));
    }







     /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function admins(Request $request)
    {  
        $repositories = new UsersRepositories;
        $auth = $repositories->getUser( Hashids::encode ( Auth::user()->id ) );
        $users = $repositories->Admins();

        if( $request->ajax() ){

            $content  = view('dashboard.users.partials.admins')->with(compact('users','auth'))->render();
            return response()->json(['content'=> $content ]);
        }

        $content  = view('dashboard.users.partials.admins')->with(compact('users','auth'))->render();
        return view('dashboard.users.users', compact( 'content','auth'));
    }



    

    public function addAgentShowForm(Request $request)
    {  
        $repositories = new UsersRepositories;
        $ranks = $repositories->AgentRanks();
        $agents = $repositories->Recruiters();
        $developer_repo = new DevelopersRepositories;
        $auth = $repositories->getUser( Hashids::encode ( Auth::user()->id ) );
        $developers = $developer_repo->getAllActiveDevelopers();
      
        if( $request->ajax() ){

            $content  = view('dashboard.users.forms.agent.add')->with( compact('ranks','agents','auth','developers') )->render();
            return response()->json(['content'=> $content]);
        }

        
        $content  = view('dashboard.users.forms.agent.add')->with( compact('ranks','agents','auth','developers') )->render();
        
        return view('dashboard.users.users', compact( 'content','auth' ));
    }





    public function addStaffShowForm(Request $request)
    {  
        $repositories = new UsersRepositories;
        $auth = $repositories->getUser( Hashids::encode ( Auth::user()->id ) );

        if( $request->ajax() ){

            $content  = view('dashboard.users.forms.staff.add')->with(compact('auth'))->render();

            return response()->json(['content'=> $content]);
        }

        $content  = view('dashboard.users.forms.staff.add')->with(compact('auth'))->render();
        
        return view('dashboard.users.users', compact( 'content','auth' ));
    }


    public function addAdminShowForm(Request $request)
    {  
        $repositories = new UsersRepositories;
        $auth = $repositories->getUser( Hashids::encode ( Auth::user()->id ) );

        if( $request->ajax() ){

            $content  = view('dashboard.users.forms.admin.add')->with(compact('auth'))->render();

            return response()->json(['content'=> $content]);
        }

        
        $content  = view('dashboard.users.forms.admin.add')->with(compact('auth'))->render();
        
        return view('dashboard.users.users', compact( 'content','auth' ));
    }




    public function searchAgent(Request $request)
    {  
        $repositories = new UsersRepositories;
        $agents = $repositories->SearchAgent( $request->key );        
        $content  = view('dashboard.users.forms.agent.partials.agent-search-result')->with( compact('agents') )->render();
        return response()->json(['content'=> $content ]);

    }



    public function validateAccount( Request $request )
    {

        $validator = Validator::make( $request->all(), [

            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required|min:6'

        ]);

        if($validator->passes()) {
            return response()->json(['success' => 'success']);
        }
        else
        {
            return response()->json(['error'=>$validator->getMessageBag()->toArray()]);
        }



    }


    public function validateAdditionalInfo( Request $request )
    {

        $validator = Validator::make( $request->all(), [

            'firstname' => 'required|string|max:50|regex:/^[(a-zA-Z\s)]+$/u',
            'lastname' => 'required|string|max:50|regex:/^[(a-zA-Z\s)]+$/u',
            'middlename' => 'string|nullable|regex:/^[(a-zA-Z\s)]+$/u',

        ]);

        if($validator->passes()) {
            return response()->json(['success' => 'success']);
        }
        else
        {
            return response()->json(['error'=>$validator->getMessageBag()->toArray()]);
        }



    }



    public function addAgent( Request $request )
    {


        $validator = Validator::make( $request->all(), [

            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'firstname' => 'required|string|max:50|regex:/^[(a-zA-Z\s)]+$/u',
            'lastname' => 'required|string|max:50|regex:/^[(a-zA-Z\s)]+$/u',
            'middlename' => 'string|nullable|regex:/^[(a-zA-Z\s)]+$/u',
            'rank' => 'required',
            'recruiter' => 'required',
            'developer' => 'nullable'


        ]);


      if( $validator->passes() ) {

                
        $user = new User();
        $avatar = new Avatar();
        $person = new Person();

        
        $person->firstname = ucfirst( strtolower( $request->firstname ) );
        $person->lastname = ucfirst( strtolower( $request->lastname ) );
        $person->middlename = ucfirst( strtolower( $request->middlename ) );
        $person->save();

        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role_id = Role::where( 'name', 'Agent')->first()->id;
        $user->added_by = Auth::User()->id;
        $user->person_id = $person->id;
        $user->save();

        if( Role::where( 'id', $user->role_id )->first()->name == "Agent" ){

            $rank = new AgentRanks();
            $rank->agent_id = $user->id;
            $rank->rank_type_id = AgentRankTypes::where( 'id' , Hashids::decode ( $request->rank )[0] )->first()->id;
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

               
                $user->active = 0;
                $user->save();
                $agentdetails->approved = 0;
                $agentdetails->save();


                $admins = User::where('role_id', Role::where('name', 'Admin')->first()->id )->get();
                $superadmins = User::where('role_id', Role::where('name', 'SuperAdmin')->first()->id )->get();
                
                $repositories = new UsersRepositories;
                $auth = $repositories->getUserForNotification( Hashids::encode ( Auth::user()->id ) );


            }


        }


        if( !empty( $request->developer )  ){

            $agentDeveloper = new AgentAffiliateDeveloper();
            $agentDeveloper->agent_id = $user->id;
            $agentDeveloper->developer_id = Hashids::decode( $request->developer )[0];
            $agentDeveloper->save();

        }




        if( !empty( $request->avatar ) ){

            $path = $this->uploadAvatar( Hashids::encode( $user->id ) );

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

        $repositories = new UsersRepositories;
        $auth = $repositories->getUser( Hashids::encode ( Auth::user()->id ) );
        $users = $repositories->Agents();
        $success = "Successfuly Added new Agent.";
        $content  = view('dashboard.users.partials.agents')->with(compact('users','auth'))->render();

        return response()->json(['content'=> $content, 'success' => $success ]);

      }else{

        return response()->json(['error'=>$validator->getMessageBag()->toArray()]);

      }

    }






    public function addStaff( Request $request )
    {


        $validator = Validator::make( $request->all(), [

            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'firstname' => 'required|string|max:50|regex:/^[(a-zA-Z\s)]+$/u',
            'lastname' => 'required|string|max:50|regex:/^[(a-zA-Z\s)]+$/u',
            'middlename' => 'string|nullable|regex:/^[(a-zA-Z\s)]+$/u',


        ]);


      if( $validator->passes() ) {

                
        $user = new User();
        $avatar = new Avatar();
        $person = new Person();

        
        $person->firstname = ucfirst( strtolower( $request->firstname ) );
        $person->lastname = ucfirst( strtolower( $request->lastname ) );
        $person->middlename = ucfirst( strtolower( $request->middlename ) );
        $person->save();

        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role_id = Role::where( 'name', 'Staff')->first()->id;
        $user->added_by = Auth::User()->id;
        $user->person_id = $person->id;
        $user->save();

        if( !empty( $request->avatar ) ){

            $path = $this->uploadAvatar( Hashids::encode( $user->id ) );

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

        $repositories = new UsersRepositories;
        $auth = $repositories->getUser( Hashids::encode ( Auth::user()->id ) );
        $users = $repositories->Staffs();
        $success = "Successfuly Added new Staff.";

        $content  = view('dashboard.users.partials.staffs')->with(compact('users','auth'))->render();

        return response()->json(['content'=> $content, 'success' => $success ]);

      }else{

        return response()->json(['error'=>$validator->getMessageBag()->toArray()]);

      }


    }





    public function addAdmin( Request $request )
    {


        $validator = Validator::make( $request->all(), [

            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'firstname' => 'required|string|max:50|regex:/^[(a-zA-Z\s)]+$/u',
            'lastname' => 'required|string|max:50|regex:/^[(a-zA-Z\s)]+$/u',
            'middlename' => 'string|nullable|regex:/^[(a-zA-Z\s)]+$/u',


        ]);


      if( $validator->passes() ) {

                
        $user = new User();
        $avatar = new Avatar();
        $person = new Person();

        
        $person->firstname = ucfirst( strtolower( $request->firstname ) );
        $person->lastname = ucfirst( strtolower( $request->lastname ) );
        $person->middlename = ucfirst( strtolower( $request->middlename ) );
        $person->save();

        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role_id = Role::where( 'name', 'Admin')->first()->id;
        $user->added_by = Auth::User()->id;
        $user->person_id = $person->id;
        $user->save();

        if( !empty( $request->avatar ) ){

            $path = $this->uploadAvatar( Hashids::encode( $user->id ) );

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

        $repositories = new UsersRepositories;
        $auth = $repositories->getUser( Hashids::encode ( Auth::user()->id ) );
        $users = $repositories->Admins();
        $success = "Successfuly Added new Admin.";

        $content  = view('dashboard.users.partials.admins')->with(compact('users','auth'))->render();

        return response()->json(['content'=> $content , 'success' => $success ]);

      }else{

        return response()->json(['error'=>$validator->getMessageBag()->toArray()]);

      }


    }







    public function setToNotActive( Request $request )
    {   
        $repositories = new UsersRepositories;        
        $result = $repositories->setToNotActive( $request->id );
        $auth = $repositories->getUser( Hashids::encode ( Auth::user()->id ) );
        $user = $repositories->getUser( $request->id );
        $ranks = $repositories->AgentRanks();
        $agents = $repositories->Recruiters();
        $recruiter = null;
        $users = null;
        $content = null;
        $self = null;
        $users = null;
        $content = null;
        $self = null;


            if( Auth::user()->id == Hashids::decode( $request->id )[0] ){

                    $master = new MasterRepositories;
                    $downlines = $master->getDownlines( $request->id ) ;

                    $user = $repositories->getUser( $request->id );

                    if( !empty( $user->recruiter) ) {  
                        $recruiter = $repositories->getRecruiter( $user->recruiter  );
                    }

                    $self = view('dashboard.users.forms.update')->with(compact('user', 'auth', 'ranks', 'agents', 'recruiter'))->render();


            }else{


                if( Role::where( 'id', $user->role_id )->first()->name == "Agent" ){

                    $users = $repositories->Agents();
                    $content  = view('dashboard.users.partials.agents')->with(compact('users','auth'))->render();

                }else if( Role::where( 'id', $user->role_id )->first()->name == "Staff" ) {

                    $users = $repositories->Staffs();
                    $content  = view('dashboard.users.partials.staffs')->with(compact('users','auth'))->render();

                }else{

                    $users = $repositories->Admins();
                    $content  = view('dashboard.users.partials.admins')->with(compact('users','auth'))->render();
                }

            }


        $success = "Successfuly set the user to not active.";
        $user = $repositories->getUser( $request->id );

        if( !empty( $user->recruiter) ) {  
            $recruiter = $repositories->getRecruiter( $user->recruiter  );
        }
        
        $overlay = view('dashboard.users.forms.update')->with(compact('user', 'auth', 'ranks', 'agents', 'recruiter'))->render();
        
        return response()->json(['content'=> $content , 'success' => $success, 'overlay' => $overlay, 'self' => $self]);

    }






    public function setToActive( Request $request )
    {   
        
        $repositories = new UsersRepositories;        
        $result = $repositories->setToActive( $request->id );
        $auth = $repositories->getUser( Hashids::encode ( Auth::user()->id ) );
        $user = User::where('id', Hashids::decode( $request->id )[0] )->first();
        $ranks = $repositories->AgentRanks();
        $agents = $repositories->Recruiters();
        $recruiter = null;
        $users = null;
        $content = null;
        $self = null;

          if( Auth::user()->id == Hashids::decode( $request->id )[0] ){

                    $master = new MasterRepositories;
                    $downlines = $master->getDownlines( $request->id ) ;

                    $user = $repositories->getUser( $request->id );

                    if( !empty( $user->recruiter) ) {  
                        $recruiter = $repositories->getRecruiter( $user->recruiter  );
                    }

                    $self = view('dashboard.users.forms.update')->with(compact('user', 'auth', 'ranks', 'agents', 'recruiter'))->render();


            }else{


                if( Role::where( 'id', $user->role_id )->first()->name == "Agent" ){

                    $users = $repositories->Agents();
                    $content  = view('dashboard.users.partials.agents')->with(compact('users','auth'))->render();

                }else if( Role::where( 'id', $user->role_id )->first()->name == "Staff" ) {

                    $users = $repositories->Staffs();
                    $content  = view('dashboard.users.partials.staffs')->with(compact('users','auth'))->render();

                }else{

                    $users = $repositories->Admins();
                    $content  = view('dashboard.users.partials.admins')->with(compact('users','auth'))->render();
                }


            }

        $success = "Successfuly set the user to not active.";
        $user = $repositories->getUser( $request->id );

        if( !empty( $user->recruiter) ) {  
            $recruiter = $repositories->getRecruiter( $user->recruiter  );
        }
        
        $overlay = view('dashboard.users.forms.update')->with(compact('user', 'auth', 'ranks', 'agents', 'recruiter'))->render();

        return response()->json(['content'=> $content , 'success' => $success, 'overlay' => $overlay, 'self' => $self]);
    }





    public function approve( Request $request )
    {   
        
        $repositories = new UsersRepositories;        
        $result = $repositories->approve( $request->id );
        $auth = $repositories->getUser( Hashids::encode ( Auth::user()->id ) );
        $ranks = $repositories->AgentRanks();
        $agents = $repositories->Recruiters();
        $recruiter = null;
        $users = $repositories->Agents();
        $content  = view('dashboard.users.partials.agents')->with(compact('users','auth'))->render();


        $user = $repositories->getUser( $request->id );

        if( !empty( $user->recruiter) ) {  
            $recruiter = $repositories->getRecruiter( $user->recruiter  );
        }
        
        $overlay = view('dashboard.users.forms.update')->with(compact('user', 'auth', 'ranks', 'agents', 'recruiter'))->render();

        $success = "Successfuly approved an agent.";

        return response()->json(['content'=> $content , 'success' => $success, 'overlay' => $overlay, 'self' => null ]);
    }



    public function disapprove( Request $request )
    {   
        
        $repositories = new UsersRepositories;        
        $result = $repositories->disapprove( $request->id );
        $auth = $repositories->getUser( Hashids::encode ( Auth::user()->id ) );
        $ranks = $repositories->AgentRanks();
        $agents = $repositories->Recruiters();
        $recruiter = null;
        $users = $repositories->Agents();

        $content  = view('dashboard.users.partials.agents')->with(compact('users','auth'))->render();

        $user = $repositories->getUser( $request->id );
        
        if( !empty( $user->recruiter) ) {  
            $recruiter = $repositories->getRecruiter( $user->recruiter  );
        }
        
        $overlay = view('dashboard.users.forms.update')->with(compact('user', 'auth', 'ranks', 'agents', 'recruiter'))->render();

        $success = "Successfuly disapproved an agent.";

        return response()->json(['content'=> $content , 'success' => $success, 'overlay' => $overlay, 'self' => null ]);
    }






    public function updateEmail( Request $request )
    {   

        $validator = Validator::make( $request->all(), [

            'email' => 'required|string|email|max:255|unique:users',
        ]);


        if( $validator->passes() ) {
            
            $repositories = new UsersRepositories;        
            $auth = $repositories->getUser( Hashids::encode ( Auth::user()->id ) );
            $ranks = $repositories->AgentRanks();
            $agents = $repositories->Recruiters();
            $recruiter = null;

            $user = User::where('id', Hashids::decode( $request->id )[0] )->first();
            $user->email = $request->email;
            $user->save();


            $users = null;
            $content = null;
            $self = null;


            if( Auth::user()->id == Hashids::decode( $request->id )[0] ){

                    $user = $repositories->getUser( $request->id );
                    $master = new MasterRepositories;
                    $downlines = $master->getDownlines( $request->id ) ;

                    $user = $repositories->getUser( $request->id );
                   
                    if( !empty( $user->recruiter) ) {  
                        $recruiter = $repositories->getRecruiter( $user->recruiter  );
                    }

                    $self = view('dashboard.users.forms.update')->with(compact('user', 'auth', 'ranks', 'agents', 'recruiter'))->render();


            }else{


                if( Role::where( 'id', $user->role_id )->first()->name == "Agent" ){

                    $users = $repositories->Agents();
                    $content  = view('dashboard.users.partials.agents')->with(compact('users','auth'))->render();

                }else if( Role::where( 'id', $user->role_id )->first()->name == "Staff" ) {

                    $users = $repositories->Staffs();
                    $content  = view('dashboard.users.partials.staffs')->with(compact('users','auth'))->render();

                }else{

                    $users = $repositories->Admins();
                    $content  = view('dashboard.users.partials.admins')->with(compact('users','auth'))->render();
                }


            }


            $success = "Email address successfuly updated.";
            $user = $repositories->getUser( $request->id );

            if( !empty( $user->recruiter) ) {  
                $recruiter = $repositories->getRecruiter( $user->recruiter  );
            }

            $overlay = view('dashboard.users.forms.update')->with(compact('user', 'auth', 'ranks', 'agents', 'recruiter'))->render();

            return response()->json(['content' => $content, 'success' => $success, 'overlay' => $overlay, 'self' => $self ]);


        }else{

        return response()->json(['error'=>$validator->getMessageBag()->toArray()]);

      }


    }








    public function changePassword( Request $request )
    {   

        $validator = Validator::make( $request->all(), [

            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required|min:6'

        ]);

        if( $validator->passes() ) {
            
            $repositories = new UsersRepositories;        
            $auth = $repositories->getUser( Hashids::encode ( Auth::user()->id ) );

            $user = User::where('id', Hashids::decode( $request->id )[0] )->first();
            $user->password = bcrypt($request->password);
            $user->save();

            $success = "Password Successfuly updated.";

            return response()->json(['success' => $success ]);

        }else{

        return response()->json(['error'=>$validator->getMessageBag()->toArray()]);

      }


    }


   public function updateAgentRank( Request $request )
    {   

        $repositories = new UsersRepositories;        
        $auth = $repositories->getUser( Hashids::encode ( Auth::user()->id ) );

        $agentRank = AgentRanks::where('agent_id', Hashids::decode( $request->id )[0] )->first();
        $agentRank->rank_type_id = Hashids::decode( $request->rank )[0] ;
        $agentRank->save();

        $ranks = $repositories->AgentRanks();
        $user = $repositories->getUser( $request->id );
        $agents = $repositories->Recruiters();
        $recruiter = null;

        $users = $repositories->Agents();
        $content  = view('dashboard.users.partials.agents')->with(compact('users','auth'))->render();


        $success = "Agent Rank Successfuly updated.";

        if( !empty( $user->recruiter) ) {  
            $recruiter = $repositories->getRecruiter( $user->recruiter  );
        }

        $overlay = view('dashboard.users.forms.update')->with(compact('user', 'auth', 'ranks', 'agents', 'recruiter'))->render();

        return response()->json([ 'content' => $content ,'success' => $success, 'overlay' => $overlay ]);


    }




   public function updateAgentRecruiter( Request $request )
    {   


        $repositories = new UsersRepositories;        
        $auth = $repositories->getUser( Hashids::encode ( Auth::user()->id ) );

        if( $repositories->getUser( $repositories->getUser( $request->id )->recruiter )->role  != "SuperAdmin" ){


            if(  AgentDetails::where('agent_id', Hashids::decode( $request->id )[0] )->first()->recruiter !=  Hashids::decode( $request->recruiter )[0] ){


                $recruit = AgentDetails::where('agent_id', Hashids::decode( $request->id )[0] )->first();
                $recruiter_old = AgentDetails::where('agent_id', $recruit->recruiter )->first();
                $recruiter_new = AgentDetails::where('agent_id', Hashids::decode( $request->recruiter )[0] )->first();


                $recruiter_old->recruits = $recruiter_old->recruits - 1;
                $recruiter_old->update();
                
                $recruit->recruiter = Hashids::decode( $request->recruiter )[0];
                $recruit->update();

                $recruiter_new->recruits = $recruiter_new->recruits + 1;
                $recruiter_new->update();


            }

        }else{




            $ranks = $repositories->AgentRanks();
            $user = $repositories->getUser( $request->id );
            $agents = $repositories->Recruiters();
            $recruiter = null;

            $users = $repositories->Agents();
            $content  = view('dashboard.users.partials.agents')->with(compact('users','auth'))->render();


            $success = "Action not allowed. You cannot change the recruiter of this agent.";

            if( !empty( $user->recruiter) ) {  
                $recruiter = $repositories->getRecruiter( $user->recruiter  );
            }

            $overlay = view('dashboard.users.forms.update')->with(compact('user', 'auth', 'ranks', 'agents', 'recruiter'))->render();

            return response()->json([ 'content' => $content ,'error' => $success, 'overlay' => $overlay ]);


        }

        $ranks = $repositories->AgentRanks();
        $user = $repositories->getUser( $request->id );
        $agents = $repositories->Recruiters();
        $recruiter = null;

        $users = $repositories->Agents();
        $content  = view('dashboard.users.partials.agents')->with(compact('users','auth'))->render();


        $success = "Agent recruiter Successfuly updated.";

        if( !empty( $user->recruiter) ) {  
            $recruiter = $repositories->getRecruiter( $user->recruiter  );
        }

        $overlay = view('dashboard.users.forms.update')->with(compact('user', 'auth', 'ranks', 'agents', 'recruiter'))->render();

        return response()->json([ 'content' => $content ,'success' => $success, 'overlay' => $overlay ]);


    }




    public function updateBasicInfo( Request $request )
    {   

        $validator = Validator::make( $request->all(), [

            'firstname' => 'required|string|max:50|regex:/^[(a-zA-Z\s)]+$/u',
            'lastname' => 'required|string|max:50|regex:/^[(a-zA-Z\s)]+$/u',
            'middlename' => 'string|nullable|regex:/^[(a-zA-Z\s)]+$/u',

        ]);

        if( $validator->passes() ) {
            
            $repositories = new UsersRepositories;        
            $auth = $repositories->getUser( Hashids::encode ( Auth::user()->id ) );
            $ranks = $repositories->AgentRanks();
            $agents = $repositories->Recruiters();
            $recruiter = null;

            $user = User::where('id', Hashids::decode( $request->id )[0] )->first();
            $person = Person::where('id', $user->person_id)->first();
            $person->firstname = ucfirst( strtolower( $request->firstname ) );
            $person->lastname = ucfirst( strtolower( $request->lastname ) );
            $person->middlename = ucfirst( strtolower( $request->middlename ) );
            $person->save();

            $users = null;
            $content = null;
            $self = null;


            if( Auth::user()->id == Hashids::decode( $request->id )[0] ){

                    $user = $repositories->getUser( $request->id );
                    $master = new MasterRepositories;
                    $downlines = $master->getDownlines( $request->id ) ;

                    $user = $repositories->getUser( $request->id );

                    if( !empty( $user->recruiter) ) {  
                        $recruiter = $repositories->getRecruiter( $user->recruiter  );
                    }

                    $self = view('dashboard.users.forms.update')->with(compact('user', 'auth', 'ranks', 'agents', 'recruiter'))->render();


            }else{


                if( Role::where( 'id', $user->role_id )->first()->name == "Agent" ){

                    $users = $repositories->Agents();
                    $content  = view('dashboard.users.partials.agents')->with(compact('users','auth'))->render();

                }else if( Role::where( 'id', $user->role_id )->first()->name == "Staff" ) {

                    $users = $repositories->Staffs();
                    $content  = view('dashboard.users.partials.staffs')->with(compact('users','auth'))->render();

                }else{

                    $users = $repositories->Admins();
                    $content  = view('dashboard.users.partials.admins')->with(compact('users','auth'))->render();
                }


            }

            $success = "Basic Information Successfuly updated.";
            $user = $repositories->getUser( $request->id );

            if( !empty( $user->recruiter) ) {  
                $recruiter = $repositories->getRecruiter( $user->recruiter  );
            }
            

            $overlay = view('dashboard.users.forms.update')->with(compact('user', 'auth', 'ranks', 'agents', 'recruiter'))->render();

            return response()->json(['content' => $content, 'success' => $success, 'overlay' => $overlay, 'self' => $self ]);

        }else{

        return response()->json(['error'=>$validator->getMessageBag()->toArray()]);

      }


    }



    public function changeProfiePicture( Request $request )
    {   

        if( !empty( $request->avatar ) ){

            $path = $this->uploadAvatar( $request->id );

            $avatar = Avatar::where('user_id', Hashids::decode( $request->id )[0])->first();
            $avatar->photo =  $path[0];
            $avatar->photo_thumb = $path[1];
            $avatar->save();


            $repositories = new UsersRepositories;
            $auth = $repositories->getUser( Hashids::encode ( Auth::user()->id ) );
            $ranks = $repositories->AgentRanks();
            $agents = $repositories->Recruiters();
            $recruiter = null;
            $users = null;
            $content = null;
            $self = null;


            if( Auth::user()->id == Hashids::decode( $request->id )[0] ){

                    $user = $repositories->getUser( $request->id );
                    $master = new MasterRepositories;
                    $downlines = $master->getDownlines( $request->id ) ;

                    $user = $repositories->getUser( $request->id );

                    if( !empty( $user->recruiter) ) {  
                        $recruiter = $repositories->getRecruiter( $user->recruiter  );
                    }
                    
                    $self = view('dashboard.users.forms.update')->with(compact('user', 'auth', 'ranks', 'agents', 'recruiter'))->render();


            }

            $success = "Profiel picture Successfuly changed.";
            $user = $repositories->getUser( $request->id );

            if( !empty( $user->recruiter) ) {  
                $recruiter = $repositories->getRecruiter( $user->recruiter  );
            }
            

            $overlay = view('dashboard.users.forms.update')->with(compact('user', 'auth', 'ranks', 'agents', 'recruiter'))->render();

            return response()->json(['content' => $content, 'success' => $success, 'overlay' => $overlay, 'self' => $self ]);


        }else{

            $error = "No photo selected.";
            return response()->json(['error' => $error ]);
        }






    }













   public function getAgentNames()
    {   


       $repositories = new UsersRepositories;
       $agents = $repositories->getAgentNames();
       return response()->json( $agents );

       

    }










    public function uploadAvatar($id){

        $data = request()->avatar;

        //generating unique file name;
        $file_name = 'photo_'.time().'.png';
        $file_name_thumb = 'thumb_'.time().'.png';
        @list($type, $data) = explode(';', $data);
        @list(, $data)      = explode(',', $data);


        $destinationPath = '/public/users/'.$id.'/';

        if( Storage::exists( $destinationPath ) ) Storage::deleteDirectory( $destinationPath );

        if($data!=""){

        $thumb = Image::make( base64_decode($data)  )->resize(250, 250);
        $image = Image::make( base64_decode($data)  )->resize(600, 600);

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
