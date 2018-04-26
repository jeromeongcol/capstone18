<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Repositories\UsersRepositories;
use App\Repositories\MasterRepositories;
use App\Repositories\SalesRepositories;
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
use Route;
use DB;
use Carbon\Carbon;



class DashboardController extends Controller
{
    	 /**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
    public function index(Request $request)
    {  
    	$repositories = new UsersRepositories;
    	$auth = $repositories->getUser( Hashids::encode ( Auth::user()->id ) );

    	$sales_repositories = new SalesRepositories;
		$sales = $sales_repositories->getAllSales();

		$years = DB::table('sales')
				->select( DB::raw('YEAR(sales.date_reserve) as year') )
				->distinct( DB::raw('YEAR(date_reserve)') )
				->orderBy( 'year', 'DESC')
				->get();

		$years = collect($years);
		$years = $years->pluck('year');

		if( $request->ajax() ){

          $content = view('dashboard.index')->with(compact('auth','years'))->render();
          return response()->json(['content'=> $content ]);
      	}
      	
      	$content = view('dashboard.index')->with(compact('years'))->render();
        return view('dashboard.dashboard', compact( 'auth','content' ));
    }



    public function getSalesByYear( Request $request ){



    	$sales = DB::table('sales')
				->select( 'total_contract_price as price',  DB::raw('MONTH(sales.date_reserve) as month') ) 
				->whereYear('date_reserve' , $request->year )
				->orderBy( DB::raw('MONTH(sales.date_reserve)') , 'ASC' )
				->get();

		$collection = collect($sales);
		$collection = $collection->groupBy('month')->flatMap(function ($items) {
		    $quantity = $items->sum('price');
		    return $items->map(function ($item) use ($quantity) {
		        $item->quantity = $quantity;
		        return $item;
		    });

		});

		$collection = $collection->unique('month');

		$yearData = [0,0,0,0,0,0,0,0,0,0,0,0];
		$YearTotalSales = 0;

		foreach ($collection as $dataYearly) {
			$YearTotalSales = $YearTotalSales + $dataYearly->quantity;
		}

		foreach ($collection as $dataYearly) {
			$yearData [$dataYearly->month -1 ] = $dataYearly->quantity ;//round( ( $dataYearly->quantity * 100 ) / $YearTotalSales,2);
		}

		return response()->json( [ 'yearData' => $yearData , 'sa' => $YearTotalSales] );

    }



}
