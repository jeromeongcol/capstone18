<?php

namespace App\Repositories;
use Vinkla\Hashids\Facades\Hashids;
use App\User;
use App\Role;
use DB;
use Auth;
use Hash;

class SalesRepositories
{


    public  function EncodeHashSalesId( $model ){

        $model->sales_id = Hashids::encode( $model->sales_id );
        $model->agent_id = Hashids::encode( $model->agent_id );
        $model->developer_id = Hashids::encode( $model->developer_id );
        $model->transaction_id = Hashids::encode( $model->transaction_id );
        $model->client_id = Hashids::encode( $model->client_id );
        $model->project_id = Hashids::encode( $model->project_id );

      return $model;
    }



    public  function EncodeHashSalesIds( $models ){

      foreach( $models as $model ){
        $model->sales_id = Hashids::encode( $model->sales_id );
        $model->agent_id = Hashids::encode( $model->agent_id );
        $model->developer_id = Hashids::encode( $model->developer_id );
        $model->transaction_id = Hashids::encode( $model->transaction_id );
        $model->client_id = Hashids::encode( $model->client_id );

      }

      return $models;
    }


    public function getAllSales()
    {
       
        $sales = DB::table('sales')
        ->select('sales.id as sales_id', 'sales.total_contract_price','sales.date_reserve', DB::raw('CONCAT(per1.lastname, ", ", per1.firstname, " ", per1.middlename) AS agent_name'), 'users.id as agent_id', 'developers.name as developer_name', 'developers.id as developer_id', 'transactions.id as transaction_id','transactions.project_name','transactions.project_location', DB::raw('CONCAT(per2.lastname, ", ", per2.firstname, " ", per2.middlename) AS client_name'), 'clients.id as client_id', 'sales.approved', 'sales.cancelled','transactions.assumed_commission')
        ->join('transactions', 'transactions.id', '=', 'sales.transaction_id')
        ->join('users', 'users.id', '=', 'transactions.agent_id')
        ->join('persons as per1', 'per1.id', '=', 'users.person_id')
        ->join('developers', 'developers.id', '=', 'transactions.developer_id')
        ->join('clients', 'clients.id', '=', 'transactions.client_id')
        ->join('persons as per2', 'per2.id', '=', 'clients.person_id')
        ->where('sales.approved', 1)
        ->where('sales.cancelled', 0)
        ->get();

        return $this->EncodeHashSalesIds($sales);

    }




    public function getAgentSales( $id)
    {
       
        $sales = DB::table('sales')
        ->select('sales.id as sales_id', 'sales.total_contract_price','sales.date_reserve', DB::raw('CONCAT(per1.lastname, ", ", per1.firstname, " ", per1.middlename) AS agent_name'), 'users.id as agent_id', 'developers.name as developer_name', 'developers.id as developer_id', 'transactions.id as transaction_id','transactions.project_name','transactions.project_location', DB::raw('CONCAT(per2.lastname, ", ", per2.firstname, " ", per2.middlename) AS client_name'), 'clients.id as client_id', 'sales.approved', 'sales.cancelled', 'project_types.type as category', 'transactions.assumed_commission')
        ->join('transactions', 'transactions.id', '=', 'sales.transaction_id')
        ->join('project_types', 'project_types.id' , 'transactions.project_type')
        ->join('users', 'users.id', '=', 'transactions.agent_id')
        ->join('persons as per1', 'per1.id', '=', 'users.person_id')
        ->join('developers', 'developers.id', '=', 'transactions.developer_id')
        ->join('clients', 'clients.id', '=', 'transactions.client_id')
        ->join('persons as per2', 'per2.id', '=', 'clients.person_id')
        ->where('users.id', $id )
        ->where('sales.approved', 1)
        ->where('sales.cancelled', 0)
        ->get();

        return $this->EncodeHashSalesIds($sales);

    }


