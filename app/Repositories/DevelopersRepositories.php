<?php

namespace App\Repositories;
use Vinkla\Hashids\Facades\Hashids;
use App\Developer;
use App\Project;
use DB;

class DevelopersRepositories
{

    public  function EncodeHashProjectsId( $models ){

      foreach( $models as $model ){
        $model->id = Hashids::encode( $model->id );
        $model->developer_id = Hashids::encode( $model->developer_id );
        $model->project_type_id = Hashids::encode( $model->project_type_id );
        $model->added_by = Hashids::encode( $model->added_by );
      }

      return $models;
    }



    public  function EncodeHashProjectId( $model ){

      $model->id = Hashids::encode( $model->id );
      $model->developer_id = Hashids::encode( $model->developer_id );
      $model->project_type_id = Hashids::encode( $model->project_type_id );
      $model->added_by = Hashids::encode( $model->added_by );

      return $model;

    }



    public  function EncodeHashModelId( $models ){

      foreach( $models as $model ){
        $model->id = Hashids::encode( $model->id );
      }

      return $models;
    }

    public  function EncodeHashId( $model ){

      $model->id = Hashids::encode( $model->id );

      return $model;

    }



    public function getAllActiveDevelopers()
    {
      $devs = DB::table('developers')
              ->where('active', 1 )
              ->get();
              
        return $this->EncodeHashModelId( $devs );

    }

    public function getAllDevelopers()
    {
      $devs = DB::table('developers')->get();
              
        return $this->EncodeHashModelId( $devs );

    }

    public function getDeveloper( $id )
    {
      $devs = DB::table('developers')
              ->where('id', Hashids::decode( $id )[0] )
              ->first();
              
      return $this->EncodeHashId( $devs );

    }




    public function getAllProjects()
    {
      $projects = DB::table('projects')
                  ->select('projects.*', 'users.email' , 'users.created_at' , 'developers.name as developer', 'project_types.type as category')
                  ->join('developers', 'developers.id' , 'projects.developer_id')
                  ->join('project_types', 'project_types.id' , 'projects.project_type_id')
                  ->join('users', 'users.id', '=', 'projects.added_by')
                  ->get();
               
      return $this->EncodeHashProjectsId( $projects );

    }



    public function getAllProjectsByDeveloper( $id )
    {
      $projects = DB::table('projects')
                  ->select('projects.*', 'users.email' , 'users.created_at' , 'developers.name as developer', 'project_types.type as category')
                  ->join('developers', 'developers.id' , 'projects.developer_id')
                  ->join('project_types', 'project_types.id' , 'projects.project_type_id')
                  ->join('users', 'users.id', '=', 'projects.added_by')
                  ->where("developers.id", Hashids::decode( $id )[0])
                  ->get();
               
      return $this->EncodeHashProjectsId( $projects );

    }


    public function getAllProjectPhotos( $project_id )
    {
      $photos = DB::table('project_photos')
                  ->where( 'project_id' , Hashids::decode( $project_id )[0] )
                  ->get();
               
      return $this->EncodeHashModelId( $photos );

    }





    public function getTop10Project_Latest()
    {
      
      $projects = DB::table('projects')
                  ->select('projects.*', 'users.email' , 'users.created_at', 'project_types.type')
                  ->join('users', 'users.id', '=', 'projects.added_by')
                  ->join('project_types', 'project_types.id', '=', 'projects.project_type_id')
                  ->where('projects.deleted', 0)
                  ->orderBy( 'projects.created_at' ,'desc')
                  ->take(10)
                  ->get();
               
      return $this->EncodeHashProjectsId( $projects );

    }


    public function getTop9Project_Latest()
    {
      
      $projects = DB::table('projects')
                  ->select('projects.*', 'users.email' , 'users.created_at', 'project_types.type')
                  ->join('users', 'users.id', '=', 'projects.added_by')
                  ->join('project_types', 'project_types.id', '=', 'projects.project_type_id')
                  ->where('projects.deleted', 0)
                  ->orderBy( 'projects.created_at' ,'desc')
                  ->take(9)
                  ->get();
               
      return $this->EncodeHashProjectsId( $projects );

    }






