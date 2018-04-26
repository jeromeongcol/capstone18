<!-- MAIN -->
<div class="main">
    <!-- MAIN CONTENT -->
    <div class="main-content">


        <div class="container container-full">


        <div class="SeletedMenuHeader">
          
             <div class="row">
                    <div class="col-md-12">
                      <h4>UPDATE USER</h4>
                    </div>
                </div>

        </div>

            <div class="panel panel-profile panel-update text">


            <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="pull-right"><a href="#tab_5" class="Status_Tab" data-toggle="tab" aria-expanded="false">Status</a></li>

              @if( $user->role == "Agent")

                <li class="pull-right"><a href="#tab_6" class="Agent_Rank_Tab" data-toggle="tab" aria-expanded="false">Rank</a></li>
                <li class="pull-right"><a href="#tab_7" class="Agent_Recruiter_Tab" data-toggle="tab" aria-expanded="false">Recuiter</a></li>

              @endif

              <li class="pull-right"><a href="#tab_4"  class="User_Profile_Picture_Tab" data-toggle="tab" aria-expanded="false">Profile Picture</a></li>
              <li class="pull-right"><a href="#tab_3" class="User_Basic_Info_Tab" data-toggle="tab" aria-expanded="false">Basic Information</a></li>
              <li class="pull-right"><a href="#tab_2"  class="User_Change_Password_Tab" data-toggle="tab" aria-expanded="false">Change Password</a></li>
              <li class="pull-right active"><a href="#tab_1" class="User_Email_Tab" data-toggle="tab" aria-expanded="true">Email Address</a></li>
              <li class="img-circle-xs-con">

                <a class="actionViewUserBtnShowModal update-avatar-con" id="{{ $user->user_id }}">
                   <div class="pull-left">
                    <img src="{{ $user->photo_thumb }}" class="img-circle img-circle-xs" id="profile-picture">
                   </div>
                   <div class="pull-left">
                      <p>{{ $user->lastname }}, {{ $user->firstname}} {{ $user->middlename}}</p>
                      <p>{{ $user->email }}</p>
                   </div>
                 </a>
               </li>

            </ul>
            <div class="tab-content">

              @if( $user->role == "Agent")
              <div class="tab-pane" id="tab_6">
                <div class="row">

                    <div class="col-md-8 col-md-offset-2">
                      <form method="POST" action="/users/updateAgentRank" id="updateAgentRankForm">

                      {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{ $user->user_id }}" />
                        <div class="panel">
                                <div class="panel-heading">
                                    <h3 class="panel-title pull-left">Ranks</h3>
                                    <h3 class="panel-title pull-right">Agent Rank : <span class="label label-success">{{ $user->rank}}</span></h3>
                                </div>
                                <div class="panel-body">

                                    <table class="table" id="SelectAgentRankTable">
                                          <thead>
                                            <tr>
                                              <th class="text-center"></th>
                                              <th class="text-center">Rank</th>
                                              <th class="text-center">Description</th>
                                              <th class="text-center">Rate</th>
                                            </tr>
                                          </thead>
                                          <tbody>
                                            @php( $i = 1 )
                                            @foreach( $ranks as $rank )
                                            <tr class="data @if( $user->rank == $rank->rank ) active @endif">
                                              <td class="text-center"><input type="radio" name='rank' value="{{ $rank->id }}" @if( $user->rank == $rank->rank ) checked="checked" @endif></td>
                                              <td class="text-center rank">{{ $rank->rank }}</td>
                                              <td class="text-center">{{ $rank->description }}</td>
                                              <td class="text-center">{{ $rank->commission_rate }}</td>
                                            </tr>
                                             @php( $i++ )
                                            @endforeach
                                           
                                          </tbody>
                                    </table>

                                   
                                </div>
                                <div class="panel-footer text-right">
                                    <button type="submit" class="btn btn-info">Update</button>
                                </div>
                            </div>

                        </form>

                    </div>
    
                  </div>

              </div>
              <!-- /.tab-pane -->

              @if( count( $recruiter ) )

              <div class="tab-pane" id="tab_7">
                <div class="row">

                    <div class="col-md-8 col-md-offset-2">
                      <form method="POST" action="/users/updateAgentRecruiter" id="updateAgentRecruiterForm">

                      {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{ $user->user_id }}" />
                        <div class="panel">
                                <div class="panel-heading">
                                    <h3 class="panel-title pull-left">Agents</h3>
                                    <h3 class="panel-title pull-right">Agent Recruiter : <span class="label label-success">{{ $recruiter->lastname}}, {{ $recruiter->firstname}} {{ $recruiter->middlename }} [{{ $recruiter->email }}]</span></h3>
                                </div>
                                <div class="panel-body">  
                                   <div class="input-group search-control">
                                          <input class="form-control" id="search_recuiter" placeholder="Search Recruiter" name="key" type="text">
                                          <span class="input-group-btn">
                                            <button class="btn btn-info" id="searchAgent">Go!</button>
                                          </span>
                                    </div>


                                    <div class="RecruitersTable-con">
                                       <table class="table" id="SelectRecruiterTable">
                                          @include('dashboard.users.forms.agent.partials.agent-search-result')
                                      </table>
                                    </div>

                                   
                                </div>
                                <div class="panel-footer text-right">
                                    <button type="submit" class="btn btn-info">Update</button>
                                </div>
                            </div>

                        </form>

                    </div>
    
                  </div>

              </div>
              <!-- /.tab-pane -->

              @endif


              @endif


              <div class="tab-pane active" id="tab_1">
                <div class="row">

                    <div class="col-md-4 col-md-offset-4">

                      <form method="POST" action="/users/updateEmail" id="updateEmailForm">

                        {{ csrf_field() }}

                        <div class="panel">
                              <div class="panel-heading">
                                  <h3 class="panel-title"></h3>
                              </div>
                              <div class="panel-body">
                                  <div class="form-group">
                                    <span class="input-group-addon">Email Address</span>
                                    <input type="hidden" name="id" value="{{ $user->user_id }}" />
                                    <input class="form-control" name="email" required="" type="text" value="{{ $user->email }}">
                                    <small class="help-block with-errors form-error email"></small>
                                  </div>
                                  <br />
                              </div>
                              <div class="panel-footer text-right">
                                  <button type="submit" class="btn btn-info">Update</button>
                              </div>
                          </div>
                        
                        </form>
                      </div>
    
                  </div>

              </div>
              <!-- /.tab-pane -->


              <div class="tab-pane" id="tab_2">
                
                <div class="row">

                   <div class="col-md-4 col-md-offset-4">

                        <form method="POST" action="/users/changePassword" id="changePasswordForm">

                        {{ csrf_field() }}

                        <input type="hidden" name="id" value="{{ $user->user_id }}" />

                        <div class="panel">

                            <div class="panel-heading">
                                <h3 class="panel-title"></h3>
                            </div>
                            <div class="panel-body">
                                
                                <div class="form-group">
                                  <span class="input-group-addon">Password</span>
                                  <input class="form-control" name="password" required="" type="password" placeholder="************">
                                  <small class="help-block with-errors form-error password"></small>
                                </div>

                                <div class="form-group">
                                  <span class="input-group-addon">Confirm Password</span>
                                  <input class="form-control" name="password_confirmation" required="" type="password" placeholder="************">
                                  <small class="help-block with-errors form-error password_confirmation"></small>
                                </div>
                            </div>
                            <br />
                            <div class="panel-footer text-right">
                                <button type="submit" class="btn btn-info">Change   </button>
                            </div>
                        </div>

                      </form>

                      </div>

                  </div>


              </div>
              <!-- /.tab-pane -->




              <div class="tab-pane" id="tab_3">
                
                <div class="row">
                   <div class="col-md-4 col-md-offset-4">

                      <form method="POST" action="/users/updateBasicInfo" id="updateBasicInfoForm">

                        {{ csrf_field() }}

                        <input type="hidden" name="id" value="{{ $user->user_id }}" />

                       <div class="panel">
                            <div class="panel-heading">
                                <h3 class="panel-title"></h3>
                            </div>
                            <div class="panel-body">

                                <div class="form-group">
                                  <span class="input-group-addon">Last name</span>
                                  <input class="form-control" name="lastname" required="" type="text" value="{{ $user->lastname }}">
                                  <small class="help-block with-errors form-error lastname"></small>
                                </div>
                                
                                <div class="form-group">
                                  <span class="input-group-addon">First name</span>
                                  <input class="form-control" name="firstname" required="" type="text" value="{{ $user->firstname }}">
                                  <small class="help-block with-errors form-error firstname"></small>
                                </div>

                                <div class="form-group">
                                  <span class="input-group-addon">Middle name</span>
                                  <input class="form-control" name="middlename"  type="text" value="{{ $user->middlename }}">
                                  <small class="help-block with-errors form-error middlename"></small>
                                </div>
                            <br />
                            </div>
                            <div class="panel-footer text-right">
                               <button type="submit" class="btn btn-info">Update</button>
                            </div>
                        </div>

                      </form>

                      </div>

                  </div>

              </div>
              <!-- /.tab-pane -->



              <div class="tab-pane" id="tab_4">
                
                <div class="row">
                   <div class="col-md-4 col-md-offset-4">

                      <form method="POST" action="/users/changeProfiePicture" enctype="multipart/form-data" id="changeProfiePictureForm">

                        {{ csrf_field() }}

                        <input type="hidden" name="id" value="{{ $user->user_id }}" />
                        <div class="panel">
                            <div class="panel-heading">
                                <h3 class="panel-title"></h3>
                            </div>
                            <div class="panel-body text-center">
                            

                            <div class="change-profile-picture-con user-picture-container">

                              <div class="overlay showCropboxModal" id="user-photo">
                                <div class="text">+</div>
                              </div>

                               <img src="{{ $user->photo_thumb }}" class="img-circle" id="profile-picture">
                               <input id="imgUpload" name="avatar" value="" type="hidden">

                            </div>

                            <br />
                            </div>
                            <div class="panel-footer text-right">
                               <button type="submit" class="btn btn-info">Change</button>
                            </div>
                        </div>

                      </form>

                      </div>

                  </div>

              </div>
              <!-- /.tab-pane -->


              <div class="tab-pane" id="tab_5">
                
                <div class="row">
                   <div class="col-md-4 col-md-offset-4">
                        <div class="panel">
                            <div class="panel-heading">
                                <h3 class="panel-title"></h3>
                            </div>
                            <div class="panel-body text-center status-con">
                              
                              <center>This account is
                              @if( $user->active )
                                <span class="label label-success">active</span>
                              @else
                                <span class="label label-danger">not active</span>
                              @endif
                               @if($user->role == "Agent") and 

                                @if( $user->approved )
                                  <span class="label label-success">approved</span>
                                @else
                                  <span class="label label-primary">disapproved</span>
                                @endif

                             @endif. </center>

                              <br><br>
                             

                              @if( ( $user->role == "Agent" ) &&  ( $auth->role != "Staff" ) )

                                 <div class="row">

                                  @if( $user->approved )

                                   <div class="col-md-6 text-center">
                                        @if( $user->active )
                                          
                                          <button type="button" class="btn btn-primary btn-block actionSetNotActiveUserBtnShowModal" id="{{ $user->user_id }}">DEACTIVATE?</button>

                                        @else
                                          
                                          <button type="button" class="btn btn-primary btn-block actionSetActiveUserBtnShowModal" id="{{ $user->user_id }}">ACTIVATE?</button>

                                        @endif

                                   </div>
                                   <div class="col-md-6 text-center">
                                                                            
                                          <button type="button" class="btn btn-primary btn-block actionDisApproveAgentBtnShowModal" id="{{ $user->user_id }}" >DISAPPROVE?</button>

                                   </div>

                                   @else

                                    <div class="col-md-12 text-center">

                                      @if( $user->approved )                                      
                                          <button type="button" class="btn btn-primary btn-block actionDisApproveAgentBtnShowModal" id="{{ $user->user_id }}" >DISAPPROVE?</button>
                                      @else
                                          <button type="button" class="btn btn-primary btn-block actionApproveAgentBtnShowModal" id="{{ $user->user_id }}">APPROVE?</button>
                                      @endif

                                     </div>


                                   @endif

                                 </div>
                              @else


                                  <div class="row">
                                   <div class="col-md-12 text-center">
                                        @if( $user->active )
                                          
                                          <button type="button" class="btn btn-primary btn-block actionSetNotActiveUserBtnShowModal" id="{{ $user->user_id }}">DEACTIVATE?</button>

                                        @else
                                          
                                          <button type="button" class="btn btn-primary btn-block actionSetActiveUserBtnShowModal" id="{{ $user->user_id }}">ACTIVATE?</button>

                                        @endif

                                   </div>
                                  </div>

                               @endif
                                          

                            <br /><br />
                            </div>
                        </div>
                      </div>

                  </div>

              </div>
              <!-- /.tab-pane -->



            </div>
            <!-- /.tab-content -->
          </div>





            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT -->
</div>
<!-- END MAIN -->