    public function getAgentSalesByYearMonth( $id , $year, $month)
    {
       
        $sales = DB::table('sales')
        ->select('sales.id as sales_id', 'sales.total_contract_price','sales.date_reserve', DB::raw('CONCAT(per1.lastname, ", ", per1.firstname, " ", per1.middlename) AS agent_name'), 'users.id as agent_id', 'developers.name as developer_name', 'developers.id as developer_id', 'transactions.id as transaction_id','transactions.project_name','transactions.project_location', DB::raw('CONCAT(per2.lastname, ", ", per2.firstname, " ", per2.middlename) AS client_name'), 'clients.id as client_id', 'sales.approved', 'sales.cancelled', 'project_types.type as category','transactions.assumed_commission')
        ->join('transactions', 'transactions.id', '=', 'sales.transaction_id')
        ->join('project_types', 'project_types.id' , 'transactions.project_type')
        ->join('users', 'users.id', '=', 'transactions.agent_id')
        ->join('persons as per1', 'per1.id', '=', 'users.person_id')
        ->join('developers', 'developers.id', '=', 'transactions.developer_id')
        ->join('clients', 'clients.id', '=', 'transactions.client_id')
        ->join('persons as per2', 'per2.id', '=', 'clients.person_id')
        ->where('users.id', $id )
        ->where( DB::raw('YEAR(sales.date_reserve)'), $year)
        ->where( DB::raw('MONTH(sales.date_reserve)'), $month)
        ->where('sales.approved', 1)
        ->where('sales.cancelled', 0)
        ->get();

        return $this->EncodeHashSalesIds($sales);

    }



    public function getAgentSalesByMonth( $id , $month)
    {
       
        $sales = DB::table('sales')
        ->select('sales.id as sales_id', 'sales.total_contract_price','sales.date_reserve', DB::raw('CONCAT(per1.lastname, ", ", per1.firstname, " ", per1.middlename) AS agent_name'), 'users.id as agent_id', 'developers.name as developer_name', 'developers.id as developer_id', 'transactions.id as transaction_id','transactions.project_name','transactions.project_location', DB::raw('CONCAT(per2.lastname, ", ", per2.firstname, " ", per2.middlename) AS client_name'), 'clients.id as client_id', 'sales.approved', 'sales.cancelled', 'project_types.type as category','transactions.assumed_commission')
        ->join('transactions', 'transactions.id', '=', 'sales.transaction_id')
        ->join('project_types', 'project_types.id' , 'transactions.project_type')
        ->join('users', 'users.id', '=', 'transactions.agent_id')
        ->join('persons as per1', 'per1.id', '=', 'users.person_id')
        ->join('developers', 'developers.id', '=', 'transactions.developer_id')
        ->join('clients', 'clients.id', '=', 'transactions.client_id')
        ->join('persons as per2', 'per2.id', '=', 'clients.person_id')
        ->where('users.id', $id )
        ->where( DB::raw('MONTH(sales.date_reserve)'), $month)
        ->where('sales.approved', 1)
        ->where('sales.cancelled', 0)
        ->get();

        return $this->EncodeHashSalesIds($sales);

    }




    public function getAgentSalesByYear( $id , $year)
    {
       
        $sales = DB::table('sales')
        ->select('sales.id as sales_id', 'sales.total_contract_price','sales.date_reserve', DB::raw('CONCAT(per1.lastname, ", ", per1.firstname, " ", per1.middlename) AS agent_name'), 'users.id as agent_id', 'developers.name as developer_name', 'developers.id as developer_id', 'transactions.id as transaction_id','transactions.project_name','transactions.project_location', DB::raw('CONCAT(per2.lastname, ", ", per2.firstname, " ", per2.middlename) AS client_name'), 'clients.id as client_id', 'sales.approved', 'sales.cancelled', 'project_types.type as category','transactions.assumed_commission')
        ->join('transactions', 'transactions.id', '=', 'sales.transaction_id')
        ->join('project_types', 'project_types.id' , 'transactions.project_type')
        ->join('users', 'users.id', '=', 'transactions.agent_id')
        ->join('persons as per1', 'per1.id', '=', 'users.person_id')
        ->join('developers', 'developers.id', '=', 'transactions.developer_id')
        ->join('clients', 'clients.id', '=', 'transactions.client_id')
        ->join('persons as per2', 'per2.id', '=', 'clients.person_id')
        ->where('users.id', $id )
        ->where( DB::raw('YEAR(sales.date_reserve)'), $year)
        ->where('sales.approved', 1)
        ->where('sales.cancelled', 0)
        ->get();

        return $this->EncodeHashSalesIds($sales);

    }





