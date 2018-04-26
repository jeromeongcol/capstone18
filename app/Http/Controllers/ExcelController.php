<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Excel;
use DB;
use App\User;
use Illuminate\Support\Facades\File;
use App\Role;
use App\AgentRanks;
use App\AgentRankTypes;
use App\AgentDetails;
use App\Avatar;
use Auth;
use App\Person;
use Vinkla\Hashids\Facades\Hashids;
use App\Repositories\UsersRepositories;

class ExcelController extends Controller
{
    

     public function __construct()
    {
        $this->middleware('auth');
    } 


	public function importUserExcel( Request $request ){

		if( $request->hasFile('UserExcelFile')){

			$path = $request->file('UserExcelFile')->getRealPath();
			$data = Excel::load( $path, function( $reader ){})->first();
			$error = 0;
			$success = 0;


			if( !empty( $data ) && $data->count() ){

				foreach ($data as $key => $value) {

				if( empty( User::where("email", $value->email)->first()  )){

		            $person = new Person();
			        $person->firstname = ucfirst( strtolower( $value->firstname ) );
			        $person->lastname = ucfirst( strtolower( $value->lastname ) );
			        $person->middlename = ucfirst( strtolower( $value->middlename ) );
			        $person->save();

			        $user = new User();
			        $user->email = $value->email;
			        $user->password = bcrypt( $value->email );
			        $user->role_id = Role::where('name', 'Agent')->first()->id;
			        $user->added_by = Auth::User()->id;
			        $user->active = $value->active;
			        $user->person_id = $person->id;
			        $user->save();


		            $rank = new AgentRanks();
		            $rank->agent_id = $user->id;
					$rank->rank_type_id = AgentRankTypes::where( 'rank' , $value->rank )->first()->id;
					$rank->save();


					$agentdetails = new AgentDetails();
		            $agentdetails->recruiter = User::where('email',  $value->recruiter )->first()->id;
		            $agentdetails->agent_id = $user->id;
		            $agentdetails->approved = 1;
	                $agentdetails->approved_by = Auth::user()->id;
	                $agentdetails->save();

	                $recruiterdetails = AgentDetails::where('agent_id',  User::where('email',  $value->recruiter )->first()->id )->first();
	                $recruiterdetails->recruits = $recruiterdetails->recruits + 1;
	                $recruiterdetails->update();



			        $avatar = new Avatar();
		            $avatar->user_id = $user->id;
		            $avatar->photo = '/storage/users/default.png';
		            $avatar->photo_thumb = '/storage/users/default.png';
		            $avatar->save();


			        $success++;

				}else{
					$error++;
				}


			  }

			} // end foreach statement

			$repositories = new UsersRepositories;
	    	$auth = $repositories->getUser( Hashids::encode ( Auth::user()->id ) );
	    	$users = $repositories->Agents();


    		$content  = view('dashboard.users.partials.agents')->with(compact('users','auth'))->render();

    		return response()->json(['success'=>'Successfully Imported '. $success . ' records. ' . $error . " Records unable to import.", 'content'=> $content]);


			}else{
				return response()->json(['error'=> "Something wrong with the file imported" ]);
			}


	} // end function









	public function exportAllUsersToExcel( Request $request ){
		
		Excel::create( $request->filename, function( $excel ){
			$excel->sheet("users", function( $sheet ){

				$repositories = new UsersRepositories;
				$users = $repositories->getAllUsersToExport();
				$users = json_decode(json_encode($users), true);

				$sheet->fromArray( $users );
			});
		})->export("xlsx");


	}

	

	public function exportAllActiveUsersToExcel( Request $request ){


		
		Excel::create( $request->filename, function( $excel ){
			$excel->sheet("users", function( $sheet ){

				$repositories = new UsersRepositories;
				$users = $repositories->getAllActiveUsersToExport();
				$users = json_decode(json_encode($users), true);

				$sheet->fromArray( $users );
			});
		})->export("xlsx");


	}

	public function exportAllNotActiveUsersToExcel( Request $request ){


		Excel::create( $request->filename, function( $excel ){
			$excel->sheet("users", function( $sheet ){

				$repositories = new UsersRepositories;
				$users = $repositories->getAllNotActiveUsersToExport();
				$users = json_decode(json_encode($users), true);
		
				$sheet->fromArray( $users );

			});
		})->export("xlsx");


	}











	public function exportAllAgentsToExcel( Request $request ){


		
		Excel::create( $request->filename, function( $excel ){
			$excel->sheet("users", function( $sheet ){

				$repositories = new UsersRepositories;
				$users = $repositories->getAllAgentsToExport();
				$users = json_decode(json_encode($users), true);

				$sheet->fromArray( $users );
			});
		})->export("xlsx");


	}


	public function exportAllActiveAgentsToExcel( Request $request ){


		
		Excel::create( $request->filename, function( $excel ){
			$excel->sheet("users", function( $sheet ){

				$repositories = new UsersRepositories;
				$users = $repositories->getAllActiveAgentsToExport();
				$users = json_decode(json_encode($users), true);

				$sheet->fromArray( $users );
			});
		})->export("xlsx");


	}


	public function exportAllNotActiveAgentsToExcel( Request $request ){


		
		Excel::create( $request->filename, function( $excel ){
			$excel->sheet("users", function( $sheet ){

				$repositories = new UsersRepositories;
				$users = $repositories->getAllNotActiveAgentsToExport();
				$users = json_decode(json_encode($users), true);

				$sheet->fromArray( $users );
			});
		})->export("xlsx");


	}










	public function exportAllStaffsToExcel( Request $request ){


		
		Excel::create( $request->filename, function( $excel ){
			$excel->sheet("users", function( $sheet ){

				$repositories = new UsersRepositories;
				$users = $repositories->getAllStaffsToExport();
				$users = json_decode(json_encode($users), true);

				$sheet->fromArray( $users );
			});
		})->export("xlsx");


	}

	public function exportAllActiveStaffsToExcel( Request $request ){

		
		
		Excel::create( $request->filename, function( $excel ){
			$excel->sheet("users", function( $sheet ){
				
				$repositories = new UsersRepositories;
				$users = $repositories->getAllActiveStaffsToExport();
				$users = json_decode(json_encode($users), true);

				$sheet->fromArray( $users );
			});
		})->export("xlsx");


	}

	public function exportAllNotActiveStaffsToExcel( Request $request ){

		
		
		Excel::create( $request->filename, function( $excel ){
			$excel->sheet("users", function( $sheet ){

				$repositories = new UsersRepositories;
				$users = $repositories->getAllNotActiveStaffsToExport();
				$users = json_decode(json_encode($users), true);

				$sheet->fromArray( $users );
			});
		})->export("xlsx");


	}
















}
