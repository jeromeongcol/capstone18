<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use App\Repositories\UsersRepositories;
use App\Repositories\DevelopersRepositories;
use App\Repositories\MasterRepositories;
use App\Repositories\SalesRepositories;
use Vinkla\Hashids\Facades\Hashids;
use Image;
use Storage;
use App\Avatar;
use Validator;
use DB;
use Carbon\Carbon;
use App\Event;

class AgentController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    } 

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {  
        $repositories = new UsersRepositories;
        $auth = $repositories->getUser( Hashids::encode ( Auth::user()->id ) );
        $developer_repo = new DevelopersRepositories;
        $projects = $developer_repo->getTop9Project_Latest();

        return view('portal.index',compact( 'auth','projects' ));
    }




    public function treeview( Request $request  )
    {     

      $repositories = new UsersRepositories;
      $auth = $repositories->getUser( Hashids::encode ( Auth::user()->id ) );
      $events = Event::all();

      $treeview = $repositories->treeview();

      if( $request->ajax() ){

          $content = view('dashboard.treeview.partials.treeview')->with(compact('auth','events'))->render();
          return response()->json(['content'=> $content ]);
      }


      $content = view('dashboard.treeview.partials.treeview')->with(compact('auth','events'))->render();
      return view('dashboard.treeview.index', compact('auth' ,'content'));


    }





     /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {  
        $repositories = new UsersRepositories;
        $master = new MasterRepositories;
        $auth = $repositories->getUser( Hashids::encode ( Auth::user()->id ) );
        $profile = $repositories->getUser( Hashids::encode ( Auth::user()->id )  );
        $downlines = $master->getDownlines( Hashids::encode ( Auth::user()->id ) ) ;
        $sales = $master->getAgentSales( Hashids::encode ( Auth::user()->id ) ) ;

        $content = view('portal.partials.profile-content')->with(compact('auth', 'profile' ,'downlines'))->render();

        return view('portal.profile',compact( 'auth', 'content'));
    }


     /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function down_profile( $id )
    {  
        $repositories = new UsersRepositories;
        $master = new MasterRepositories;
        $auth = $repositories->getUser( Hashids::encode ( Auth::user()->id ) );
        $profile = $repositories->getUser( $id  );
        $downlines = $master->getDownlines( $id ) ;

        $content = view('portal.partials.profile-content')->with(compact('auth', 'profile' ,'downlines'))->render();

        return view('portal.profile',compact( 'auth', 'content'));
    }




     /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function sales( Request $request)
    {  
        $repositories = new UsersRepositories;
        $auth = $repositories->getUser( Hashids::encode ( Auth::user()->id ) );
        $sales_repositories = new SalesRepositories;

        if ( $request->ajax() ) {

            if( !empty($request->key)){

               $sales = $sales_repositories->searchAgentSales( auth()->user()->id , $request->key );
               $key = $request->key;
               $content = view('portal.partials.sales-content')->with(compact('sales','key'))->render();


               return response()->json(['content'=> $content ]);

            }

            if( !empty($request->year)){

                $months = $this->getSalesInMonthsPerYear( $request->year );

                if( $request->year == "ALL" && $request->month == "ALL"){

                   $sales = $sales_repositories->getAgentSales( auth()->user()->id );
                   $content = view('portal.partials.sales-content')->with(compact('sales','key'))->render();
                   $monthsyear = view('portal.partials.filters.monthsInYear')->with(compact('months'))->render();

                   return response()->json(['content'=> $content, 'months' => $monthsyear ]);

                }else if( $request->year == "ALL" && $request->month != "ALL"){

                   $sales = $sales_repositories->getAgentSalesByMonth( auth()->user()->id, $request->month );
                   $content = view('portal.partials.sales-content')->with(compact('sales','key'))->render();
                   $monthsyear = view('portal.partials.filters.monthsInYear')->with(compact('months'))->render();

                   return response()->json(['content'=> $content, 'months' => $monthsyear ]);

                }else if( $request->year != "ALL" && $request->month == "ALL"){

                   $sales = $sales_repositories->getAgentSalesByYear( auth()->user()->id, $request->year );
                   $content = view('portal.partials.sales-content')->with(compact('sales','key'))->render();
                   $monthsyear = view('portal.partials.filters.monthsInYear')->with(compact('months'))->render();

                   return response()->json(['content'=> $content, 'months' => $monthsyear ]);

                }else{


                   $sales = $sales_repositories->getAgentSalesByYearMonth( auth()->user()->id , $request->year, $request->month );
                   $content = view('portal.partials.sales-content')->with(compact('sales','key'))->render();
                   $monthsyear = view('portal.partials.filters.monthsInYear')->with(compact('months'))->render();

                   return response()->json(['content'=> $content, 'months' => $monthsyear ]);
                }

            }

           





        }


        $years = DB::table('sales')
            ->select( DB::raw('YEAR(sales.date_reserve) as year') )
            ->join('transactions', 'transactions.id', '=', 'sales.transaction_id')
            ->where('transactions.agent_id', auth()->user()->id )
            ->where('sales.approved', 1)
            ->where('sales.cancelled', 0)
            ->distinct( DB::raw('YEAR(date_reserve)') )
            ->orderBy( 'year', 'DESC')
            ->get();

        $years = collect($years);
        $years = $years->pluck('year');


        $months = DB::table('sales')
            ->select( DB::raw('MONTH(sales.date_reserve) as month') )
            ->join('transactions', 'transactions.id', '=', 'sales.transaction_id')
            ->where('transactions.agent_id', auth()->user()->id )
            ->where('sales.approved', 1)
            ->where('sales.cancelled', 0)
            ->distinct( DB::raw('MONTH(date_reserve)') )
            ->orderBy( 'month', 'DESC')
            ->get();

        $months = collect($months);
        $months = $months->pluck('month');


        $sales = $sales_repositories->getAgentSales( auth()->user()->id );
        return view('portal.sales',compact( 'auth','years', 'months', 'sales', 'key'));
    }






    public function getSalesInMonthsPerYear( $years ){
        
        if( $years == "ALL"){

            $months = DB::table('sales')
            ->select( DB::raw('MONTH(sales.date_reserve) as month') )
            ->join('transactions', 'transactions.id', '=', 'sales.transaction_id')
            ->where('transactions.agent_id', auth()->user()->id )
            ->where('sales.approved', 1)
            ->where('sales.cancelled', 0)
            ->distinct( DB::raw('MONTH(date_reserve)') )
            ->orderBy( 'month', 'DESC')
            ->get();
            
            $months = collect($months);
            $months = $months->pluck('month');


            return $months;

        }else{

            $months = DB::table('sales')
                ->select( DB::raw('MONTH(sales.date_reserve) as month') )
                ->join('transactions', 'transactions.id', '=', 'sales.transaction_id')
                ->where('transactions.agent_id', auth()->user()->id )
                ->where('sales.approved', 1)
                ->where('sales.cancelled', 0)
                ->where( DB::raw('YEAR(date_reserve)'), $years)
                ->distinct( DB::raw('MONTH(date_reserve)') )
                ->orderBy( 'month', 'DESC')
                ->get();

            $months = collect($months);
            $months = $months->pluck('month');

            return $months;
        }



    }



     /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function salesInfo( Request $request )
    {  
        $sales_repositories = new SalesRepositories;
        $sales = $sales_repositories->getSalesWillProjectDetails( $request->id );

        $view = view('portal.partials.sales-info')->with(compact('sales'))->render();

        return response()->json(['content'=> $view ]);

    }









     /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateProfile( Request $request )
    {  
        $repositories = new UsersRepositories;
        $agent = $repositories->getUser( $request->id  );

        return response()->json( $agent );
    }

 


     /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function projects(Request $request)
    {  

        $repositories = new UsersRepositories;
        $developer_repo = new DevelopersRepositories;
        $project_types = $developer_repo->getAllProjectTypes();
        $auth = $repositories->getUser( Hashids::encode ( Auth::user()->id ) );


        if ( $request->ajax() ) {

            if(  $request->action == "filter" ){

                if( $request->key == "ALL"){
                    
                    $projects = $developer_repo->getAllActiveProjectsForAgent();
                    $key = "ALL PROJECTS";

                    $content = view('portal.partials.search-project')->with(compact('projects','auth', 'key'))->render();

                    return response()->json(['content'=> $content ]);   

                }else{

                    $projects = $developer_repo->getAllActiveProjectsByProjectCategory( $request->id );
                    $key = $request->key;

                    $content = view('portal.partials.search-project')->with(compact('projects','auth', 'key'))->render();

                    return response()->json(['content'=> $content ]);

                }

                 


            }else if(  $request->action == "search" ){
                
                $projects = $developer_repo->searchProjectForAgent( $request->key );
                $key = $request->key;
                $content = view('portal.partials.search-project')->with(compact('projects','auth', 'key'))->render();

                return response()->json(['content'=> $content ]);

            } 



        }


        $projects  = $developer_repo->getAllActiveProjectsForAgent();
        $key = "ALL";
        return view('portal.projects',compact( 'projects', 'auth' , 'project_types','key'));

    }



     /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function viewProject(Request $request)
    {  
        $repositories = new UsersRepositories;
        $dev_repositories = new DevelopersRepositories;
        $auth = $repositories->getUser( Hashids::encode ( Auth::user()->id ) );
        $project  = $dev_repositories->viewProject( $request->id );
        $project_photos = $dev_repositories->getAllProjectPhotos( $request->id );


        return view('portal.view-project',compact( 'project', 'project_photos', 'auth' ));
    }



    public function searchProject( Request $request )
    {     

      $developer_repo = new DevelopersRepositories;
      $repositories = new UsersRepositories;
      $projects = $developer_repo->searchProject( $request->key );
      $auth = $repositories->getUser( Hashids::encode ( Auth::user()->id ) );
      $key = $request->key;

      $content = view('portal.partials.search-project')->with(compact('projects','auth', 'key'))->render();

      return response()->json(['content'=> $content ]);
    }



    public function filterProject( Request $request )
    {     

      $developer_repo = new DevelopersRepositories;
      $repositories = new UsersRepositories;
      $projects = $developer_repo->getAllActiveProjectsByProjectCategory( $request->id );
      $auth = $repositories->getUser( Hashids::encode ( Auth::user()->id ) );
      $key = $request->key;


      $content = view('portal.partials.search-project')->with(compact('projects','auth', 'key'))->render();

      return response()->json(['content'=> $content ]);
    }





    public function changeProfilePicture( Request $request )
    {     

        if( !empty( $request->avatar ) ){

            $path = $this->uploadAvatar( $request->id );

            $avatar = Avatar::where('user_id', Hashids::decode( $request->id )[0] )->first();
            $avatar->photo =  $path[0];
            $avatar->photo_thumb = $path[1];

            $avatar->save();


            $repositories = new UsersRepositories;
            $master = new MasterRepositories;
            $auth = $repositories->getUser( Hashids::encode ( Auth::user()->id ) );
            $profile = $repositories->getUser( Hashids::encode ( Auth::user()->id )  );
            $downlines = $master->getDownlines( Hashids::encode ( Auth::user()->id ) ) ;

        
            $content = view('portal.partials.profile-content')->with(compact('auth', 'profile' ,'downlines'))->render();
            $header = view('layouts-agent.header')->with(compact('auth'))->render();

            return response()->json(['content' => $content, 'success' => "Successfully changed profile picture." , 'header' => $header]);


        }else{

            $error = "No photo selected.";
            return response()->json(['error' => $error ]);
        }

    }




    public function changePassword( Request $request )
    {     


        $validator = Validator::make( $request->all(), [

          'password' => 'required|string|min:6|confirmed',
          'password_confirmation' => 'required|min:6',

      ]);

      if ($validator->passes()) {

        $user = User::where('id', Hashids::decode( $request->id )[0] )->first();
        $user->password = bcrypt( $request->password ); 
        $user->update();

      
        return response()->json(['success' => "Successfully changed password."]);

      }else{

         return response()->json(['error'=>$validator->getMessageBag()->toArray()]);

      }



    }






    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function events(Request $request)
    {  
        $repositories = new UsersRepositories;
        $auth = $repositories->getUser( Hashids::encode ( Auth::user()->id ) );

        $events = DB::table('events')
          ->where('events.status', 'upcoming')
          ->orwhere('events.status', 'ongoing')
          ->get();

        $ongoing = Event::where('status','ongoing')->get();

        return view('portal.events',compact( 'auth','events', 'ongoing' ));
    }





    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function getEvent(Request $request)
    {  

       $repositories = new UsersRepositories;
       $event = Event::where( 'id', $request->id )->first();
 
       $view = view('portal.partials.events-info')->with(compact('event'))->render();

       return response()->json(['content'=> $view ]);
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
