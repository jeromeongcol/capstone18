        <div class="SeletedMenuHeader">
          
           <div class="row">
              <div class="col-md-4 col-xs-4">
                <h4>Users <i class="fa fa-angle-right"></i> Admin</h4>
              </div>

              <div class="col-md-8 col-xs-8 text-right">

                <div class="btn-group" role="group" aria-label="First group">
                  <button type="button" class="btn btn-primary menu-custom agent-submenu">AGENT LIST</button>
                  @if( $auth->role == "SuperAdmin" )
                    <button type="button" class="btn btn-primary menu-custom admin-submenu active">ADMIN LIST</button>
                 @endif

                  @if( ( $auth->role == "Admin") ||  ( $auth->role == "SuperAdmin") )
                     <button type="button" class="btn btn-primary menu-custom staff-submenu">STAFF LIST</button>
                  @endif
                </div>

                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ExportUserExcelModal"><img src="{{ asset('layouts/img/export.png') }}"> Export</button>
                <button type="button" class="btn btn-primary" id="AddAdminBtn">
                  <img src="{{ asset('layouts/img/add-user.png') }}"> Add Admin
                </button>
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
                            <th class="text-center">Status</th>
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
                            <td class="text-center">
                                @if( $user->active )
                                  <span class="label label-success">active</span>
                                @else
                                  <span class="label label-danger">not active</span>
                                @endif
                            </td>
                             <td class="actions text-center">

                                <div class="btn-group" role="group" aria-label="First group">

                                        
                                  <button type="button" class="btn btn-info actionUpdateUserBtnShowModal" id="{{ $user->id }}">
                                      <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                  </button>

                                  @if( ( $auth->role == "Admin") ||  ( $auth->role == "SuperAdmin") )
                                  
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
