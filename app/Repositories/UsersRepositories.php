<?php

namespace App\Repositories;
use Vinkla\Hashids\Facades\Hashids;
use App\User;
use App\Role;
use DB;
use Auth;
use Hash;
use App\AgentDetails;
use Illuminate\Support\Collection;


class UsersRepositories
{

    public  function EncodeHashModelIds( $models ){

      foreach( $models as $model ){
        $model->id = Hashids::encode( $model->id );
        if( !empty($model->recruiter) ){ $model->recruiter = Hashids::encode( $model->recruiter ); }
      }

      return $models;
    }

    public  function EncodeHashModelId( $model ){

        $model->id = Hashids::encode( $model->id );

      return $model;
    }

   public  function EncodeHashUsersId( $users ){

      foreach( $users as $user ){
        $user->id = Hashids::encode( $user->id );
      }

      return $users;
    }

    public  function EncodeHashUserId( $user ){

      $user->user_id = Hashids::encode( $user->user_id );
      $user->id = Hashids::encode( $user->id );
      if( !empty($user->recruiter) ){ $user->recruiter = Hashids::encode( $user->recruiter ); }
      return $user;

    }


    public  function EncodeHashProjectIds( $models ){

      foreach( $models as $model ){

        $model->id = Hashids::encode( $model->id );
        $model->developer_id = Hashids::encode( $model->developer_id );
      }

      return $models;
    }





    public function treeview()
    {


      $parent = DB::table('users')
          ->select('users.id', DB::raw('CONCAT(persons.lastname, ", ", persons.firstname, " ", persons.middlename) AS fullname') , 'avatars.photo' , 'avatars.photo_thumb','agent_rank_types.rank AS rank')
          ->join('persons', 'persons.id', '=', 'users.person_id')
          ->join('roles', 'roles.id', '=', 'users.role_id')
          ->join('avatars', 'avatars.user_id', '=', 'users.id')
          ->join('agent_ranks', 'agent_ranks.agent_id', '=', 'users.id')
          ->join('agents_details', 'agents_details.agent_id', '=', 'users.id')
          ->join('agent_rank_types', 'agent_rank_types.id', '=', 'agent_ranks.rank_type_id')
          ->where('agents_details.recruiter', 1 )
          ->where('roles.name','Agent')
          ->first(); 






      $child = DB::table('users')
          ->select('users.id', DB::raw('CONCAT(persons.lastname, ", ", persons.firstname, " ", persons.middlename) AS fullname') , 'avatars.photo' , 'avatars.photo_thumb','agent_rank_types.rank AS rank')
          ->join('persons', 'persons.id', '=', 'users.person_id')
          ->join('roles', 'roles.id', '=', 'users.role_id')
          ->join('avatars', 'avatars.user_id', '=', 'users.id')
          ->join('agent_ranks', 'agent_ranks.agent_id', '=', 'users.id')
          ->join('agents_details', 'agents_details.agent_id', '=', 'users.id')
          ->join('agent_rank_types', 'agent_rank_types.id', '=', 'agent_ranks.rank_type_id')
          ->where('agents_details.recruiter', $parent->id )
          ->where('roles.name','Agent')
          ->get();




      $items = DB::table('agents_details')->get();



       return $items;

    }



    public function Agents()
    {
       
      $users = DB::table('users')
              ->select('users.id','users.email','users.active', 'persons.lastname', 'persons.firstname', 'persons.middlename', 'avatars.photo' , 'avatars.photo_thumb','agent_rank_types.rank AS rank','agents_details.approved', 'agents_details.recruits as downlines', 'developers.name as affiliate_developer')
              ->join('persons', 'persons.id', '=', 'users.person_id')
              ->join('avatars', 'avatars.user_id', '=', 'users.id')
              ->join('roles', 'roles.id', '=', 'users.role_id')
              ->join('agent_ranks', 'agent_ranks.agent_id', '=', 'users.id')
              ->join('agent_rank_types', 'agent_rank_types.id', '=', 'agent_ranks.rank_type_id')
              ->join('agents_details', 'agents_details.agent_id', '=', 'users.id')
              ->leftjoin('agent_affiliate_developers', 'agent_affiliate_developers.agent_id', '=', 'users.id')
              ->leftjoin('developers', 'developers.id', '=', 'agent_affiliate_developers.developer_id')
              ->where('roles.name','Agent')
              ->get();

      return $this->EncodeHashUsersId( $users );

    }