    public function searchAgentSales( $id, $key )
    {
       
        $sales = DB::table('sales')
        ->select('sales.id as sales_id', 'sales.total_contract_price','sales.date_reserve', DB::raw('CONCAT(per1.lastname, ", ", per1.firstname, " ", per1.middlename) AS agent_name'), 'users.id as agent_id', 'developers.name as developer_name', 'developers.id as developer_id', 'transactions.id as transaction_id','transactions.project_name','transactions.project_location', DB::raw('CONCAT(per2.lastname, ", ", per2.firstname, " ", per2.middlename) AS client_name'), 'clients.id as client_id', 'sales.approved', 'sales.cancelled', 'project_types.type as category','transactions.assumed_commission')
        ->join('transactions', 'transactions.id', '=', 'sales.transaction_id')
        ->join('project_types', 'project_types.id' , 'transactions.project_type')
        ->join('users', 'users.id', '=', 'transactions.agent_id')
        ->join('persons as per1', 'per1.id', '=', 'users.person_id')
        ->join('developers', 'developers.id', '=', 'transactions.developer_id')
        ->join('clients', 'clients.id', '=', 'transactions.client_id')
        ->join('persons as per2', 'per2.id', '=', 'clients.person_id')
        ->where('users.id', $id )
        ->where('sales.approved', 1)
        ->where('sales.cancelled', 0)
        ->Where( function ($query) use ($key){

                  $query->where( 'transactions.project_name', 'LIKE', '%'.$key.'%' )
                        ->orwhere( 'transactions.project_location', 'LIKE', '%'.$key.'%' )
                        ->orwhere( 'transactions.project_type', 'LIKE', '%'.$key.'%' ) 
                        ->orwhere( 'project_types.type', 'LIKE', '%'.$key.'%' ) 
                        ->orwhere( 'sales.total_contract_price', 'LIKE', '%'.$key.'%' )
                        ->orwhere( 'sales.date_reserve', 'LIKE', '%'.$key.'%' )
                        ->orwhere( 'per2.lastname', 'LIKE', '%'.$key.'%' ) 
                        ->orwhere( 'per2.firstname', 'LIKE', '%'.$key.'%' ) 
                        ->orwhere( 'per2.middlename', 'LIKE', '%'.$key.'%' ) 
                        ->orwhere( 'developers.name', 'LIKE', '%'.$key.'%' ) ;
               })

        ->get();

        return $this->EncodeHashSalesIds($sales);

    }





    public function getAllPendingSales()
    {
       
        $sales = DB::table('sales')
        ->select('sales.id as sales_id', 'sales.total_contract_price','sales.date_reserve', DB::raw('CONCAT(per1.lastname, ", ", per1.firstname, " ", per1.middlename) AS agent_name'), 'users.id as agent_id', 'developers.name as developer_name', 'developers.id as developer_id', 'transactions.id as transaction_id','transactions.project_name','transactions.project_location', DB::raw('CONCAT(per2.lastname, ", ", per2.firstname, " ", per2.middlename) AS client_name'), 'clients.id as client_id', 'sales.approved', 'sales.cancelled','transactions.assumed_commission')
        ->join('transactions', 'transactions.id', '=', 'sales.transaction_id')
        ->join('users', 'users.id', '=', 'transactions.agent_id')
        ->join('persons as per1', 'per1.id', '=', 'users.person_id')
        ->join('developers', 'developers.id', '=', 'transactions.developer_id')
        ->join('clients', 'clients.id', '=', 'transactions.client_id')
        ->join('persons as per2', 'per2.id', '=', 'clients.person_id')
        ->where('sales.approved', 0)
        ->get();

        return $this->EncodeHashSalesIds($sales);

    }



    public function getAllCancelledSales()
    {
       
        $sales = DB::table('sales')
        ->select('sales.id as sales_id', 'sales.total_contract_price','sales.date_reserve', DB::raw('CONCAT(per1.lastname, ", ", per1.firstname, " ", per1.middlename) AS agent_name'), 'users.id as agent_id', 'developers.name as developer_name', 'developers.id as developer_id', 'transactions.id as transaction_id','transactions.project_name','transactions.project_location', DB::raw('CONCAT(per2.lastname, ", ", per2.firstname, " ", per2.middlename) AS client_name'), 'clients.id as client_id', 'sales.approved', 'sales.cancelled','transactions.assumed_commission')
        ->join('transactions', 'transactions.id', '=', 'sales.transaction_id')
        ->join('users', 'users.id', '=', 'transactions.agent_id')
        ->join('persons as per1', 'per1.id', '=', 'users.person_id')
        ->join('developers', 'developers.id', '=', 'transactions.developer_id')
        ->join('clients', 'clients.id', '=', 'transactions.client_id')
        ->join('persons as per2', 'per2.id', '=', 'clients.person_id')
        ->where('sales.cancelled', 1)
        ->get();

        return $this->EncodeHashSalesIds($sales);

    }


