<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UsersRepositories;
use App\Http\Requests\AddDeveloperForm;
use App\Repositories\DevelopersRepositories;
use Auth;
use Validator;
use App\Developer;
use App\Project;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Support\Facades\File;
use Image;
use Storage;

class DeveloperController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    } 

    
    public function developers( Request $request)
    {     

      $repositories = new UsersRepositories;
      $developer_repo = new DevelopersRepositories;
      $developers = $developer_repo->getAllDevelopers();
      $auth = $repositories->getUser( Hashids::encode ( Auth::user()->id ) );


      if( $request->ajax() ){

          $content = view('dashboard.developers.partials.developers')->with(compact('developers'))->render();
          return response()->json(['content'=> $content ]);
      }

      $content = view('dashboard.developers.partials.developers')->with(compact('auth','developers'))->render();
      return view('dashboard.developers.developers', compact('auth' ,'content'));


    }






    public function addDeveloperShowForm(Request $request)
    {  
        $repositories = new UsersRepositories;
        $auth = $repositories->getUser( Hashids::encode ( Auth::user()->id ) );

        if( $request->ajax() ){

            $content  = view('dashboard.developers.forms.add')->render();
            return response()->json(['content'=> $content]);
        }

        
        $content  = view('dashboard.developers.forms.add')->render();
        
        return view('dashboard.developers.developers', compact( 'content','auth' ));
    }




     /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateDeveloperShowForm(Request $request)
    {  

      
      $developer_repo = new DevelopersRepositories;
      $developer = $developer_repo->getDeveloper( $request->id );

      $view = view('dashboard.developers.forms.update')->with(compact('developer'))->render();

      return response()->json(['content'=> $view ]);


    }




    public function validateBasicInformation( Request $request )
    {

        $validator = Validator::make( $request->all(), [

            'name' => 'required|min:6|unique:developers',
            'contact' => 'required|min:6|unique:developers',
            'fax' => 'nullable|min:6|unique:developers',
            'address' => 'required|min:6',

        ]);

        if($validator->passes()) {
            return response()->json(['success' => 'success']);
        }
        else
        {
            return response()->json(['error'=>$validator->getMessageBag()->toArray()]);
        }



    }










    public function getDeveloper( Request $request)
    {     

      $developer_repo = new DevelopersRepositories;

      $developer = $developer_repo->getDeveloper( $request->id );

      return response()->json( $developer );

    }


     /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function developerProfile(Request $request)
    {  

        if($request->ajax()){

            $repositories = new DevelopersRepositories;
            $developer = $repositories->getDeveloper( $request->id );
            $developer_projects = $repositories->getAllProjectsByDeveloper( $developer->id );

            $view = view('dashboard.developers.profile')->with(compact('developer', 'developer_projects'))->render();

            return response()->json(['content'=> $view ]);

        }



    }





    public function addDeveloper( Request $request )
    { 

      $validator = Validator::make($request->all(), [

            'name' => 'required|min:6|unique:developers',
            'contact' => 'required|min:6|unique:developers',
            'fax' => 'nullable|min:6|unique:developers',
            'address' => 'required|min:6',
            'profile' => 'nullable',

      ]);


      if ($validator->passes()) {

          $developer = new Developer();
          $developer->name = $request->name;
          $developer->contact = $request->contact;
          $developer->fax = $request->fax;
          $developer->address = $request->address;
          $developer->profile = $request->profile;
          $developer->save();

          if( !empty($request->avatar) ){


            $path = $this->uploadAvatar( Hashids::encode ( $developer->id ), $request->avatar );
            $developer->logo = $path;
            $developer->save();

          }else{

              $developer->logo = '/storage/developers/default.png';
              $developer->save();

          }


            $developer_repo = new DevelopersRepositories;
            $developers = $developer_repo->getAllDevelopers();

            $success = "Successfully added new Developer.";
            $content = view('dashboard.developers.partials.developers')->with(compact('developers'))->render();
            return response()->json(['content'=> $content , 'success' => $success ]);

   

      }else{


          return response()->json(['error'=>$validator->getMessageBag()->toArray()]);


      }
  }







  public function uploadAvatar($id,$data){

        //generating unique file name;
        $file_name = 'logo_'.time().'.png';
        @list($type, $data) = explode(';', $data);
        @list(, $data)      = explode(',', $data);


        $destinationPath = '/public/developers/'.$id.'/';

        if( Storage::exists( $destinationPath ) ) Storage::deleteDirectory( $destinationPath );

        if($data!=""){

          $logo = Image::make( base64_decode($data)  )->resize(150, 150);

          Storage::disk('local')->put( $destinationPath . $file_name,  $logo->stream());

        }

        return '/storage/developers/'.$id.'/' .$file_name;

  }


    




  
    public function updateDeveloperInformation( Request $request )
    { 


      $validator = Validator::make($request->all(), [

            'name' => 'required|min:6|unique:developers,name,' . Hashids::decode( $request->id )[0] ,
            'contact' => 'required|min:6|unique:developers,contact,' . Hashids::decode( $request->id )[0] ,
            'fax' => 'nullable|min:6|unique:developers,fax,' . Hashids::decode( $request->id )[0] ,
            'address' => 'required|min:6',

      ]);

      if ($validator->passes()) {

          $developer = Developer::where( 'id', Hashids::decode ( $request->id )[0] )->first();
          $developer->name = $request->name;
          $developer->contact = $request->contact;
          $developer->fax = $request->fax;
          $developer->address = $request->address;
          $developer->update();

          $developer_repo = new DevelopersRepositories;
          $developers = $developer_repo->getAllDevelopers();
          $developer = $developer_repo->getDeveloper( $request->id );

          $success = "Successfully updated developer information.";
          $content = view('dashboard.developers.partials.developers')->with(compact('developers'))->render();
          $overlay = view('dashboard.developers.forms.update')->with(compact('developer'))->render();

          return response()->json(['content'=> $content , 'success' => $success, 'overlay' => $overlay ]);

      }else{

          return response()->json(['error'=>$validator->getMessageBag()->toArray()]);

      }

    }



    public function updateDeveloperProfile( Request $request )
    { 

          $developer = Developer::where( 'id', Hashids::decode ( $request->id )[0] )->first();
          $developer->profile = $request->profile;
          $developer->update();

          $developer_repo = new DevelopersRepositories;
          $developers = $developer_repo->getAllDevelopers();
          $developer = $developer_repo->getDeveloper( $request->id );

          $success = "Successfully updated developer profile.";
          $overlay = view('dashboard.developers.forms.update')->with(compact('developer'))->render();

          return response()->json([ 'success' => $success, 'overlay' => $overlay ]);


    }




    public function updateDeveloperLogo( Request $request )
    { 

          $developer = Developer::where( 'id', Hashids::decode ( $request->id )[0] )->first();

          if( !empty($request->avatar) ){

            $path = $this->uploadAvatar($developer->id, $request->avatar );
            $developer->logo = $path;
            $developer->update();

          }

          $developer_repo = new DevelopersRepositories;
          $developers = $developer_repo->getAllDevelopers();
          $developer = $developer_repo->getDeveloper( $request->id );

          $success = "Successfully updated developer logo.";
          $overlay = view('dashboard.developers.forms.update')->with(compact('developer'))->render();

          return response()->json(['success' => $success, 'overlay' => $overlay ]);



    }











   public function SetToNotActive( Request $request )
    { 

          $developer = Developer::find( Hashids::decode ( $request->id )[0] );
          $developer->active = 0;
          $developer->save();

          $developer_repo = new DevelopersRepositories;
          $developers = $developer_repo->getAllDevelopers();
          $developer = $developer_repo->getDeveloper( $request->id );

          $success = "Developer set to not active.";
          $content = view('dashboard.developers.partials.developers')->with(compact('developers'))->render();
          $overlay = view('dashboard.developers.forms.update')->with(compact('developer'))->render();

          return response()->json(['content'=> $content , 'success' => $success, 'overlay' => $overlay ]);


    }


   public function SetToActive( Request $request )
    { 

          $developer = Developer::find( Hashids::decode ( $request->id )[0] );
          $developer->active = 1;
          $developer->save();


          $developer_repo = new DevelopersRepositories;
          $developers = $developer_repo->getAllDevelopers();
          $developer = $developer_repo->getDeveloper( $request->id );

          $success = "Developer set to active.";
          $content = view('dashboard.developers.partials.developers')->with(compact('developers'))->render();
          $overlay = view('dashboard.developers.forms.update')->with(compact('developer'))->render();

          return response()->json(['content'=> $content , 'success' => $success, 'overlay' => $overlay ]);


    }

    




}
