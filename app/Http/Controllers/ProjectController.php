<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UsersRepositories;
use App\Repositories\DevelopersRepositories;
use Auth;
use Validator;
use App\Developer;
use App\Project;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Support\Facades\File;
use Image;
use App\ProjectPhoto;
use Storage;
use App\ProjectType;



class ProjectController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    } 



    public function projects( Request $request)
    {     

      $repositories = new UsersRepositories;
      $developer_repo = new DevelopersRepositories;
      $projects = $developer_repo->getAllProjects();
      $auth = $repositories->getUser( Hashids::encode ( Auth::user()->id ) );


      if( $request->ajax() ){

          $content = view('dashboard.projects.partials.projects')->with(compact('projects'))->render();
          return response()->json(['content'=> $content ]);
      }

      $content = view('dashboard.projects.partials.projects')->with(compact('auth','projects'))->render();
      return view('dashboard.projects.projects', compact('auth' ,'content'));


    }



    public function projectsGrid( Request $request)
    {     

      $repositories = new UsersRepositories;
      $developer_repo = new DevelopersRepositories;
      $projects = $developer_repo->getAllProjects();
      $auth = $repositories->getUser( Hashids::encode ( Auth::user()->id ) );


      if( $request->ajax() ){

          $content = view('dashboard.projects.partials.project-gridview')->with(compact('projects','auth'))->render();
          return response()->json(['content'=> $content ]);
      }

      $content = view('dashboard.projects.partials.project-gridview')->with(compact('auth','projects'))->render();
      return view('dashboard.projects.projects', compact('auth' ,'content'));


    }



    public function searchProject( Request $request )
    {     

      $developer_repo = new DevelopersRepositories;
      $repositories = new UsersRepositories;
      $projects = $developer_repo->searchProject( $request->key );
      $auth = $repositories->getUser( Hashids::encode ( Auth::user()->id ) );
      $key = $request->key;

       $content = view('dashboard.projects.partials.project-gridview')->with(compact('projects','auth', 'key'))->render();

      return response()->json(['content'=> $content ]);
    }






    public function addProjectShowForm(Request $request)
    {  
        $repositories = new UsersRepositories;
        $auth = $repositories->getUser( Hashids::encode ( Auth::user()->id ) );
        
        $developer_repo = new DevelopersRepositories;
        $developers = $developer_repo->getAllActiveDevelopers();
        $categories = $developer_repo->getAllProjectTypes();

        if( $request->ajax() ){

            $content  = view('dashboard.projects.forms.add')->with(compact('developers','categories'))->render();
            return response()->json(['content'=> $content]);
        }

        
        $content  = view('dashboard.projects.forms.add')->with(compact('developers','categories'))->render();
        
        return view('dashboard.projects.projects', compact( 'content','auth' ));
    }





    public function validateProjectDetails( Request $request )
    {

        $validator = Validator::make( $request->all(), [

            'project_name' => 'required|min:6',
            'project_location' => 'required|min:6',

        ]);

        if($validator->passes()) {
            return response()->json(['success' => 'success']);
        }
        else
        {
            return response()->json(['error'=>$validator->getMessageBag()->toArray()]);
        }



    }










    public function viewProject( Request $request )
    {     

      $developer_repo = new DevelopersRepositories;

      $project = $developer_repo->viewProject( $request->id );
      $project_photos = $developer_repo->getAllProjectPhotos( $request->id );

      $view = view('dashboard.projects.project-info')->with(compact('project','project_photos'))->render();

      return response()->json(['content'=> $view ]);


    }




    public function viewProjectPhoto( Request $request )
    {    

      $projectPhoto = ProjectPhoto::where('id', Hashids::decode( $request->id )[0] )->first();
      $projectPhoto->id = Hashids::encode( $projectPhoto->id );
      return response()->json( $projectPhoto );


    }






    public function updateProject( Request $request )
    {     



      $validator = Validator::make($request->all(), [

            'project_name' => 'required|min:6|unique:projects,project_name,' .  Hashids::decode( $request->id )[0],
            'project_location'  => 'required|max:200', 
            'project_price'  => 'required|numeric',

      ]);


      if ($validator->passes()) {

          $project = Project::find( Hashids::decode ( $request->id )[0] );
          $project->project_name = $request->project_name;
          $project->project_location = $request->project_location;
          $project->project_price = $request->project_price;
          $project->project_type_id = Hashids::decode( $request->project_type )[0];
          $project->project_description = $request->project_description;
          $project->developer_id = Hashids::decode( $request->developer )[0];
          $project->amenities_bed = $request->amenities_bed;
          $project->amenities_bath = $request->amenities_bath;
          $project->amenities_floor_sqm = $request->amenities_floor_sqm;
          $project->amenities_land_sqm = $request->amenities_land_sqm;
          $project->amenities_garage = $request->amenities_garage;
          $project->phase_number = $request->phase_number;
          $project->block_number = $request->block_number;
          $project->lot_number = $request->lot_number;
          $project->added_by = Auth::user()->id ;


          $project->update();



       if($request->hasFile('featured_photo')){

           $path = $this->uploadProjectFeaturedPhoto( Hashids::encode ( $project->id ), $request->file('featured_photo') );

                $project->featured_photo = $path;
                $project->update();

        }

          $photos = $request->file('project_photos');

          if( !empty( $photos )){

              $ctr = 1;
              
              $destinationPath = '/public/projects/'.$project->id.'/sub/';
              if( Storage::exists( $destinationPath ) ) Storage::deleteDirectory( $destinationPath );
              $photos_to_delete = ProjectPhoto::where('project_id', $project->id )->delete();

              foreach( $photos as $photo ) {

                $path = $this->uploadProjectPhoto( $project->id , $ctr , $photo );
                $photo = new ProjectPhoto();
                $photo->photo = $path;
                $photo->project_id = $project->id;
                $photo->save();

                $ctr++;

              }

          }

          $developer_repo = new DevelopersRepositories;
          $projects = $developer_repo->getAllProjects();

          $search_result = "";

          $view = view('developer.partials.list-projects', compact('projects', 'search_result'))->render();

          return response()->json(['success'=>'Successfully Updated a record.', 'content'=> $view ]);


      }else{

       return response()->json(['error'=>$validator->getMessageBag()->toArray()]);
      
      }


    }






    public function addProject( Request $request )
    {     
      $validator = Validator::make($request->all(), [

            'project_name' => 'required|min:6',
            'project_location'  => 'required|max:200|min:6', 

      ]);



      if ($validator->passes()) {

          $project = new Project();
          $project->project_name = $request->project_name;
          $project->project_location = $request->project_location;
          $project->project_type_id = Hashids::decode( $request->project_category )[0];
          $project->project_description = $request->project_description;
          $project->developer_id = Hashids::decode( $request->developer )[0];
          $project->added_by = Auth::user()->id ;

          $project->save();

        if( !empty($request->featured_photo) ){

            $path = $this->uploadProjectFeaturedPhoto( Hashids::encode ( $project->id ), $request->featured_photo );

            $project->featured_photo = $path;
            $project->save();

        }else{

            $project->featured_photo = "/storage/projects/default.png";
            $project->save();

        }

          $photos = $request->file('project_photos');

          if( !empty( $photos )){

            $ctr = 1;

            foreach( $photos as $photo ) {

              $path = $this->uploadProjectPhoto( Hashids::encode ( $project->id) , $ctr , $photo );
              $photo = new ProjectPhoto();
              $photo->photo = $path;
              $photo->project_id = $project->id;
              $photo->save();

              $ctr++;

            }

        }

          $developer_repo = new DevelopersRepositories;
          $projects = $developer_repo->getAllProjects();
          $success = "Successfully added new project.";
          $content = view('dashboard.projects.partials.projects')->with(compact('projects'))->render();
          return response()->json(['content'=> $content, 'success' => $success ]);



      }else{

       return response()->json(['error'=>$validator->getMessageBag()->toArray()]);
      
      }


    }










  public function SetToNotActive( Request $request ){

      $project = Project::where( 'id', Hashids::decode ( $request->id )[0] )->first();
      $project->deleted = 1;
      $project->save();


      $developer_repo = new DevelopersRepositories;
      $project = $developer_repo->viewProject( $request->id );
      $projects = $developer_repo->getAllProjects();
      $developers = $developer_repo->getAllActiveDevelopers();
      $categories = $developer_repo->getAllProjectTypes();
      $project_types = $developer_repo->getAllProjectTypes();
      $project_photos = $developer_repo->getAllProjectPhotos( $request->id );

      $success = "Project set to not active.";
      $content = view('dashboard.projects.partials.projects')->with(compact('projects'))->render();
      $overlay = view('dashboard.projects.forms.update')->with(compact('project', 'developers', 'project_types', 'categories', 'project_photos'))->render();

      return response()->json(['content'=> $content , 'success' => $success, 'overlay' => $overlay ]);


  }





  public function SetToActive( Request $request ){

      $project = Project::where( 'id', Hashids::decode ( $request->id )[0] )->first();
      $project->deleted = 0;
      $project->save();


      $developer_repo = new DevelopersRepositories;
      $project = $developer_repo->viewProject( $request->id );
      $projects = $developer_repo->getAllProjects();
      $developers = $developer_repo->getAllActiveDevelopers();
      $categories = $developer_repo->getAllProjectTypes();
      $project_types = $developer_repo->getAllProjectTypes();
      $project_photos = $developer_repo->getAllProjectPhotos( $request->id );

      $success = "Project set to active.";
      $content = view('dashboard.projects.partials.projects')->with(compact('projects'))->render();
      $overlay = view('dashboard.projects.forms.update')->with(compact('project', 'developers', 'project_types', 'categories', 'project_photos'))->render();

      return response()->json(['content'=> $content , 'success' => $success, 'overlay' => $overlay ]);

  }






     /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateProjectShowForm(Request $request)
    {  

      
      $developer_repo = new DevelopersRepositories;
      $project = $developer_repo->viewProject( $request->id );
      $projects = $developer_repo->getAllProjects();
      $developers = $developer_repo->getAllActiveDevelopers();
      $categories = $developer_repo->getAllProjectTypes();
      $project_types = $developer_repo->getAllProjectTypes();
      $project_photos = $developer_repo->getAllProjectPhotos( $request->id );


      $view = view('dashboard.projects.forms.update')->with(compact('project', 'developers', 'project_types', 'categories', 'project_photos'))->render();

      return response()->json(['content'=> $view ]);


    }




    public function uploadProjectFeaturedPhoto($id,$photo){

         ini_set('memory_limit','256M');


        //generating unique file name;
        $file_name = 'logo_'.time().'.png';
        @list($type, $photo) = explode(';', $photo);
        @list(, $photo)      = explode(',', $photo);


        $destinationPath = '/public/projects/'.$id.'/featured/';

        if( Storage::exists( $destinationPath ) ) Storage::deleteDirectory( $destinationPath );

        if($photo!=""){

          $img = Image::make($photo)->fit(1000, 800, function ($constraint) {
                  $constraint->aspectRatio();
                });

          Storage::disk('local')->put( $destinationPath . $file_name,  $img->stream());

        }

        return '/storage/projects/'.$id.'/featured/' .$file_name;
        

    }








    public function uploadProjectPhoto($id,$ctr,$photo){

        ini_set('memory_limit','256M');

        $file_name = 'project_photo_'. $ctr ."_". time() . ".png";  

        $destinationPath = '/public/projects/'.$id.'/sub/';


        if( $photo!="" ){

          $img = Image::make($photo)->fit(1000, 800, function ($constraint) {
                  $constraint->upsize();
                });

          Storage::put( $destinationPath . $file_name, $img->stream() );

        }

        return '/storage/projects/'.$id. '/sub/' .$file_name;


    }







    public function updateProjectInformation( Request $request )
    { 


      $validator = Validator::make($request->all(), [

            'project_name' => 'required|min:6',
            'project_location'  => 'required|max:200|min:6', 

      ]);


      if ($validator->passes()) {

          $project = Project::where( 'id', Hashids::decode ( $request->id )[0] )->first();
          $project->project_name = $request->project_name;
          $project->project_location = $request->project_location;
          $project->update();


          $developer_repo = new DevelopersRepositories;
          $project = $developer_repo->viewProject( $request->id );
          $projects = $developer_repo->getAllProjects();
          $developers = $developer_repo->getAllActiveDevelopers();
          $categories = $developer_repo->getAllProjectTypes();
          $project_types = $developer_repo->getAllProjectTypes();
          $project_photos = $developer_repo->getAllProjectPhotos( $request->id );

          $success = "Successfully updated project information.";
          $content = view('dashboard.projects.partials.projects')->with(compact('projects'))->render();
          $overlay = view('dashboard.projects.forms.update')->with(compact('project', 'developers', 'project_types', 'categories', 'project_photos'))->render();

          return response()->json(['content'=> $content , 'success' => $success, 'overlay' => $overlay ]);

      }else{

          return response()->json(['error'=>$validator->getMessageBag()->toArray()]);

      }

    }







  public function updateProjectDeveloper( Request $request ){

      $project = Project::where( 'id', Hashids::decode ( $request->id )[0] )->first();
      $project->developer_id = Hashids::decode( $request->developer )[0];
      $project->save();

      $developer_repo = new DevelopersRepositories;
      $project = $developer_repo->viewProject( $request->id );
      $projects = $developer_repo->getAllProjects();
      $developers = $developer_repo->getAllActiveDevelopers();
      $categories = $developer_repo->getAllProjectTypes();
      $project_types = $developer_repo->getAllProjectTypes();
      $project_photos = $developer_repo->getAllProjectPhotos( $request->id );

      $success = "Successfully updated project developer.";
      $content = view('dashboard.projects.partials.projects')->with(compact('projects'))->render();
      $overlay = view('dashboard.projects.forms.update')->with(compact('project', 'developers', 'project_types', 'categories', 'project_photos'))->render();

      return response()->json(['content'=> $content , 'success' => $success, 'overlay' => $overlay ]);

  }



  public function updateProjectCategory( Request $request ){

      $project = Project::where( 'id', Hashids::decode ( $request->id )[0] )->first();
      $project->project_type_id = Hashids::decode( $request->project_category )[0];
      $project->save();

      $developer_repo = new DevelopersRepositories;
      $project = $developer_repo->viewProject( $request->id );
      $projects = $developer_repo->getAllProjects();
      $developers = $developer_repo->getAllActiveDevelopers();
      $categories = $developer_repo->getAllProjectTypes();
      $project_types = $developer_repo->getAllProjectTypes();
      $project_photos = $developer_repo->getAllProjectPhotos( $request->id );

      $success = "Successfully updated project category.";
      $content = view('dashboard.projects.partials.projects')->with(compact('projects'))->render();
      $overlay = view('dashboard.projects.forms.update')->with(compact('project', 'developers', 'project_types', 'categories', 'project_photos'))->render();

      return response()->json(['content'=> $content , 'success' => $success, 'overlay' => $overlay ]);

  }



  public function updateProjectDescription( Request $request ){

      $project = Project::where( 'id', Hashids::decode ( $request->id )[0] )->first();
      $project->project_description = $request->project_description;
      $project->save();

      $developer_repo = new DevelopersRepositories;
      $project = $developer_repo->viewProject( $request->id );
      $projects = $developer_repo->getAllProjects();
      $developers = $developer_repo->getAllActiveDevelopers();
      $categories = $developer_repo->getAllProjectTypes();
      $project_types = $developer_repo->getAllProjectTypes();
      $project_photos = $developer_repo->getAllProjectPhotos( $request->id );

      $success = "Successfully updated project category.";
      $content = view('dashboard.projects.partials.projects')->with(compact('projects'))->render();
      $overlay = view('dashboard.projects.forms.update')->with(compact('project', 'developers', 'project_types', 'categories', 'project_photos'))->render();

      return response()->json(['content'=> $content , 'success' => $success, 'overlay' => $overlay ]);

  }




  public function updateProjectFeaturedPhoto( Request $request ){


     if( !empty($request->featured_photo) ){

          $project = Project::where( 'id', Hashids::decode ( $request->id )[0] )->first();
          $path = $this->uploadProjectFeaturedPhoto( Hashids::encode ( $project->id ), $request->featured_photo );

          $project->featured_photo = $path;
          $project->save();

          $developer_repo = new DevelopersRepositories;
          $project = $developer_repo->viewProject( $request->id );
          $projects = $developer_repo->getAllProjects();
          $developers = $developer_repo->getAllActiveDevelopers();
          $categories = $developer_repo->getAllProjectTypes();
          $project_types = $developer_repo->getAllProjectTypes();
          $project_photos = $developer_repo->getAllProjectPhotos( $request->id );

          $success = "Successfully updated project featured photo.";
          $content = view('dashboard.projects.partials.projects')->with(compact('projects'))->render();
          $overlay = view('dashboard.projects.forms.update')->with(compact('project', 'developers', 'project_types', 'categories', 'project_photos'))->render();

          return response()->json(['content'=> $content , 'success' => $success, 'overlay' => $overlay ]);

      }else{

       return response()->json(['error'=>'No Photo Selected.']);
      
      }


  }


  public function updateProjectAdditionalPhotos( Request $request ){

      $photos = $request->file('project_photos');

      if( !empty( $photos )){

        $ctr = 1;

        foreach( $photos as $photo ) {

          $path = $this->uploadProjectPhoto( $request->id , $ctr , $photo );
          $photo = new ProjectPhoto();
          $photo->photo = $path;
          $photo->project_id = Hashids::decode( $request->id )[0];
          $photo->save();

          $ctr++;

        }

        $developer_repo = new DevelopersRepositories;
        $project = $developer_repo->viewProject( $request->id );
        $projects = $developer_repo->getAllProjects();
        $developers = $developer_repo->getAllActiveDevelopers();
        $categories = $developer_repo->getAllProjectTypes();
        $project_types = $developer_repo->getAllProjectTypes();
        $project_photos = $developer_repo->getAllProjectPhotos( $request->id );

        $success = "Successfully updated project featured photo.";
        $content = view('dashboard.projects.partials.projects')->with(compact('projects'))->render();
        $overlay = view('dashboard.projects.forms.update')->with(compact('project', 'developers', 'project_types', 'categories', 'project_photos'))->render();

        return response()->json(['content'=> $content , 'success' => $success, 'overlay' => $overlay ]);


    }else{

       return response()->json(['error'=>'No Photo Selected.']);
      
      }


  }







  public function deleteProjectAdditionalPhoto( Request $request ){

      $projectphoto = ProjectPhoto::where( 'id', Hashids::decode( $request->id )[0] )->first();
      $path = str_replace("/", "\\", $projectphoto->photo );

      if( Storage::exists( public_path($path)  ) ){

        unlink( public_path($path) );
      }
      

      $projectphoto->delete();

      $developer_repo = new DevelopersRepositories;
      $project = $developer_repo->viewProject( Hashids::encode($projectphoto->project_id) );
      $projects = $developer_repo->getAllProjects();
      $developers = $developer_repo->getAllActiveDevelopers();
      $categories = $developer_repo->getAllProjectTypes();
      $project_types = $developer_repo->getAllProjectTypes();
      $project_photos = $developer_repo->getAllProjectPhotos( Hashids::encode($projectphoto->project_id) );

      $success = "Successfully deleted project photo.";
      $content = view('dashboard.projects.partials.projects')->with(compact('projects'))->render();
      $overlay = view('dashboard.projects.forms.update')->with(compact('project', 'developers', 'project_types', 'categories', 'project_photos'))->render();

      return response()->json(['content'=> $content , 'success' => $success, 'overlay' => $overlay ]);

  }








    public function projectTypes(){

      $user_repo = new UsersRepositories;
      $developer_repo = new DevelopersRepositories;
      $user = $user_repo->getUser( Hashids::encode ( Auth::user()->id ) );
      $types = $developer_repo->getAllProjectTypes();
      $title = "Project Types" ;

      return view('developer.project-types', compact( 'user', 'types', 'title') );

    }




  public function addProjectType( Request $request ){

       $validator = Validator::make($request->all(), [

            'type' => 'required|min:6|unique:project_types',

      ]);


      if ($validator->passes()) {


          $projectType = new ProjectType();
          $projectType->type = $request->type;
          $projectType->deleted = 0;
          $projectType->save();

          $developer_repo = new DevelopersRepositories;
          $types = $developer_repo->getAllProjectTypes();
          $title = "Project Types" ;

          $view = view('developer.partials.list-project-types', compact('types', 'title'))->render();

          return response()->json(['success'=>'Successfully added new project type.', 'content'=> $view ]);
       }else{

       return response()->json(['error'=>$validator->getMessageBag()->toArray()]);
      
      }


  }






  public function updateProjectType( Request $request ){

       $validator = Validator::make($request->all(), [

            'type' => 'required|min:6|unique:project_types,type,' . Hashids::decode( $request->id )[0],

      ]);

      if ($validator->passes()) {


          $projectType = ProjectType::where( 'id', Hashids::decode ( $request->id )[0] )->first();
          $projectType->type = $request->type;
          $projectType->update();

          $developer_repo = new DevelopersRepositories;
          $types = $developer_repo->getAllProjectTypes();
          $title = "Project Types" ;

          $view = view('developer.partials.list-project-types', compact('types', 'title'))->render();

          return response()->json(['success'=>'Successfully updated project type.', 'content'=> $view ]);
       }else{

       return response()->json(['error'=>$validator->getMessageBag()->toArray()]);
      
      }


  }





  public function deleteProjectType( Request $request ){

          $projectType = ProjectType::where( 'id', Hashids::decode ( $request->id )[0] )->first();
          $projectType->deleted = 1;
          $projectType->update();


          $developer_repo = new DevelopersRepositories;
          $types = $developer_repo->getAllProjectTypes();
          $title = "Project Types" ;

          $view = view('developer.partials.list-project-types', compact('types', 'title'))->render();

          return response()->json(['success'=>'Successfully deleted project type.', 'content'=> $view ]);
 
   
  }



  public function undeleteProjectType( Request $request ){

          $projectType = ProjectType::where( 'id', Hashids::decode ( $request->id )[0] )->first();
          $projectType->deleted = 0;
          $projectType->update();

          $developer_repo = new DevelopersRepositories;
          $types = $developer_repo->getAllProjectTypes();
          $title = "Project Types" ;

          $view = view('developer.partials.list-project-types', compact('types', 'title'))->render();

          return response()->json(['success'=>'Successfully undeleted project type.', 'content'=> $view ]);
 
   
  }










}