    public function getSales( $id )
    {
       
        $sales = DB::table('sales')
        ->select('sales.id as sales_id', 'sales.total_contract_price','sales.date_reserve', DB::raw('CONCAT(per1.lastname, ", ", per1.firstname, " ", per1.middlename) AS agent_name'), 'users.id as agent_id', 'developers.name as developer_name', 'developers.id as developer_id', 'transactions.id as transaction_id','transactions.project_name','transactions.project_location', DB::raw('CONCAT(per2.lastname, ", ", per2.firstname, " ", per2.middlename) AS client_name'), 'clients.id as client_id', 'clients.email as client_email', 'clients.contact_number as client_contact_number', 'per2.firstname as client_firstname', 'per2.lastname as client_lastname', 'per2.middlename as client_middlename', 'per2.gender as client_gender', 'per2.datebirth as client_datebirth', 'projects.id as project_id', 'projects.featured_photo', 'agent_rank_types.rank as agent_rank', 'sales.approved', 'sales.cancelled')
        ->join('transactions', 'transactions.id', '=', 'sales.transaction_id','transactions.assumed_commission')
        ->join('users', 'users.id', '=', 'transactions.agent_id')
        ->join('agent_ranks', 'agent_ranks.agent_id', '=', 'users.id')
        ->join('agent_rank_types', 'agent_rank_types.id', '=', 'agent_ranks.rank_type_id')
        ->join('persons as per1', 'per1.id', '=', 'users.person_id')
        ->join('developers', 'developers.id', '=', 'transactions.developer_id')
        ->join('projects', 'projects.id', '=', 'transactions.project_id')
        ->join('clients', 'clients.id', '=', 'transactions.client_id')
        ->join('persons as per2', 'per2.id', '=', 'clients.person_id')
        ->where('sales.id' ,  Hashids::decode( $id ) )
        ->first();

        return $this->EncodeHashSalesId($sales);

    }


    public function getSalesWillProjectDetails( $id )
    {
       
        $sales = DB::table('sales')
        ->select('sales.id as sales_id',
                'sales.total_contract_price',
                'sales.date_reserve',
                DB::raw('CONCAT(per1.lastname, ", ", per1.firstname, " ", per1.middlename) AS agent_name'),
                'users.email as agent_email',
                'users.id as agent_id',
                'developers.name as developer_name',
                'developers.id as developer_id', 
                'transactions.id as transaction_id',
                'transactions.project_name',
                'transactions.project_location',
                DB::raw('CONCAT(per2.lastname, ", ", per2.firstname, " ", per2.middlename) AS client_name'),
                'per2.lastname as client_lastname',
                'per2.firstname as client_firstname',
                'per2.middlename as client_middlename',
                'clients.id as client_id', 
                'projects.id as project_id',
                'transactions.project_description',
                'projects.featured_photo', 
                'project_types.type as project_type', 
                'agent_rank_types.rank as agent_rank', 
                'sales.approved', 'sales.cancelled',
                'transactions.assumed_commission')
        ->join('transactions', 'transactions.id', '=', 'sales.transaction_id')
        ->join('users', 'users.id', '=', 'transactions.agent_id')
        ->join('agent_ranks', 'agent_ranks.agent_id', '=', 'users.id')
        ->join('agent_rank_types', 'agent_rank_types.id', '=', 'agent_ranks.rank_type_id')
        ->join('persons as per1', 'per1.id', '=', 'users.person_id')
        ->join('developers', 'developers.id', '=', 'transactions.developer_id')
        ->join('projects', 'projects.id', '=', 'transactions.project_id')
        ->join('project_types', 'project_types.id', '=', 'projects.project_type_id')
        ->join('clients', 'clients.id', '=', 'transactions.client_id')
        ->join('persons as per2', 'per2.id', '=', 'clients.person_id')
        ->where('sales.id' ,  Hashids::decode( $id ) )
        ->first();

        return $this->EncodeHashSalesId($sales);

    }




}