<?php

namespace App\Repositories;
use Vinkla\Hashids\Facades\Hashids;
use App\Developer;
use App\Project;
use DB;

class ClientsRepositories
{



    public  function EncodeHashModelId( $models ){

      foreach( $models as $model ){
        $model->id = Hashids::encode( $model->id );
        $model->person_id = Hashids::encode( $model->person_id );
      }

      return $models;
    }

    public  function EncodeHashId( $model ){

      $model->id = Hashids::encode( $model->id );
      $model->person_id = Hashids::encode( $model->person_id );

      return $model;

    }



    public function getAllClients()
    {
      $clients = DB::table('clients')
            ->select('clients.*', 'persons.firstname' , 'persons.lastname', 'persons.middlename', 'persons.gender' , 'persons.datebirth')
            ->join('persons', 'persons.id', '=', 'clients.person_id')
            ->get();
              
        return $this->EncodeHashModelId( $clients );

    }


    public function getClient( $id )
    {
      $client = DB::table('clients')
            ->select('clients.*', 'persons.firstname' , 'persons.lastname', 'persons.middlename', 'persons.gender' , 'persons.datebirth')
            ->join('persons', 'persons.id', '=', 'clients.person_id')
            ->where('clients.id', Hashids::decode( $id )[0] )
            ->first();
              
        return $this->EncodeHashId( $client );

    }



}