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



class SalesController extends Controller
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
    public function sales(Request $request)
    {   
      $repositories = new UsersRepositories;
      $sales_repositories = new SalesRepositories;
      $auth = $repositories->getUser( Hashids::encode ( Auth::user()->id ) );
      $sales = $sales_repositories->getAllSales();

      if( $request->ajax() ){

        $content = view('dashboard.sales.partials.sales')->with(compact('auth', 'sales'))->render();
          return response()->json(['content'=> $content ]);
      }

      $content = view('dashboard.sales.partials.sales')->with(compact('auth', 'sales'))->render();
      return view('dashboard.sales.sales', compact('auth', 'content'));

    }





    public function addSalesShowForm(Request $request)
    {  
        $repositories = new UsersRepositories;
        $auth = $repositories->getUser( Hashids::encode ( Auth::user()->id ) );
        $developer_repo = new DevelopersRepositories;
        $projects = $developer_repo->getAllProjects();
        $agents = $repositories->Agents();


        if( $request->ajax() ){

            $content  = view('dashboard.sales.forms.add')->with( compact('projects','agents') )->render();
            return response()->json(['content'=> $content]);
        }

        $content  = view('dashboard.sales.forms.add')->with( compact('projects','agents') )->render();
        return view('dashboard.sales.sales', compact( 'content','auth' ));
    }




    public function validateContractInfo(Request $request)
    {  
        
        $validator = Validator::make( $request->all(), [

            'date_reserve' => 'required|date',
            'contract_price' => 'required|numeric|min:1000000',

        ]);

        if($validator->passes()) {
            return response()->json(['success' => 'success']);
        }
        else
        {
            return response()->json(['error'=>$validator->getMessageBag()->toArray()]);
        }
    }


    public function validateClientInfo(Request $request)
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



    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function approvedSales( Request $request )
    {  
      
      $repositories = new UsersRepositories;
      $sales_repositories = new SalesRepositories;
      $auth = $repositories->getUser( Hashids::encode ( Auth::user()->id ) );
      $sales = $sales_repositories->getAllSales();

      if( $request->ajax() ){

        $content = view('dashboard.sales.partials.approved-sales')->with(compact('auth', 'sales'))->render();
          return response()->json(['content'=> $content ]);
      }

      $content = view('dashboard.sales.partials.approved-sales')->with(compact('auth', 'sales'))->render();
      return view('dashboard.sales.sales', compact('auth', 'content'));

    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function pendingSales( Request $request )
    {  
      
      $repositories = new UsersRepositories;
      $sales_repositories = new SalesRepositories;
      $auth = $repositories->getUser( Hashids::encode ( Auth::user()->id ) );
      $sales = $sales_repositories->getAllPendingSales();

      if( $request->ajax() ){

        $content = view('dashboard.sales.partials.pending-sales')->with(compact('auth', 'sales'))->render();
          return response()->json(['content'=> $content ]);
      }

      $content = view('dashboard.sales.partials.pending-sales')->with(compact('auth', 'sales'))->render();
      return view('dashboard.sales.sales', compact('auth', 'content'));

    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function cancelledSales( Request $request )
    {  
      
      $repositories = new UsersRepositories;
      $sales_repositories = new SalesRepositories;
      $auth = $repositories->getUser( Hashids::encode ( Auth::user()->id ) );
      $sales = $sales_repositories->getAllCancelledSales();

      if( $request->ajax() ){

        $content = view('dashboard.sales.partials.cancelled-sales')->with(compact('auth', 'sales'))->render();
          return response()->json(['content'=> $content ]);
      }

      $content = view('dashboard.sales.partials.cancelled-sales')->with(compact('auth', 'sales'))->render();
      return view('dashboard.sales.sales', compact('auth', 'content'));


    }



   /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function addSalesForm()
    {  
        
      $repositories = new UsersRepositories;
      $user = $repositories->getUser( Hashids::encode ( Auth::user()->id ) );
      $title = 'sales';

      return view('sales.addSales', compact('user' , 'title' ));


    }






   /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateSales( Request $request )
    {  


      $validator = Validator::make($request->all(), [

            'firstname' => 'required|string|max:50|regex:/^[(a-zA-Z\s)]+$/u',
            'lastname' => 'required|string|max:50|regex:/^[(a-zA-Z\s)]+$/u',
            'middlename' => 'string|nullable|regex:/^[(a-zA-Z\s)]+$/u',
            'agent'  => 'required|string|max:50',
            'date_reserve'  => 'required|date|max:50',
            'project'  => 'required|string|max:50',
            'contract_price'  => 'required|numeric|min:1000000'

      ]);


      if ($validator->passes()) {

        $project = Project::where('id', Hashids::decode( $request->project )[0] )->first();
        $client = Client::where('id', Hashids::decode( $request->client_id )[0] )->first();

        $person = Person::where('id', $client->person_id )->first();
        $person->firstname = ucfirst( strtolower( $request->firstname ) );
        $person->lastname = ucfirst( strtolower( $request->lastname ) );
        $person->middlename = ucfirst( strtolower( $request->middlename ) );
        $person->update(); 

        $client->person_id = $client->person_id;
        $client->update();


        $transaction = Transaction::where('id', Hashids::decode( $request->transaction_id )[0])->first();
        $transaction->developer_id = $project->developer_id;
        $transaction->agent_id = Hashids::decode( $request->agent )[0];
        $transaction->developer_id = $project->developer_id;
        $transaction->project_id = Hashids::decode( $request->project )[0];
        $transaction->client_id = $client->id;
        $transaction->project_name = $project->project_name;
        $transaction->project_description = $project->project_description;
        $transaction->project_location = $project->project_location;
        $transaction->project_type = ProjectType::where('id', $project->project_type_id)->first()->type;
        $transaction->added_by = Auth::user()->id;
        $transaction->update();


        $sales = Sales::where('id', Hashids::decode( $request->sales_id )[0])->first();
        $sales->transaction_id = Hashids::decode( $request->transaction_id )[0] ;
        $sales->date_reserve = $request->date_reserve;
        $sales->total_contract_price = $request->contract_price;
        $sales->update();

        $repositories = new UsersRepositories;
        $sales_repositories = new SalesRepositories;
        $sales = $sales_repositories->getAllSales();
        
        $auth = $repositories->getUser( Hashids::encode ( Auth::user()->id ) );

        $content = view('dashboard.sales.partials.approved-sales')->with(compact('auth', 'sales'))->render();

        return response()->json(['content'=> $content , 'success'=>'Successfully Updated a record.']);


      }else{

       return response()->json(['error'=>$validator->getMessageBag()->toArray()]);
      
      }


    }
























   /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateSalesForm( Request $request )
    {  
      
      $sales_repositories = new SalesRepositories;
      $sales = $sales_repositories->getSales( $request->id );

      $view = view('sales.partials.update-sales-form', compact('sales'))->render();

      return response()->json(['content'=> $view ]);
    }




   /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function calculateAgentCommmission( $totalContractPrice , $agentId )
    {  
      
      $agentRank = AgentRanks::where('agent_id', $agentId )->first();
      $rankTypes = AgentRankTypes::where('id', $agentRank->rank_type_id )->first();

      return $totalContractPrice * $rankTypes->commission_rate;
      
    }



    public function addSales( Request $request )
    {  

      $validator = Validator::make($request->all(), [

            'firstname' => 'required|string|max:50|regex:/^[(a-zA-Z\s)]+$/u',
            'lastname' => 'required|string|max:50|regex:/^[(a-zA-Z\s)]+$/u',
            'middlename' => 'string|nullable|regex:/^[(a-zA-Z\s)]+$/u',
            'agent'  => 'required',
            'date_reserve'  => 'required|date',
            'project'  => 'required',
            'contract_price'  => 'required|numeric|min:1000000',

      ]);


      if ($validator->passes()) {

        $project = Project::where('id', Hashids::decode( $request->project )[0] )->first();
        
        $person = new Person();
        $person->firstname = ucfirst( strtolower( $request->firstname ) );
        $person->lastname = ucfirst( strtolower( $request->lastname ) );
        $person->middlename = ucfirst( strtolower( $request->middlename ) );
        $person->save(); 

        $client = new Client();
        $client->person_id = $person->id;
        $client->save();


        $transaction = new Transaction();
        $transaction->agent_id = Hashids::decode( $request->agent )[0];
        $transaction->developer_id = $project->developer_id;
        $transaction->project_id = Hashids::decode( $request->project )[0];
        $transaction->client_id = $client->id;
        $transaction->project_name = $project->project_name;
        $transaction->project_description = $project->project_description;
        $transaction->project_location = $project->project_location;
        $transaction->project_type = $project->project_type_id;
        $transaction->assumed_commission = $this->calculateAgentCommmission( $request->contract_price , Hashids::decode( $request->agent )[0]);
        $transaction->agent_rank = AgentRanks::where('agent_id',Hashids::decode( $request->agent )[0])->first()->rank_type_id;
        $transaction->added_by = Auth::user()->id;
        $transaction->save();


        $sales = new Sales();
        $sales->transaction_id = $transaction->id;
        $sales->date_reserve = $request->date_reserve;
        $sales->total_contract_price = $request->contract_price;
        


       if( ( Role::where( 'id', Auth::user()->role_id )->first()->name == "Admin" ) || ( Role::where( 'id', Auth::user()->role_id )->first()->name == "SuperAdmin" )){

          $sales->approved = 1;
          $sales->approved_by = Auth::user()->id;
          $sales->save();

       }else{


          $sales->save();
          // send notification to admins for approvation

       }


      $repositories = new UsersRepositories;
      $sales_repositories = new SalesRepositories;
      $auth = $repositories->getUser( Hashids::encode ( Auth::user()->id ) );
      $sales = $sales_repositories->getAllSales();
      $success = 'Successfully Added new sales.';


      $content = view('dashboard.sales.partials.sales')->with(compact('auth', 'sales'))->render();
          return response()->json(['content'=> $content, 'success' => $success ]);
    

      }else{

       return response()->json(['error'=>$validator->getMessageBag()->toArray()]);
      
      }

    }


    





   public function approveSales( Request $request )
    { 

          $sales = Sales::find( Hashids::decode ( $request->id )[0] );
          $sales->approved = 1;
          $sales->save();


          $repositories = new UsersRepositories;
          $sales_repositories = new SalesRepositories;
          $auth = $repositories->getUser( Hashids::encode ( Auth::user()->id ) );
          $developer_repo = new DevelopersRepositories;
          $projects = $developer_repo->getAllProjects();
          $agents = $repositories->Agents();

          
          $success = 'Successfully cancelled a sales.';

          $sales = $sales_repositories->getSalesWillProjectDetails( $request->id );
          $overlay = view('dashboard.sales.forms.update')->with(compact('sales','projects','agents', 'auth'))->render();

          $sales = $sales_repositories->getAllSales();
          $content = view('dashboard.sales.partials.approved-sales')->with(compact('auth', 'sales'))->render();

            return response()->json(['content'=> $content, 'success' => $success, 'overlay' => $overlay ]);

    }



   public function cancelSales( Request $request )
    { 

          $sales = Sales::find( Hashids::decode ( $request->id )[0] );
          $sales->cancelled = 1;
          $sales->save();


          $repositories = new UsersRepositories;
          $sales_repositories = new SalesRepositories;
          $auth = $repositories->getUser( Hashids::encode ( Auth::user()->id ) );
          $developer_repo = new DevelopersRepositories;
          $projects = $developer_repo->getAllProjects();
          $agents = $repositories->Agents();

          
          $success = 'Successfully cancelled a sales.';

          $sales = $sales_repositories->getSalesWillProjectDetails( $request->id );
          $overlay = view('dashboard.sales.forms.update')->with(compact('sales','projects','agents', 'auth'))->render();

          $sales = $sales_repositories->getAllSales();
          $content = view('dashboard.sales.partials.approved-sales')->with(compact('auth', 'sales'))->render();

            return response()->json(['content'=> $content, 'success' => $success, 'overlay' => $overlay ]);


    }



   public function uncancelSales( Request $request )
    { 

          $sales = Sales::find( Hashids::decode ( $request->id )[0] );
          $sales->cancelled = 0;
          $sales->save();


          $repositories = new UsersRepositories;
          $sales_repositories = new SalesRepositories;
          $auth = $repositories->getUser( Hashids::encode ( Auth::user()->id ) );
          $developer_repo = new DevelopersRepositories;
          $projects = $developer_repo->getAllProjects();
          $agents = $repositories->Agents();

          
          $success = 'Successfully uncancelled a sales.';

          $sales = $sales_repositories->getSalesWillProjectDetails( $request->id );
          $overlay = view('dashboard.sales.forms.update')->with(compact('sales','projects','agents', 'auth'))->render();

          $sales = $sales_repositories->getAllCancelledSales();
          $content = view('dashboard.sales.partials.cancelled-sales')->with(compact('auth', 'sales'))->render();

            return response()->json(['content'=> $content, 'success' => $success, 'overlay' => $overlay ]);



    }





    public function viewSales( Request $request )
    {  
      
      $sales_repositories = new SalesRepositories;
      $sales = $sales_repositories->getSalesWillProjectDetails( $request->id );

      $view = view('dashboard.sales.sales-info')->with(compact('sales'))->render();

      return response()->json(['content'=> $view ]);


    }



    public function updateSalesShowForm( Request $request )
    {  
      
      $sales_repositories = new SalesRepositories;
      $sales = $sales_repositories->getSalesWillProjectDetails( $request->id );
      $repositories = new UsersRepositories;
      $auth = $repositories->getUser( Hashids::encode ( Auth::user()->id ) );
      $developer_repo = new DevelopersRepositories;
      $projects = $developer_repo->getAllProjects();
      $agents = $repositories->Agents();

      $view = view('dashboard.sales.forms.update')->with(compact('sales','projects','agents', 'auth'))->render();

      return response()->json(['content'=> $view ]);


    }





    public function updateSalesProject( Request $request )
    {  

      $project = Project::where('id', Hashids::decode( $request->project )[0] )->first();

      $transaction = Transaction::where('id', Hashids::decode( $request->transaction_id )[0] )->first();
      $transaction->developer_id = $project->developer_id;
      $transaction->project_id = Hashids::decode( $request->project )[0];
      $transaction->project_name = $project->project_name;
      $transaction->project_description = $project->project_description;
      $transaction->project_location = $project->project_location;
      $transaction->project_type = ProjectType::where('id', $project->project_type_id)->first()->type;
      $transaction->added_by = Auth::user()->id;
      $transaction->save();


      $repositories = new UsersRepositories;
      $sales_repositories = new SalesRepositories;
      $auth = $repositories->getUser( Hashids::encode ( Auth::user()->id ) );
      $developer_repo = new DevelopersRepositories;
      $projects = $developer_repo->getAllProjects();
      $agents = $repositories->Agents();

      $success = 'Successfully updated sales.';

      $sales = $sales_repositories->getSalesWillProjectDetails( $request->sales_id );
      $overlay = view('dashboard.sales.forms.update')->with(compact('sales','projects','agents', 'auth'))->render();

      $sales = $sales_repositories->getAllSales();
      $content = view('dashboard.sales.partials.sales')->with(compact('auth', 'sales'))->render();

        return response()->json(['content'=> $content, 'success' => $success, 'overlay' => $overlay ]);


    }





    public function updateSalesContract( Request $request )
    {   



      $validator = Validator::make($request->all(), [

            'date_reserve'  => 'required|date',
            'contract_price'  => 'required|numeric',

      ]);


      if ($validator->passes()) {

        $sales = Sales::where('id', Hashids::decode( $request->sales_id )[0] )->first();
        $sales->date_reserve = $request->date_reserve;
        $sales->total_contract_price = $request->contract_price;
        $sales->save();


        $repositories = new UsersRepositories;
        $sales_repositories = new SalesRepositories;
        $auth = $repositories->getUser( Hashids::encode ( Auth::user()->id ) );
        $developer_repo = new DevelopersRepositories;
        $projects = $developer_repo->getAllProjects();
        $agents = $repositories->Agents();

        $success = 'Successfully updated sales.';

        $sales = $sales_repositories->getSalesWillProjectDetails( $request->sales_id );
        $overlay = view('dashboard.sales.forms.update')->with(compact('sales','projects','agents', 'auth'))->render();

        $sales = $sales_repositories->getAllSales();
        $content = view('dashboard.sales.partials.sales')->with(compact('auth', 'sales'))->render();

          return response()->json(['content'=> $content, 'success' => $success, 'overlay' => $overlay ]);

        }else{

       return response()->json(['error'=>$validator->getMessageBag()->toArray()]);
      
      }


    }




    public function updateSalesAgent( Request $request )
    {  

      $transaction = Transaction::where('id', Hashids::decode( $request->transaction_id )[0] )->first();
      $transaction->agent_id = Hashids::decode( $request->agent )[0];
      $transaction->save();


      $repositories = new UsersRepositories;
      $sales_repositories = new SalesRepositories;
      $auth = $repositories->getUser( Hashids::encode ( Auth::user()->id ) );
      $developer_repo = new DevelopersRepositories;
      $projects = $developer_repo->getAllProjects();
      $agents = $repositories->Agents();

      $success = 'Successfully updated sales.';

      $sales = $sales_repositories->getSalesWillProjectDetails( $request->sales_id );
      $overlay = view('dashboard.sales.forms.update')->with(compact('sales','projects','agents', 'auth'))->render();

      $sales = $sales_repositories->getAllSales();
      $content = view('dashboard.sales.partials.sales')->with(compact('auth', 'sales'))->render();

        return response()->json(['content'=> $content, 'success' => $success, 'overlay' => $overlay ]);


    }



    public function updateSalesClient( Request $request )
    {  

      $validator = Validator::make($request->all(), [

            'firstname' => 'required|string|max:50|regex:/^[(a-zA-Z\s)]+$/u',
            'lastname' => 'required|string|max:50|regex:/^[(a-zA-Z\s)]+$/u',
            'middlename' => 'string|nullable|regex:/^[(a-zA-Z\s)]+$/u',

      ]);


      if ($validator->passes()) {

      $client = Client::where('id', Hashids::decode( $request->client_id )[0])->first();
        
      $person = Person::where('id', $client->person_id )->first();
      $person->firstname = ucfirst( strtolower( $request->firstname ) );
      $person->lastname = ucfirst( strtolower( $request->lastname ) );
      $person->middlename = ucfirst( strtolower( $request->middlename ) );
      $person->save(); 

      $repositories = new UsersRepositories;
      $sales_repositories = new SalesRepositories;
      $auth = $repositories->getUser( Hashids::encode ( Auth::user()->id ) );
      $developer_repo = new DevelopersRepositories;
      $projects = $developer_repo->getAllProjects();
      $agents = $repositories->Agents();

      $success = 'Successfully updated sales.';

      $sales = $sales_repositories->getSalesWillProjectDetails( $request->sales_id );
      $overlay = view('dashboard.sales.forms.update')->with(compact('sales','projects','agents', 'auth'))->render();

      $sales = $sales_repositories->getAllSales();
      $content = view('dashboard.sales.partials.sales')->with(compact('auth', 'sales'))->render();

        return response()->json(['content'=> $content, 'success' => $success, 'overlay' => $overlay ]);

      }else{

         return response()->json(['error'=>$validator->getMessageBag()->toArray()]);
      }


    }







}
