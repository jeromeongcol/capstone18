        <div class="SeletedMenuHeader">
          
         <div class="row">
            <div class="col-md-3 col-xs-3">
              <h4>Users <i class="fa fa-angle-right"></i> Agent</h4>
            </div>

            <div class="col-md-9 col-xs-9 text-right">

                <div class="btn-group" role="group" aria-label="First group">
                  <button type="button" class="btn btn-primary menu-custom agent-submenu active">AGENT LIST</button>
                  @if( $auth->role == "SuperAdmin" )
                    <button type="button" class="btn btn-primary menu-custom admin-submenu">ADMIN LIST</button>
                 @endif

                  @if( ( $auth->role == "Admin") ||  ( $auth->role == "SuperAdmin") )
                     <button type="button" class="btn btn-primary menu-custom staff-submenu">STAFF LIST</button>
                  @endif
                </div>

              <div class="btn-group" role="group" aria-label="First group">
                @if( ( $auth->role == "Admin") ||  ( $auth->role == "SuperAdmin") )

                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ImportUserExcelModal"><i class="lnr lnr-download"></i> Import Agents</button>

                @endif

                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ExportUserExcelModal"><i class="lnr lnr-upload"></i> Export</button>

              </div>

              <button type="button" class="btn btn-primary" id="AddAgentBtn">
                <img src="{{ asset('layouts/img/add-user.png') }}"> Add Agent
              </button>

              <button type="button" class="btn btn-primary" id="AgentSettings"><img src="{{ asset('layouts/img/settings-gears.png') }}"></button>
            </div>
        </div>

        </div>


        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">


              <div class="panel">
                <div class="panel-body page-content">

                    
                      <table class="table data-table">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email Address</th>
                            <th>Rank</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Downlines</th>
                            <th class="text-center">Developer</th>
                            <th class="actions text-center">Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                          @php ($i = 1)  

                          @foreach( $users as $user )

                          
                          <tr id="{{ $user->id }}" class="data @if( $i == 1) active @endif">
                            <td>{{ $i  }}</td>
                            <td>{{ $user->lastname }}, {{ $user->firstname }} {{ $user->middlename }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->rank }}</td>
                            <td>
                                @if( $user->active )
                                  <span class="label label-success">active</span>
                                @else
                                  <span class="label label-danger">not active</span>
                                @endif
                                @if( $user->approved )
                                  <span class="label label-success">approved</span>
                                @else
                                  <span class="label label-primary">disapproved</span>
                                @endif
                            </td>
                             <td class="text-center">{{ $user->downlines }}</td>
                             <td class="text-center">{{ $user->affiliate_developer }}</td>
                             <td class="actions text-center">

                                <div class="btn-group" role="group" aria-label="First group">
                                  
                                        
                                  <button type="button" class="btn btn-info actionUpdateUserBtnShowModal" id="{{ $user->id }}">
                                      <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                  </button>

                                    @if( $user->approved )
                                      @if( $user->active )

                                        
                                          <button type="button" class="btn btn-danger actionSetNotActiveUserBtnShowModal" id="{{ $user->id }}">
                                          <i class="fa fa-user-times" aria-hidden="true"></i>
                                          </button>


                                      @else

                                        <button type="button" class="btn btn-success actionSetActiveUserBtnShowModal" id="{{ $user->id }}">
                                        <i class="fa fa-undo" aria-hidden="true"></i>
                                        </button>

                                      @endif
                                    @endif

                                    @if( $auth->role != "Staff"  )
                                      @if( $user->approved )

                                          <button type="button" class="btn btn-primary actionDisApproveAgentBtnShowModal" id="{{ $user->id }}">
                                          <i class="fa fa-thumbs-down" aria-hidden="true"></i>
                                          </button>


                                      @else

                                        <button type="button" class="btn btn-success actionApproveAgentBtnShowModal" id="{{ $user->id }}">
                                        <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                                        </button>

                                      @endif
                                    @endif


                                    <button type="button" class="btn btn-info actionViewUserBtnShowModal" id="{{ $user->id }}">
                                    <i class="fa fa-user-o" aria-hidden="true"></i>
                                    </button>

                                </div>
                            

                             </td>
                             @php ($i++)
                          </tr>


                          
                          @endforeach
                         
                        </tbody>
                      </table>
  

                </div>
              </div>
              <!-- END RECENT PURCHASES -->
            </div>
          </div>



        </div>