    public function getAllActiveProjects()
    {
      
      $projects = DB::table('projects')
                  ->select('projects.*', 'users.email' , 'users.created_at', 'project_types.type')
                  ->join('users', 'users.id', '=', 'projects.added_by')
                  ->join('project_types', 'project_types.id', '=', 'projects.project_type_id')
                  ->where('projects.deleted', 0)
                  ->get();
               
      return $this->EncodeHashProjectsId( $projects );

    }




    public function getAllActiveProjectsForAgent()
    {
      
      $projects = DB::table('projects')
                  ->select('projects.*', 'users.email' , 'users.created_at', 'project_types.type')
                  ->join('users', 'users.id', '=', 'projects.added_by')
                  ->join('project_types', 'project_types.id', '=', 'projects.project_type_id')
                  ->where('projects.deleted', 0)
                  ->paginate(9);
               
      return $this->EncodeHashProjectsId( $projects );

    }




    public function searchProjectForAgent($key)
    {
      
      $project = DB::table('projects')
                  ->select('projects.*', 'users.email' , 'users.created_at', 'project_types.type')
                  ->join('developers', 'developers.id', '=', 'projects.developer_id')
                  ->join('project_types', 'project_types.id', '=', 'projects.project_type_id')
                  ->join('users', 'users.id', '=', 'projects.added_by')
                  ->Where( function ($query) use ($key){
                      $query->where( 'projects.project_name', 'LIKE', '%'.$key.'%' )
                            ->orwhere( 'projects.project_location', 'LIKE', '%'.$key.'%' )
                            ->orwhere( 'developers.name', 'LIKE', '%'.$key.'%' )
                            ->orwhere( 'project_types.type', 'LIKE', '%'.$key.'%' );
                  })
                  ->paginate(9);
              
      return $this->EncodeHashProjectsId( $project );

    }


    public function getAllActiveProjectsByProjectCategory( $id )
    {
      
      $projects = DB::table('projects')
                  ->select('projects.*', 'users.email' , 'users.created_at', 'project_types.type')
                  ->join('users', 'users.id', '=', 'projects.added_by')
                  ->join('project_types', 'project_types.id', '=', 'projects.project_type_id')
                  ->where('project_types.id', Hashids::decode( $id )[0])
                  ->where('projects.deleted', 0)
                  ->paginate(9);
               
      return $this->EncodeHashProjectsId( $projects );

    }



    public function getProject($id)
    {
      
      $project = DB::table('projects')
                  ->where('id', Hashids::decode( $id )[0] )
                  ->first();
              
      return $this->EncodeHashProjectId( $project );

    }



    public function viewProject($id)
    {
      
     $project = DB::table('projects')
                  ->select('projects.*', 'users.email' , 'users.created_at', 'project_types.type', 'developers.name as developer_name', 'developers.fax', 'developers.address', 'developers.logo', 'developers.contact')
                  ->join('users', 'users.id', '=', 'projects.added_by')
                  ->join('project_types', 'project_types.id', '=', 'projects.project_type_id')
                  ->join('developers', 'developers.id', '=', 'projects.developer_id')
                  ->where('projects.id', Hashids::decode( $id )[0])
                  ->first();
              
      return $this->EncodeHashProjectId( $project );

    }
    
    public function searchProject($key)
    {
      
      $project = DB::table('projects')
                  ->select('projects.*', 'users.email' , 'users.created_at', 'project_types.type')
                  ->join('developers', 'developers.id', '=', 'projects.developer_id')
                  ->join('project_types', 'project_types.id', '=', 'projects.project_type_id')
                  ->join('users', 'users.id', '=', 'projects.added_by')
                  ->Where( function ($query) use ($key){
                      $query->where( 'projects.project_name', 'LIKE', '%'.$key.'%' )
                            ->orwhere( 'projects.project_location', 'LIKE', '%'.$key.'%' )
                            ->orwhere( 'developers.name', 'LIKE', '%'.$key.'%' )
                            ->orwhere( 'project_types.type', 'LIKE', '%'.$key.'%' );
                  })
                  ->get();
              
      return $this->EncodeHashProjectsId( $project );

    }



    public function getAllProjectTypes()
    {
      $types = DB::table('project_types')->get();
              
      return $this->EncodeHashModelId( $types );

    }

    public function getAllActiveProjectTypes()
    {
      $types = DB::table('project_types')
             ->where('deleted','0')
             ->get();
             
      return $this->EncodeHashModelId( $types );

    }



}