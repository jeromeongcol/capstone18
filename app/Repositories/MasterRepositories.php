<?php

namespace App\Repositories;
use Vinkla\Hashids\Facades\Hashids;
use DB;

class MasterRepositories
{


  public  function EncodeHashModelId( $models ){


      foreach( $models as $model ){
        $model->id = Hashids::encode( $model->id );
      }

      return $models;

    }


  public  function getDownlines( $agent_id ){

     $downlines = DB::table('agents_details')
                  ->select('users.id', 'users.email',  DB::raw('CONCAT(persons.lastname, ", ", persons.firstname, " ", persons.middlename) AS name'),'avatars.photo', 'agents_details.updated_at as created_at')
                  ->join('users', 'users.id', '=', 'agents_details.agent_id')
                  ->join('persons', 'persons.id', '=', 'users.person_id')
                  ->join('avatars', 'avatars.user_id', '=', 'users.id')
                  ->where('agents_details.recruiter', Hashids::decode( $agent_id )[0] )
                  ->latest()
                  ->get();

    return $this->EncodeHashModelId($downlines);


    }


  public  function getAgentSales( $agent_id ){

     $agentsales = DB::table('transactions')
                  ->select('users.id', 'users.email',  DB::raw('CONCAT(persons.lastname, ", ", persons.firstname, " ", persons.middlename) AS name'), 'transactions.updated_at as created_at', 'sales.total_contract_price', 'sales.date_reserve')
                  ->join('users', 'users.id', '=', 'transactions.agent_id')
                  ->join('persons', 'persons.id', '=', 'users.person_id')
                  ->join('sales', 'sales.transaction_id', '=', 'transactions.id')
                  ->where('transactions.agent_id', Hashids::decode( $agent_id )[0] )
                  ->latest()
                  ->get();

    return $this->EncodeHashModelId($agentsales);


    }


  public  function countDownlines( $agent_id ){

     $downlines = DB::table('agents_details')
                  ->select('users.id', 'users.email',  DB::raw('CONCAT(persons.lastname, ", ", persons.firstname, " ", persons.middlename) AS name'), 'agents_details.created_at')
                  ->join('users', 'users.id', '=', 'agents_details.agent_id')
                  ->join('persons', 'persons.id', '=', 'users.person_id')
                  ->where('agents_details.recruiter', Hashids::decode( $agent_id )[0] )
                  ->count();
                  
    return $this->EncodeHashModelId($downlines);


    }








}