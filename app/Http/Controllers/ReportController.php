<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UsersRepositories;
use App\Repositories\SalesRepositories;
use App\Repositories\DevelopersRepositories;
use Vinkla\Hashids\Facades\Hashids;
use Auth;
use Validator;
use App\Sales;
use App\Transaction;
use App\Project;
use App\ProjectType;
use App\Person;
use App\Client;
use App\Role;
use App\AgentRanks;
use App\AgentRankTypes;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class ReportController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    } 




   /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Http\Response
   */
    public function reports(Request $request)
    {   
      $repositories = new UsersRepositories;
      $auth = $repositories->getUser( Hashids::encode ( Auth::user()->id ) );

      if( $request->ajax() ){

        $content = view('dashboard.reports.partials.sales-reports')->with(compact('auth'))->render();

          return response()->json(['content'=> $content ]);
      }

      $content = view('dashboard.reports.partials.sales-reports')->with(compact('auth'))->render();
     return view('dashboard.reports.reports', compact('auth', 'content'));
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
      $agents = $repositories->Agents();

      if( $request->ajax() ){

        $content = view('dashboard.reports.partials.agents-reports')->with(compact('auth','agents'))->render();
        return response()->json(['content'=> $content]);
      }


      $content = view('dashboard.reports.partials.agents-reports')->with(compact('auth','agents'))->render();
      return view('dashboard.reports.reports', compact('auth', 'content'));


    }


   /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Http\Response
   */
    public function developers(Request $request)
    {   
      $dev_repositories = new DevelopersRepositories;
      $repositories = new UsersRepositories;
      $auth = $repositories->getUser( Hashids::encode ( Auth::user()->id ) );
      $developers = $dev_repositories->getAllActiveDevelopers();

      if( $request->ajax() ){

        $content = view('dashboard.reports.partials.developers-reports')->with(compact('auth', 'developers'))->render();
        return response()->json(['content'=> $content]);
      }


      $content = view('dashboard.reports.partials.developers-reports')->with(compact('auth','developers'))->render();
      return view('dashboard.reports.reports', compact('auth', 'content'));


    }


   /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Http\Response
   */
    public function projects(Request $request)
    {   
      $dev_repositories = new DevelopersRepositories;
      $repositories = new UsersRepositories;
      $auth = $repositories->getUser( Hashids::encode ( Auth::user()->id ) );
      $projects = $dev_repositories->getAllProjects();


      if( $request->ajax() ){

        $content = view('dashboard.reports.partials.projects-reports')->with(compact('auth', 'projects'))->render();
        return response()->json(['content'=> $content]);
      }


      $content = view('dashboard.reports.partials.projects-reports')->with(compact('auth','projects'))->render();
      return view('dashboard.reports.reports', compact('auth', 'content'));


    }




   /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Http\Response
   */
    public function filters(Request $request)
    {   
      


        $validator = Validator::make( $request->all(), [

            'filter_by_date_from' => 'required|date|before_or_equal:filter_by_date_to',
            'filter_by_date_to' => 'required|date|after_or_equal:filter_by_date_from',

        ], $messages = [
              'before' => 'Filter by date from must before the Filter by date to.',
              'after' => 'Filter by date to must after the Filter by date from.',
          ]);


        if ( $validator->passes() ) {

             $from = $request->filter_by_date_from;
             $to = $request->filter_by_date_to;
             $filter_by = $request->filter_by;
             $filter_by_rank = $request->filter_by_rank;
             $filter_by_group = $request->filter_by_group;
             $filter_by_personal_agent = $request->filter_by_personal_agent;
             $filter_Get_Top_Custom_Input = $request->Filter_Get_Top_Custom_Input;
             $filter_by_top = $request->filter_by_top;
             $filter_by_personal_developers = $request->filter_by_personal_developers;

             $header_title = "";

             if( !empty( $from ) && !empty( $to ) ){

                if( $filter_by == "RANK"){

                    if( $filter_by_rank == "ALL"){

                        $header_title = "Total Sales From " . $from . " - To " . $to;

                            $sales = $this->GetAllSalesByRank( $from, $to);
                            $content = view('dashboard.reports.partials.sales-table')->with(compact('sales'))->render();
                            return response()->json(['content'=> $content, 'count' => count($sales), 'header_title' => $header_title ]);

                    }else{


                      if( $filter_by_top == "ALL"){

                            $header_title = "All " . $filter_by_rank . " Total Sales From " . $from . " - To " . $to;

                            $sales = $this->GetSalesByRank( $from, $to, $filter_by_rank);
                            $content = view('dashboard.reports.partials.sales-table')->with(compact('sales'))->render();
                            return response()->json(['content'=> $content, 'count' => count($sales), 'header_title' => $header_title ]);

                        }else if( $filter_by_top == "CUSTOM") {

                            $header_title = "Top " . $filter_Get_Top_Custom_Input . " " . $filter_by_rank . " Total Sales From " . $from . " - To " . $to;

                            $sales = $this->GetSalesByRankWithTop( $from, $to, $filter_by_rank, $filter_Get_Top_Custom_Input);
                            $content = view('dashboard.reports.partials.sales-table')->with(compact('sales'))->render();

                            return response()->json(['content'=> $content, 'count' => count($sales) , 'header_title' => $header_title ]);


                        }else{


                            $header_title = "Top " . $filter_by_top . " " . $filter_by_rank . " Total Sales From " . $from . " - To " . $to;

                            $sales = $this->GetSalesByRankWithTop( $from, $to, $filter_by_rank, $filter_by_top);
                            $content = view('dashboard.reports.partials.sales-table')->with(compact('sales'))->render();
                            return response()->json(['content'=> $content, 'count' => count($sales), 'header_title' => $header_title  ]);


                        }


                    }

                  }else if( $filter_by == "GROUP"){

                        $sales = $this->GetSalesByGroup( $from, $to, $filter_by_group);
                        $content = view('dashboard.reports.partials.sales-table')->with(compact('sales'))->render();
                        return response()->json(['content'=> $content, 'count' => count($sales) ]);


                  }else if( $filter_by == "DEVELOPERS"){

                        if( $filter_by_top == "ALL"){

                            $header_title = "All Developers Total Sales From " . $from . " - To " . $to;

                            $sales = $this->GetDeveloperSales( $from, $to );
                            $content = view('dashboard.reports.partials.sales-table')->with(compact('sales'))->render();
                            return response()->json(['content'=> $content, 'count' => count($sales), 'header_title' => $header_title ]);

                        }else if( $filter_by_top == "CUSTOM") {

                            $header_title = "Top " . $filter_Get_Top_Custom_Input . " Developers Total Sales From " . $from . " - To " . $to;

                            $sales = $this->GetDeveloperSalesWithTop( $from, $to, $filter_Get_Top_Custom_Input);
                            $content = view('dashboard.reports.partials.sales-table')->with(compact('sales'))->render();
                            return response()->json(['content'=> $content, 'count' => count($sales), 'header_title' => $header_title ]);


                        }else{

                            $header_title = "Top " . $filter_by_top . " Developers Total Sales From " . $from . " - To " . $to;

                            $sales = $this->GetDeveloperSalesWithTop( $from, $to, $filter_by_top);
                            $content = view('dashboard.reports.partials.sales-table')->with(compact('sales'))->render();
                            return response()->json(['content'=> $content, 'count' => count($sales), 'header_title' => $header_title ]);


                        }


                  }else if( $filter_by == "PERSONAL_AGENT"){

                       $header_title = "Total Sales From " . $from . " - To " . $to;

                        $sales = $this->GetAgentPersonalSales( $from, $to, $filter_by_personal_agent );
                        $content = view('dashboard.reports.partials.sales-table')->with(compact('sales'))->render();
                        return response()->json(['content'=> $content, 'count' => count($sales), 'header_title' => $header_title ]);


                  }else if( $filter_by == "PERSONAL_DEVELOPER"){

                       $header_title = $filter_by_personal_developers . " Total Sales From " . $from . " - To " . $to;

                        $sales = $this->GetDeveloperPersonalSales( $from, $to, $filter_by_personal_developers );
                        $content = view('dashboard.reports.partials.sales-table')->with(compact('sales'))->render();
                        return response()->json(['content'=> $content, 'count' => count($sales), 'header_title' => $header_title]);


                  } //end filter_by



              }


          }else{

                return response()->json(['error'=>$validator->getMessageBag()->toArray()]);


           }



    }










   /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Http\Response
   */
    public function agentsFilters( Request $request )
    {  

       $Filter_By_Status = $request->Filter_By_Status;
       $Filter_Agent_By_Rank = $request->Filter_Agent_By_Rank;
       $Filter_Get_Top_Custom_Input = $request->Filter_Get_Top_Custom_Input;
       $filter_by_top = $request->filter_by_top;

       
       $repositories = new UsersRepositories;

       $title = "";

       if( $Filter_By_Status != "ALL"){

          $title = $Filter_By_Status;

       }

       if( $Filter_Agent_By_Rank != "ALL"){

          $title = $title . " " . $Filter_Agent_By_Rank;

       }

       $title = $title . " AGENTS" ;


      if( $filter_by_top == "ALL"){

          $agents = $this->GetAgentsByRankWithTop($Filter_By_Status, $Filter_Agent_By_Rank,$filter_by_top);
          
          $content = view('dashboard.reports.partials.agents-table')->with(compact('agents'))->render();
         return response()->json(['content'=> $content, 'title' => $title, 'count' => count($agents) ]);

      }else if( $filter_by_top == "CUSTOM") {

          $agents = $this->GetAgentsByRankWithTop($Filter_By_Status, $Filter_Agent_By_Rank,$Filter_Get_Top_Custom_Input);

          
          $content = view('dashboard.reports.partials.agents-table')->with(compact('agents'))->render();
          return response()->json(['content'=> $content, 'title' => "TOP " . $Filter_Get_Top_Custom_Input . " " . $title , 'count' => count($agents)]);


      }else{

          $agents = $this->GetAgentsByRankWithTop($Filter_By_Status, $Filter_Agent_By_Rank,$filter_by_top);

          $title = "TOP " . $filter_by_top . " " .$title;

          $content = view('dashboard.reports.partials.agents-table')->with(compact('agents'))->render();
          return response()->json(['content'=> $content, 'title' => $title,'count' => count($agents) ]);


      }


    }







   /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Http\Response
   */
    public function GetAgentsByRankWithTop( $status, $rank, $top )
    {  

      $users = DB::table('users')
        ->select('users.id','users.email','users.active', 'persons.lastname', 'persons.firstname', 'persons.middlename', 'avatars.photo' , 'avatars.photo_thumb','agent_rank_types.rank AS rank','agents_details.approved', 'agents_details.recruits as downlines')
        ->join('persons', 'persons.id', '=', 'users.person_id')
        ->join('avatars', 'avatars.user_id', '=', 'users.id')
        ->join('roles', 'roles.id', '=', 'users.role_id')
        ->join('agent_ranks', 'agent_ranks.agent_id', '=', 'users.id')
        ->join('agent_rank_types', 'agent_rank_types.id', '=', 'agent_ranks.rank_type_id')
        ->join('agents_details', 'agents_details.agent_id', '=', 'users.id')
        ->where('roles.name','Agent')
        ->when( $status , function( $query ) use ( $status ){

            if( $status != "ALL"){

              if( $status == "ACTIVE" ){ $status = 1; }else{ $status = 0; }
              return $query->where('users.active', $status );

            }

        })
        ->when( $rank , function( $query ) use ( $rank ){

            if( $rank != "ALL"){

              $rank_id = AgentRankTypes::where('rank', $rank)->first()->id;
              return $query->where('agent_rank_types.id', $rank_id );
            }

        })
        ->when( $top , function( $query ) use ( $top){

            if( $top != "ALL"){

              return $query->take($top);
            }

        })
        ->get();



        return $users;




    }























   /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Http\Response
   */
    public function GetAllSalesByRank( $from, $to)
    {  

      $from = new Carbon( $from );
      $to = new Carbon( $to );

      $sales = DB::table('sales')
        ->select('sales.id as sales_id', 'sales.total_contract_price','sales.date_reserve', DB::raw('CONCAT(per1.lastname, ", ", per1.firstname, " ", per1.middlename) AS agent_name'), 'users.id as agent_id', 'developers.name as developer_name', 'developers.id as developer_id', 'transactions.id as transaction_id','transactions.project_name','transactions.project_location', DB::raw('CONCAT(per2.lastname, ", ", per2.firstname, " ", per2.middlename) AS client_name'), 'clients.id as client_id', 'sales.approved', 'sales.cancelled', 'project_types.type as category','transactions.assumed_commission')
        ->join('transactions', 'transactions.id', '=', 'sales.transaction_id')
        ->join('project_types', 'project_types.id' , 'transactions.project_type')
        ->join('users', 'users.id', '=', 'transactions.agent_id')
        ->join('persons as per1', 'per1.id', '=', 'users.person_id')
        ->join('developers', 'developers.id', '=', 'transactions.developer_id')
        ->join('clients', 'clients.id', '=', 'transactions.client_id')
        ->join('persons as per2', 'per2.id', '=', 'clients.person_id')
        ->whereBetween( 'sales.date_reserve' , [$from,$to] )
        ->where('sales.approved', 1)
        ->where('sales.cancelled', 0)
        ->orderBy( 'sales.total_contract_price' ,'desc')
        ->get();


        return $sales;

    }






   /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Http\Response
   */
    public function GetSalesByRank( $from, $to, $rank )
    {  

      $rank_id = AgentRankTypes::where('rank', $rank)->first()->id;

      $from = new Carbon( $from );
      $to = new Carbon( $to );

      $sales = DB::table('sales')
        ->select('sales.id as sales_id', 'sales.total_contract_price','sales.date_reserve', DB::raw('CONCAT(per1.lastname, ", ", per1.firstname, " ", per1.middlename) AS agent_name'), 'users.id as agent_id', 'developers.name as developer_name', 'developers.id as developer_id', 'transactions.id as transaction_id','transactions.project_name','transactions.project_location', DB::raw('CONCAT(per2.lastname, ", ", per2.firstname, " ", per2.middlename) AS client_name'), 'clients.id as client_id', 'sales.approved', 'sales.cancelled', 'project_types.type as category','transactions.assumed_commission')
        ->join('transactions', 'transactions.id', '=', 'sales.transaction_id')
        ->join('project_types', 'project_types.id' , 'transactions.project_type')
        ->join('users', 'users.id', '=', 'transactions.agent_id')
        ->join('persons as per1', 'per1.id', '=', 'users.person_id')
        ->join('developers', 'developers.id', '=', 'transactions.developer_id')
        ->join('clients', 'clients.id', '=', 'transactions.client_id')
        ->join('persons as per2', 'per2.id', '=', 'clients.person_id')
        ->where('transactions.agent_rank', $rank_id )
        ->whereBetween( 'sales.date_reserve' , [$from,$to] )
        ->where('sales.approved', 1)
        ->where('sales.cancelled', 0)
        ->orderBy( 'sales.total_contract_price' ,'desc')
        ->get();


        return $sales;

    }




   /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Http\Response
   */
    public function GetSalesByRankWithTop( $from, $to, $rank, $top )
    {  

      $rank_id = AgentRankTypes::where('rank', $rank)->first()->id;

      $from = new Carbon( $from );
      $to = new Carbon( $to );
      
      $sales = DB::table('sales')
        ->select('sales.id as sales_id', 'sales.total_contract_price','sales.date_reserve', DB::raw('CONCAT(per1.lastname, ", ", per1.firstname, " ", per1.middlename) AS agent_name'), 'users.id as agent_id', 'developers.name as developer_name', 'developers.id as developer_id', 'transactions.id as transaction_id','transactions.project_name','transactions.project_location', DB::raw('CONCAT(per2.lastname, ", ", per2.firstname, " ", per2.middlename) AS client_name'), 'clients.id as client_id', 'sales.approved', 'sales.cancelled', 'project_types.type as category','transactions.assumed_commission')
        ->join('transactions', 'transactions.id', '=', 'sales.transaction_id')
        ->join('project_types', 'project_types.id' , 'transactions.project_type')
        ->join('users', 'users.id', '=', 'transactions.agent_id')
        ->join('persons as per1', 'per1.id', '=', 'users.person_id')
        ->join('developers', 'developers.id', '=', 'transactions.developer_id')
        ->join('clients', 'clients.id', '=', 'transactions.client_id')
        ->join('persons as per2', 'per2.id', '=', 'clients.person_id')
        ->where('transactions.agent_rank', $rank_id )
        ->where('sales.approved', 1)
        ->where('sales.cancelled', 0)
        ->whereBetween( 'sales.date_reserve' , [$from,$to] )
        ->orderBy( 'sales.total_contract_price' ,'desc')
        ->take($top)
        ->get();


        return $sales;

    }






   /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Http\Response
   */
    public function GetSalesByGroup( $from, $to, $rank )
    {  

      $ranks = ['PC','RPC','GID','PTM'];

      $from = new Carbon( $from );
      $to = new Carbon( $to );


      $sales = collect();

      $key = array_search( $rank , $ranks);

      for( $i = 0; $key >= $i; $i++ ){

        $rank_id = AgentRankTypes::where('rank', $ranks[$i] )->first()->id;

        $temp = DB::table('sales') 
          ->select('sales.id as sales_id', 'sales.total_contract_price','sales.date_reserve', DB::raw('CONCAT(per1.lastname, ", ", per1.firstname, " ", per1.middlename) AS agent_name'), 'users.id as agent_id', 'developers.name as developer_name', 'developers.id as developer_id', 'transactions.id as transaction_id','transactions.project_name','transactions.project_location', DB::raw('CONCAT(per2.lastname, ", ", per2.firstname, " ", per2.middlename) AS client_name'), 'clients.id as client_id', 'sales.approved', 'sales.cancelled', 'project_types.type as category','transactions.assumed_commission')
          ->join('transactions', 'transactions.id', '=', 'sales.transaction_id')
          ->join('project_types', 'project_types.id' , 'transactions.project_type')
          ->join('users', 'users.id', '=', 'transactions.agent_id')
          ->join('persons as per1', 'per1.id', '=', 'users.person_id')
          ->join('developers', 'developers.id', '=', 'transactions.developer_id')
          ->join('clients', 'clients.id', '=', 'transactions.client_id')
          ->join('persons as per2', 'per2.id', '=', 'clients.person_id')
          ->where('transactions.agent_rank', $rank_id )
          ->whereBetween( 'sales.date_reserve' , [$from,$to] )
          ->where('sales.approved', 1)
          ->where('sales.cancelled', 0)
          ->get();

          $sales = $sales->push([$ranks[$i] => $temp->toJson() ]);

      }


      return $sales;




    }






   /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Http\Response
   */
    public function GetDeveloperSales( $from, $to )
    {  


      $from = new Carbon( $from );
      $to = new Carbon( $to );

        $sales = DB::table('sales') 
          ->select('sales.id as sales_id', 'sales.total_contract_price','sales.date_reserve', DB::raw('CONCAT(per1.lastname, ", ", per1.firstname, " ", per1.middlename) AS agent_name'), 'users.id as agent_id', 'developers.name as developer_name', 'developers.id as developer_id', 'transactions.id as transaction_id','transactions.project_name','transactions.project_location', DB::raw('CONCAT(per2.lastname, ", ", per2.firstname, " ", per2.middlename) AS client_name'), 'clients.id as client_id', 'sales.approved', 'sales.cancelled', 'project_types.type as category','transactions.assumed_commission')
          ->join('transactions', 'transactions.id', '=', 'sales.transaction_id')
          ->join('project_types', 'project_types.id' , 'transactions.project_type')
          ->join('users', 'users.id', '=', 'transactions.agent_id')
          ->join('persons as per1', 'per1.id', '=', 'users.person_id')
          ->join('developers', 'developers.id', '=', 'transactions.developer_id')
          ->join('clients', 'clients.id', '=', 'transactions.client_id')
          ->join('persons as per2', 'per2.id', '=', 'clients.person_id')
          ->whereBetween( 'sales.date_reserve' , [$from,$to] )
          ->where('sales.approved', 1)
          ->where('sales.cancelled', 0)
          ->orderBy('developers.name')
          ->get();


          return $sales;


    }



   /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Http\Response
   */
    public function GetDeveloperSalesWithTop( $from, $to, $top )
    {  


      $from = new Carbon( $from );
      $to = new Carbon( $to );

        $sales = DB::table('sales') 
          ->select('sales.id as sales_id', 'sales.total_contract_price','sales.date_reserve', DB::raw('CONCAT(per1.lastname, ", ", per1.firstname, " ", per1.middlename) AS agent_name'), 'users.id as agent_id', 'developers.name as developer_name', 'developers.id as developer_id', 'transactions.id as transaction_id','transactions.project_name','transactions.project_location', DB::raw('CONCAT(per2.lastname, ", ", per2.firstname, " ", per2.middlename) AS client_name'), 'clients.id as client_id', 'sales.approved', 'sales.cancelled', 'project_types.type as category','transactions.assumed_commission')
          ->join('transactions', 'transactions.id', '=', 'sales.transaction_id')
          ->join('project_types', 'project_types.id' , 'transactions.project_type')
          ->join('users', 'users.id', '=', 'transactions.agent_id')
          ->join('persons as per1', 'per1.id', '=', 'users.person_id')
          ->join('developers', 'developers.id', '=', 'transactions.developer_id')
          ->join('clients', 'clients.id', '=', 'transactions.client_id')
          ->join('persons as per2', 'per2.id', '=', 'clients.person_id')
          ->whereBetween( 'sales.date_reserve' , [$from,$to] )
          ->where('sales.approved', 1)
          ->where('sales.cancelled', 0)
          ->orderBy( 'sales.total_contract_price' ,'desc')
          ->take($top)
          ->get();


          return $sales;


    }





   /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Http\Response
   */
    public function GetDeveloperPersonalSales( $from, $to, $developer )
    {  


      $from = new Carbon( $from );
      $to = new Carbon( $to );

        $sales = DB::table('sales') 
          ->select('sales.id as sales_id', 'sales.total_contract_price','sales.date_reserve', DB::raw('CONCAT(per1.lastname, ", ", per1.firstname, " ", per1.middlename) AS agent_name'), 'users.id as agent_id', 'developers.name as developer_name', 'developers.id as developer_id', 'transactions.id as transaction_id','transactions.project_name','transactions.project_location', DB::raw('CONCAT(per2.lastname, ", ", per2.firstname, " ", per2.middlename) AS client_name'), 'clients.id as client_id', 'sales.approved', 'sales.cancelled', 'project_types.type as category','transactions.assumed_commission')
          ->join('transactions', 'transactions.id', '=', 'sales.transaction_id')
          ->join('project_types', 'project_types.id' , 'transactions.project_type')
          ->join('users', 'users.id', '=', 'transactions.agent_id')
          ->join('persons as per1', 'per1.id', '=', 'users.person_id')
          ->join('developers', 'developers.id', '=', 'transactions.developer_id')
          ->join('clients', 'clients.id', '=', 'transactions.client_id')
          ->join('persons as per2', 'per2.id', '=', 'clients.person_id')
          ->whereBetween( 'sales.date_reserve' , [$from,$to] )
          ->where('developers.name', $developer)
          ->where('sales.approved', 1)
          ->where('sales.cancelled', 0)
          ->get();


          return $sales;


    }



  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Http\Response
   */
    public function GetAgentPersonalSales( $from, $to, $agent )
    {  


      $from = new Carbon( $from );
      $to = new Carbon( $to );

        $sales = DB::table('sales') 
          ->select('sales.id as sales_id', 'sales.total_contract_price','sales.date_reserve', DB::raw('CONCAT(per1.lastname, ", ", per1.firstname, " ", per1.middlename) AS agent_name'), 'users.id as agent_id', 'developers.name as developer_name', 'developers.id as developer_id', 'transactions.id as transaction_id','transactions.project_name','transactions.project_location', DB::raw('CONCAT(per2.lastname, ", ", per2.firstname, " ", per2.middlename) AS client_name'), 'clients.id as client_id', 'sales.approved', 'sales.cancelled', 'project_types.type as category','transactions.assumed_commission')
          ->join('transactions', 'transactions.id', '=', 'sales.transaction_id')
          ->join('project_types', 'project_types.id' , 'transactions.project_type')
          ->join('users', 'users.id', '=', 'transactions.agent_id')
          ->join('persons as per1', 'per1.id', '=', 'users.person_id')
          ->join('developers', 'developers.id', '=', 'transactions.developer_id')
          ->join('clients', 'clients.id', '=', 'transactions.client_id')
          ->join('persons as per2', 'per2.id', '=', 'clients.person_id')
          ->whereBetween( 'sales.date_reserve' , [$from,$to] )
          ->where('users.email', $agent)
          ->where('sales.approved', 1)
          ->where('sales.cancelled', 0)
          ->get();


          return $sales;


    }



}