    public function Agents_Active()
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
              ->where('users.active',1)
              ->get();

      return $this->EncodeHashUsersId( $users );

    }




    public function Agents_NotActive()
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
              ->where('users.active',0)
              ->get();

      return $this->EncodeHashUsersId( $users );

    }






    public function Staffs()
    {
       
       $users = DB::table('users')
              ->select('users.id','users.email','users.active','persons.lastname', 'persons.firstname', 'persons.middlename' , 'avatars.photo' , 'avatars.photo_thumb')
              ->join('persons', 'persons.id', '=', 'users.person_id')
              ->join('avatars', 'avatars.user_id', '=', 'users.id')
              ->join('roles', 'roles.id', '=', 'users.role_id')
              ->where('roles.name','Staff')
              ->get();

        return $this->EncodeHashUsersId( $users );

    }


    public function Admins()
    {
       
       $users = DB::table('users')
              ->select('users.id','users.email','users.active', 'persons.lastname' , 'persons.firstname', 'persons.middlename' , 'avatars.photo' , 'avatars.photo_thumb')
              ->join('persons', 'persons.id', '=', 'users.person_id')
              ->join('avatars', 'avatars.user_id', '=', 'users.id')
              ->join('roles', 'roles.id', '=', 'users.role_id')
              ->where('roles.name','Admin')
              ->get();

        return $this->EncodeHashUsersId( $users );

    }





    public function Recruiters()
    {
       
        $users = DB::table('users')
        ->select(DB::raw('CONCAT(persons.lastname, ", ", persons.firstname, " ", persons.middlename) AS fullname'), 'users.id', 'agent_rank_types.rank AS rank', 'users.email', 'agents_details.recruiter')
        ->join('persons', 'persons.id', '=', 'users.person_id')
        ->join('roles', 'roles.id', '=', 'users.role_id')
        ->join('agent_ranks', 'agent_ranks.agent_id', '=', 'users.id')
        ->join('agent_rank_types', 'agent_rank_types.id', '=', 'agent_ranks.rank_type_id')
        ->join('agents_details', 'agents_details.agent_id', '=', 'users.id')
        ->where('roles.name','Agent')
        ->get();

        return  $this->EncodeHashModelIds( $users );

    }



    public function SearchAgent( $key )
    {
       
        $users = DB::table('users')
        ->select(DB::raw('CONCAT(persons.lastname, ", ", persons.firstname, " ", persons.middlename) AS fullname'), 'users.id', 'agent_rank_types.rank AS rank', 'users.email')
        ->join('persons', 'persons.id', '=', 'users.person_id')
        ->join('roles', 'roles.id', '=', 'users.role_id')
        ->join('agent_ranks', 'agent_ranks.agent_id', '=', 'users.id')
        ->join('agent_rank_types', 'agent_rank_types.id', '=', 'agent_ranks.rank_type_id')
        ->where('roles.name','Agent')
        ->Where( function ($query) use ($key){

                  $query->where( 'persons.firstname', 'LIKE', '%'.$key.'%' )
                        ->orwhere( 'persons.lastname', 'LIKE', '%'.$key.'%' ) 
                        ->orwhere( 'persons.middlename', 'LIKE', '%'.$key.'%')
                        ->orwhere( 'users.email', 'LIKE', '%'.$key.'%' );
        })
        ->get();

        return  $this->EncodeHashModelIds( $users );

    }







    public function getAgentNames()
    {
     
          $user = DB::table('users')
          ->select(DB::raw('CONCAT(persons.lastname, ", ", persons.firstname, " ", persons.middlename) AS fullname') )
          ->join('persons', 'persons.id', '=', 'users.person_id')
          ->join('avatars', 'avatars.user_id', '=', 'users.id')
          ->join('roles', 'roles.id', '=', 'users.role_id')
          ->join('agent_ranks', 'agent_ranks.agent_id', '=', 'users.id')
          ->join('agents_details', 'agents_details.agent_id', '=', 'users.id')
          ->join('agent_rank_types', 'agent_rank_types.id', '=', 'agent_ranks.rank_type_id')
          ->where('roles.name', 'Agent' )
          ->get();

        return  $user;

    }












    public function getUser( $id )
    {
      $id  = Hashids::decode( $id );

      if(   Role::where( 'id', User::where('id', $id )->first()->role_id )->first()->name == "Agent" ){

          $user = DB::table('users')
          ->select('users.*', 'persons.*' , 'avatars.*' , 'roles.name as role', 'agent_ranks.*' , 'agent_rank_types.*', 'agents_details.approved', 'agents_details.recruiter')
          ->join('persons', 'persons.id', '=', 'users.person_id')
          ->join('avatars', 'avatars.user_id', '=', 'users.id')
          ->join('roles', 'roles.id', '=', 'users.role_id')
          ->join('agent_ranks', 'agent_ranks.agent_id', '=', 'users.id')
          ->join('agents_details', 'agents_details.agent_id', '=', 'users.id')
          ->join('agent_rank_types', 'agent_rank_types.id', '=', 'agent_ranks.rank_type_id')
          ->where('users.id', $id )
          ->first();

        return $this->EncodeHashUserId( $user );

      }else{

         $user = DB::table('users')
              ->select('users.*', 'persons.*' , 'avatars.*' , 'roles.name as role')
              ->join('persons', 'persons.id', '=', 'users.person_id')
              ->join('avatars', 'avatars.user_id', '=', 'users.id')
              ->join('roles', 'roles.id', '=', 'users.role_id')
              ->where('users.id', $id )
              ->first();

        return $this->EncodeHashUserId( $user );
      }
    }





    public function getUserForNotification( $id )
    {
      $id  = Hashids::decode( $id );

      if(   Role::where( 'id', User::where('id', $id )->first()->role_id )->first()->name == "Agent" ){

          $user = DB::table('users')
          ->select('users.email', DB::raw('CONCAT(persons.lastname, ", ", persons.firstname, " ", persons.middlename) AS fullname') , 'avatars.photo' , 'roles.name as role', 'agent_rank_types.rank')
          ->join('persons', 'persons.id', '=', 'users.person_id')
          ->join('avatars', 'avatars.user_id', '=', 'users.id')
          ->join('roles', 'roles.id', '=', 'users.role_id')
          ->join('agent_ranks', 'agent_ranks.agent_id', '=', 'users.id')
          ->where('users.id', $id )
          ->first();

        return $user;

      }else{

         $user = DB::table('users')
              ->select('users.email', DB::raw('CONCAT(persons.lastname, ", ", persons.firstname, " ", persons.middlename) AS fullname') , 'avatars.photo' , 'roles.name as role')
              ->join('persons', 'persons.id', '=', 'users.person_id')
              ->join('avatars', 'avatars.user_id', '=', 'users.id')
              ->join('roles', 'roles.id', '=', 'users.role_id')
              ->where('users.id', $id )
              ->first();

        return $user;
      }
    }




    public function getRecruiter( $id )
    { 
       $id  = Hashids::decode( $id );
       
          $user = DB::table('users')
          ->select('users.*', 'persons.*' , 'avatars.*' , 'roles.name as role', 'agent_ranks.*' , 'agent_rank_types.*', 'agents_details.approved')
          ->join('persons', 'persons.id', '=', 'users.person_id')
          ->join('avatars', 'avatars.user_id', '=', 'users.id')
          ->join('roles', 'roles.id', '=', 'users.role_id')
          ->join('agent_ranks', 'agent_ranks.agent_id', '=', 'users.id')
          ->join('agents_details', 'agents_details.agent_id', '=', 'users.id')
          ->join('agent_rank_types', 'agent_rank_types.id', '=', 'agent_ranks.rank_type_id')
          ->where('users.id', $id )
          ->first();

          if( empty($user) ){
            $user = $this->getUser( Hashids::encode( User::where('role_id', Role::where('name','SuperAdmin')->first()->id )->first()->id ) );
          }

        return $this->EncodeHashUserId( $user );
    }



   public function AgentRanks()
    {

        $ranks = DB::table('agent_rank_types')->get();

        return $this->EncodeHashModelIds( $ranks );
    }


    public function getAgentRank( $id ){

      $ranks = DB::table('agent_rank_types')
              ->where('id', Hashids::decode( $id )[0] )
              ->first();

      return $this->EncodeHashModelId( $ranks );

    }






   public function getRoles()
    {

         $roles = DB::table('roles')->get();

        return $roles ;
    }


    public function AuthRole(){

      return Role::find( Auth::user()->role_id )->name;
    }




    public function getAllAgents()
    {
       
        $users = DB::table('users')
        ->select(DB::raw('CONCAT(persons.lastname, ", ", persons.firstname, " ", persons.middlename) AS fullname'))
        ->join('persons', 'persons.id', '=', 'users.person_id')
        ->join('roles', 'roles.id', '=', 'users.role_id')
        ->where('roles.name','Agent')
        ->get();

        return $users;

    }





    public function SearchDeveloper( $key )
    {
       
        $developers = DB::table('developers')
        ->select('developers.name as developer_name', 'developers.id')
        ->where('developers.active','1')
        ->Where( function ($query) use ($key){
            $query->where( 'developers.name', 'LIKE', '%'.$key.'%' );
        })
        ->get();


        return  $this->EncodeHashModelIds( $developers );

    }





    public function SearchDeveloperById( $key )
    {
       
        $developer = DB::table('developers')
        ->select('developers.name as developer_name', 'developers.id')
        ->where('developers.id', Hashids::decode( $key )[0] )
        ->get();


        return  $this->EncodeHashModelIds( $developer );

    }





    public function SearchProjectById( $key )
    {
       
        $developer = DB::table('projects')
          ->select('projects.project_name', 'projects.id', 'projects.developer_id', 'projects.project_price','projects.project_location', 'projects.project_price')
          ->where('projects.developer_id', Hashids::decode( $key )[0] )
          ->where('projects.deleted','0')
          ->get();


        return  $this->EncodeHashProjectIds( $developer );

    }



    
    public function SearchProject( $key )
    {
       
        $projects = DB::table('projects')
        ->select('projects.project_name', 'projects.id', 'projects.developer_id', 'projects.project_price', 'projects.project_location', 'projects.project_price')
        ->where('projects.deleted','0')
        ->Where( function ($query) use ($key){
            $query->where( 'projects.project_name', 'LIKE', '%'.$key.'%' );
        })
        ->get();


        return  $this->EncodeHashProjectIds( $projects );

    }





    public function getAllUsers()
    {
       
       if( $this->AuthRole() == 'SuperAdmin' )
          return $users = $this->UserList_ForSuperAdmin();

      if( $this->AuthRole() == 'Admin' )
          return $users= $this->UserList_ForAdmin();
            
      if( $this->AuthRole() == 'Staff' )
          return $users = $this->UserList_ForStaff();

    }




    public function UserList_ForSuperAdmin()
    {
       
        $users = DB::table('users')
              ->select('users.*', 'persons.*' , 'avatars.*' , 'roles.name as role')
              ->join('persons', 'persons.id', '=', 'users.person_id')
              ->join('avatars', 'avatars.user_id', '=', 'users.id')
              ->join('roles', 'roles.id', '=', 'users.role_id')
              ->where('roles.name','Admin')
              ->orwhere('roles.name','Staff')
              ->orwhere('roles.name','Agent')
              ->get();

        return $this->EncodeHashUsersId( $users );

    }


    public function UserList_ForAdmin()
    {
       
        $users = DB::table('users')
              ->select('users.*', 'persons.*' , 'avatars.*' , 'roles.name as role')
              ->join('persons', 'persons.id', '=', 'users.person_id')
              ->join('avatars', 'avatars.user_id', '=', 'users.id')
              ->join('roles', 'roles.id', '=', 'users.role_id')
              ->where('roles.name','Staff')
              ->orwhere('roles.name','Agent')
              ->get();

        return $this->EncodeHashUsersId( $users );

    }



    public function UserList_ForStaff()
    {
       
        $users = DB::table('users')
              ->select('users.*', 'persons.*' , 'avatars.*' , 'roles.name as role')
              ->join('persons', 'persons.id', '=', 'users.person_id')
              ->join('avatars', 'avatars.user_id', '=', 'users.id')
              ->join('roles', 'roles.id', '=', 'users.role_id')
              ->where('roles.name','Agent')
              ->get();

        return $this->EncodeHashUsersId( $users );

    }







    public function getAllUsersToExport()
    {
         $users = DB::table('users')
              ->select('persons.lastname' , 'persons.firstname',  'persons.middlename' , 'users.email', 'users.active', 'roles.name as role_name as role')
              ->join('persons', 'persons.id', '=', 'users.person_id')
              ->join('avatars', 'avatars.user_id', '=', 'users.id')
              ->join('roles', 'roles.id', '=', 'users.role_id')
              ->get();

        return $users;
    }






    public function getAllActiveUsersToExport()
    {
         $users = DB::table('users')
              ->select('persons.lastname' , 'persons.firstname', 'persons.middlename', 'users.email', 'users.active', 'roles.name as role_name as role')
              ->join('persons', 'persons.id', '=', 'users.person_id')
              ->join('avatars', 'avatars.user_id', '=', 'users.id')
              ->join('roles', 'roles.id', '=', 'users.role_id')
              ->where('users.active', '1' )
              ->get();

        return $users;
    }


    public function getAllNotActiveUsersToExport()
    {
         $users = DB::table('users')
              ->select('persons.lastname' , 'persons.firstname',  'persons.middlename', 'users.email', 'users.active', 'roles.name as role_name as role')
              ->join('persons', 'persons.id', '=', 'users.person_id')
              ->join('avatars', 'avatars.user_id', '=', 'users.id')
              ->join('roles', 'roles.id', '=', 'users.role_id')
              ->where('users.active', '0' )
              ->get();

        return $users;
    }










    public function getAllAgentsToExport()
    {
         $users = DB::table('users as us1')
              ->select('persons.lastname' ,'persons.firstname', 'persons.middlename' , 'us1.email', 'us1.active', 'agent_rank_types.rank', 'us2.email as recruiter')
              ->join('persons', 'persons.id', '=', 'us1.person_id')
              ->join('avatars', 'avatars.user_id', '=', 'us1.id')
              ->join('roles', 'roles.id', '=', 'us1.role_id')
              ->join('agent_ranks', 'agent_ranks.agent_id', '=', 'us1.id')
              ->join('agent_rank_types', 'agent_rank_types.id', '=', 'agent_ranks.rank_type_id')
              ->join('agents_details', 'agents_details.agent_id', '=', 'us1.id')
              ->join('users as us2', 'us2.id', '=' , 'agents_details.recruiter')
              ->where('roles.name', '!=' ,'SuperAdmin' )
              ->get();

        return $users;
    }


    public function getAllActiveAgentsToExport()
    {

          $users = DB::table('users as us1')
              ->select('persons.lastname' ,'persons.firstname', 'persons.middlename' , 'us1.email', 'us1.active', 'agent_rank_types.rank', 'us2.email as recruiter')
              ->join('persons', 'persons.id', '=', 'us1.person_id')
              ->join('avatars', 'avatars.user_id', '=', 'us1.id')
              ->join('roles', 'roles.id', '=', 'us1.role_id')
              ->join('agent_ranks', 'agent_ranks.agent_id', '=', 'us1.id')
              ->join('agent_rank_types', 'agent_rank_types.id', '=', 'agent_ranks.rank_type_id')
              ->join('agents_details', 'agents_details.agent_id', '=', 'us1.id')
              ->join('users as us2', 'us2.id', '=' , 'agents_details.recruiter')
              ->where('us1.active', '1' )
              ->where('roles.name', '!=' ,'SuperAdmin' )
              ->get();

        return $users;
    }

    public function getAllNotActiveAgentsToExport()
    {

          $users = DB::table('users as us1')
              ->select('persons.lastname' ,'persons.firstname', 'persons.middlename' , 'us1.email', 'us1.active', 'agent_rank_types.rank', 'us2.email as recruiter')
              ->join('persons', 'persons.id', '=', 'us1.person_id')
              ->join('avatars', 'avatars.user_id', '=', 'us1.id')
              ->join('roles', 'roles.id', '=', 'us1.role_id')
              ->join('agent_ranks', 'agent_ranks.agent_id', '=', 'us1.id')
              ->join('agent_rank_types', 'agent_rank_types.id', '=', 'agent_ranks.rank_type_id')
              ->join('agents_details', 'agents_details.agent_id', '=', 'us1.id')
              ->join('users as us2', 'us2.id', '=' , 'agents_details.recruiter')
              ->where('roles.name', '!=' ,'SuperAdmin' )
              ->where('us1.active', '0' )
              ->get();


        return $users;
    }









    public function getAllStaffsToExport()
    {
         $users = DB::table('users')
              ->select( 'persons.lastname', 'persons.firstname', 'users.email', 'users.active', 'roles.name as role')
              ->join('persons', 'persons.id', '=', 'users.person_id')
              ->join('avatars', 'avatars.user_id', '=', 'users.id')
              ->join('roles', 'roles.id', '=', 'users.role_id')
              ->where('roles.name', 'Staff' )
              ->get();

        return $users;
    }


    public function getAllActiveStaffsToExport()
    {
         $users = DB::table('users')
              ->select('persons.lastname' , 'persons.firstname',  'persons.middlename', 'users.email', 'users.active', 'roles.name as role')
              ->join('persons', 'persons.id', '=', 'users.person_id')
              ->join('avatars', 'avatars.user_id', '=', 'users.id')
              ->join('roles', 'roles.id', '=', 'users.role_id')
              ->where('users.active', '1' )
              ->where('roles.name', 'Staff' )
              ->get();

        return $users;
    }


    public function getAllNotActiveStaffsToExport()
    {
         $users = DB::table('users')
              ->select( 'persons.lastname' , 'persons.firstname',  'persons.middlename', 'users.email', 'users.active', 'roles.name as role')
              ->join('persons', 'persons.id', '=', 'users.person_id')
              ->join('avatars', 'avatars.user_id', '=', 'users.id')
              ->join('roles', 'roles.id', '=', 'users.role_id')
              ->where('users.active', '0' )
              ->where('roles.name', 'Staff' )
              ->get();

        return $users;
    }








    public function getAllUsersByStatus( $status )
    {

         $users = DB::table('users')
              ->join('persons', 'persons.id', '=', 'users.person_id')
              ->join('avatars', 'avatars.user_id', '=', 'users.id')
              ->join('roles', 'roles.id', '=', 'users.role_id')
              ->where('users.active', $status )
              ->get();

        return $this->EncodeHashUsersId( $users );
    }






    public function getAllUserByRoleAndStatus( $role , $status )
    { 
        if($role != 0 ){
         $users = DB::table('users')
              ->join('persons', 'persons.id', '=', 'users.person_id')
              ->join('avatars', 'avatars.user_id', '=', 'users.id')
              ->join('roles', 'roles.id', '=', 'users.role_id')
              ->where('users.active', $status )
              ->where('users.role_id', $role ) 
              ->get();

         return $this->EncodeHashUsersId( $users );
      }else{
          $users = DB::table('users')
              ->join('persons', 'persons.id', '=', 'users.person_id')
              ->join('avatars', 'avatars.user_id', '=', 'users.id')
              ->join('roles', 'roles.id', '=', 'users.role_id')
              ->where('users.active', $status ) 
              ->get();
         return $this->EncodeHashUsersId( $users );
      }
    }






    public function search( $key , $role , $status)
    { 
      if($role != 0 ){

         $users = DB::table('users')
              ->join('persons', 'persons.id', '=', 'users.person_id')
              ->join('avatars', 'avatars.user_id', '=', 'users.id')
              ->join('roles', 'roles.id', '=', 'users.role_id')
              ->where('users.active', $status )
              ->where('users.role_id', $role )
              ->Where( function ($query) use ($key){

                  $query->where( 'users.email', 'LIKE', '%'.$key.'%' )
                        ->orwhere( 'persons.firstname', 'LIKE', '%'.$key.'%' )
                        ->orwhere( 'persons.lastname', 'LIKE', '%'.$key.'%' ) 
                        ->orwhere( 'persons.middlename', 'LIKE', '%'.$key.'%' ) 
                        ->orwhere( 'persons.datebirth', 'LIKE', '%'.$key.'%' ) 
                        ->orwhere( 'persons.status', 'LIKE', '%'.$key.'%' ) 
                        ->orwhere( 'roles.name', 'LIKE', '%'.$key.'%' ) 
                        ->orwhere( 'roles.description', 'LIKE', '%'.$key.'%' ) 
                        ->orwhere( 'address.street', 'LIKE', '%'.$key.'%' ) 
                        ->orwhere( 'address.barangay', 'LIKE', '%'.$key.'%' ) 
                        ->orwhere( 'address.city', 'LIKE', '%'.$key.'%' ) 
                        ->orwhere( 'address.province', 'LIKE', '%'.$key.'%' ) 
                        ->orwhere( 'address.state', 'LIKE', '%'.$key.'%' ) 
                        ->orwhere( 'address.zipcode', 'LIKE', '%'.$key.'%' ) ;
               })
              ->get();

         return $this->EncodeHashUsersId( $users );

       }else{

         $users = DB::table('users')
              ->join('persons', 'persons.id', '=', 'users.person_id')
              ->join('avatars', 'avatars.user_id', '=', 'users.id')
              ->join('roles', 'roles.id', '=', 'users.role_id')
              ->where('users.active', $status )
              ->Where( function ($query) use ($key){

                  $query->where( 'users.email', 'LIKE', '%'.$key.'%' )
                        ->orwhere( 'persons.firstname', 'LIKE', '%'.$key.'%' )
                        ->orwhere( 'persons.lastname', 'LIKE', '%'.$key.'%' ) 
                        ->orwhere( 'persons.middlename', 'LIKE', '%'.$key.'%' ) 
                        ->orwhere( 'persons.datebirth', 'LIKE', '%'.$key.'%' ) 
                        ->orwhere( 'persons.status', 'LIKE', '%'.$key.'%' ) 
                        ->orwhere( 'roles.name', 'LIKE', '%'.$key.'%' ) 
                        ->orwhere( 'roles.description', 'LIKE', '%'.$key.'%' ) 
                        ->orwhere( 'address.street', 'LIKE', '%'.$key.'%' ) 
                        ->orwhere( 'address.barangay', 'LIKE', '%'.$key.'%' ) 
                        ->orwhere( 'address.city', 'LIKE', '%'.$key.'%' ) 
                        ->orwhere( 'address.province', 'LIKE', '%'.$key.'%' ) 
                        ->orwhere( 'address.state', 'LIKE', '%'.$key.'%' ) 
                        ->orwhere( 'address.zipcode', 'LIKE', '%'.$key.'%' ) ;
               })
              ->get();

         return $this->EncodeHashUsersId( $users ); 

       }
      
    }




    public function setToNotActive( $id ){

		    $user = User::where('id',  Hashids::decode( $id )[0] )->first();
        $user->active = 0;
        $user->save();
    }

    public function setToActive( $id ){

		    $user = User::where('id',  Hashids::decode( $id )[0] )->first();
        $user->active = 1;
        $user->save();
    }

    public function approve( $id ){

        $user = AgentDetails::where('agent_id',  Hashids::decode( $id )[0] )->first();
        $user->approved = 1;
        $user->save();

        $user = User::where('id',  Hashids::decode( $id )[0] )->first();
        $user->active = 1;
        $user->save();
    }

    public function disapprove( $id ){

        $user = AgentDetails::where('agent_id',  Hashids::decode( $id )[0] )->first();
        $user->approved = 0;
        $user->save();

        $user = User::where('id',  Hashids::decode( $id )[0] )->first();
        $user->active = 0;
        $user->save();
    }


    public function verifyrights( $password ){

          if ( Hash::check( $password, Auth::user()->password )) {
             return true;
          }else{
            return false;
          }
    }









}