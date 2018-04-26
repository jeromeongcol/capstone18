@extends('layouts-admin.app')

@section('content')

    <!-- MAIN -->
    <div class="main">
      <!-- MAIN CONTENT -->
      <div class="main-content">

       <div class="SeletedMenuHeader">
        <div class="row">
            <div class="col-md-6">
                <h4><a href="/users" id="back-login-form" class="pull-left action-back"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></a> <i class="fa fa-user-plus"></i> Register new user</h4>
            </div>

                    <div class="col-md-6 text-right">


                          <div class="pull-right user-actions">
                            
                            @if( ( $user->role == "Admin") ||  ( $user->role == "SuperAdmin") )

                            <a data-toggle="modal" data-target="#ImportUserExcelModal">
                              <button type="button" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> IMPORT EXCEL</button>
                            </a>

                            @endif

                          </div>

                    </div>
        </div>
      </div>

        <form role="form" method="POST" action="/register" enctype="multipart/form-data" class="register-form" id="registerNewUserForm">

        {{ csrf_field() }}

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                      <div class="panel register-account-panel" id="user-information">
                        <div class="panel-body">
                        
                        <div class="row">
                             <div class="col-md-12">

                                <div class="input-group text-center user-picture-container user-avatar-info">

                                    <div class="overlay showCropboxModal" id="user-photo">
                                        <div class="text">+</div>
                                      </div>

                                       <img src="{{ asset('storage/default.png') }}" id="UserPictureUp" alt="User Picture" rel="tooltip" title="" data-placement="bottom" data-html="true" data-original-title="<b>Click to add/change image.</b>">
                                            <input type="hidden" id="imgUpload" name="avatar" value="">

                                    </div>

                             </div>
                        </div>
                        
                        <br><br>

                        <div class="row">
                             <div class="col-md-3">

                                    <div class="form-group">
                                         <span class="input-group-addon" >Email Address</span>
                                          <input class="form-control" value="{{ old('email') }}" name="email" type="text" required="">
                                          <small class="form-text form-error email">{{ $errors->first('email') }}</small>

                                    </div>

                                    <div class="form-group">
                                         <span class="input-group-addon" >Password</span>
                                          <input class="form-control" name="password" type="password" required>
                                         <small class="form-text form-error password">{{ $errors->first('password') }}</small>

                                    </div>

                                    <div class="form-group">
                                         <span class="input-group-addon" >Confirm Password</span>
                                         <input class="form-control" name="password_confirmation" type="password" required>
                                          <small class="form-text form-error password_confirmation">{{ $errors->first('password_confirmation') }}</small>
                                    </div>


                                </div>

                                 <div class="col-md-3">

                                    <div class="form-group">
                                         <span class="input-group-addon" >User Type</span>
                                           <select class="form-control userrole"  name="userrole">
                                            @foreach( $roles as $role )

                                             @if( $user->role == "SuperAdmin")

                                                @if( $role->name != "SuperAdmin" )
                                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                @endif

                                              @endif
                                              
                                              @if( $user->role == "Admin")

                                                @if( ( $role->name != "Admin") && ( $role->name != "SuperAdmin") )
                                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                @endif

                                              @endif
                                              
                                              @if( $user->role == "Staff")

                                                @if( ( $role->name != "Staff") && ( $role->name != "SuperAdmin") && ( $role->name != "Admin") )
                                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                @endif

                                              @endif

                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <span class="input-group-addon" >Agent Rank</span>
                                        <select class="form-control agentrank" name="agentrank">

                                            @foreach( $ranks as $rank )
                                            <option value="{{ $rank->id }}">{{ $rank->rank }}</option>
                                            @endforeach

                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <span class="input-group-addon" >Recruited By</span>
                                        <div class="row">
                                             <div class="col-md-8 side-by-side-col-left">
                                              <input class="form-control agentrank" type="text" name="recruiter_name" id="recruiter_name" value="{{ old('recruiter_name')  }}" required>
                                            </div>

                                             <div class="col-md-4 side-by-side-col-right">
                                              <input class="form-control agentrank" type="text" name="recruiter_rank" id="recruiter_rank" value="{{ old('recruiter_rank')  }}">
                                            </div>
                                        
                                        </div>

                                         <input class="form-control agentrank hidden" type="text" name="recruiter" id="recruiter" value="{{ old('recruiter')  }}">
                                        <small class="form-text form-error recruiter">{{ $errors->first('recruiter') }}</small>
                                    </div>
                                      
                                 </div>

                                <div class="col-md-3">
                                        <div class="form-group">
                                            <span class="input-group-addon" >Last name</span>
                                            <input class="form-control" type="text" name="lastname" value="{{ old('lastname')  }}" required>
                                            <small class="form-text form-error lastname">{{ $errors->first('lastname') }}</small>
                                        </div>

                                        <div class="form-group">
                                            <span class="input-group-addon" >First name</span>
                                            <input class="form-control" type="text" name="firstname" value="{{ old('firstname') }}" required>
                                            <small class="form-text form-error firstname">{{ $errors->first('firstname') }}</small>
                                        </div>

                                        <div class="form-group">
                                            <span class="input-group-addon" >Middle name</span>
                                            <input class="form-control" type="text" name="middlename" value="{{ old('middlename') }}" required>
                                            <small class="form-text form-error middlename">{{ $errors->first('middlename') }}</small>
                                        </div>
                                 </div>


                                <div class="col-md-3">

                                        <div class="form-group">
                                            <span class="input-group-addon" >Birth date</span>
                                                <input type="text" name="datebirth" class="datepicker form-control" value="03/12/2016" />
                                                <small class="form-text form-error datebirth">{{ $errors->first('datepicker') }}</small>
                                        </div>

                                        <div class="form-group">
                                            <span class="input-group-addon" >Gender</span>
                                            <select class="form-control" name="gender">
                                                <option value="M">Male</option>
                                                <option value="F">Famale</option>
                                            </select>
                                        </div>
                                 </div>




                           </div>

                           <div class="row">
                                <div class="col-md-4 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary btn-block">SUBMIT</button>
                                </div>
                            </div>

                        </div>
                      </div>


                </div>

            </div>


        </div>
    </form>
      
    </div>
    <!-- END MAIN CONTENT -->
    </div>
    <!-- END MAIN -->

    @include('admin.partials.modals.recruiter')
    @include('admin.partials.modals.import-excel')
    
@endsection