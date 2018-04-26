<!-- MAIN -->
<div class="main">
    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="container container-full">

        <div class="SeletedMenuHeader">
          
             <div class="row">
                    <div class="col-md-12">
                      <h4>DEVELOPER PROFILE</h4>
                    </div>
                </div>

        </div>

            <div class="panel panel-profile">
                <div class="clearfix">
                    <!-- LEFT COLUMN -->
                    <div class="profile-left">
                        <!-- PROFILE HEADER -->
                        <div class="profile-header">
                            <div class="overlay"></div>
                            <div class="profile-main">
                                <img src="{{ $developer->logo }}" class="img-circle" alt="Avatar">
                                <h3 class="name">{{ $developer->name }}</h3>
                                @if($developer->active)
                                    <span class="online-status status-available">Active</span>
                                @else
                                    <span class="offline-status status-available">Not Active</span>
                                @endif
                            </div>

                        </div>
                        <!-- END PROFILE HEADER -->
                        
                        <!-- PROFILE DETAIL -->
                        <div class="profile-detail">
                            <div class="profile-info text-center">
                                <h4 class="heading text-left">Developer Information</h4>
                                <ul class="list-unstyled list-justify text-left">
                                    <li>Name <span>{{ $developer->name }}</span></li>
                                    <li>Address <span>{{ $developer->address }}</span></li>
                                    <li>Number <span>{{ $developer->contact }}</span></li>
                                    <li>Fax <span>{{ $developer->fax }}</span></li>
                                </ul>
                                <br>
                                <button type="button" class="btn btn-success actionUpdateDeveloper" id="{{ $developer->id }}">UPDATE INFORMATION</button>
                            </div>
                            
                        </div>
                        <!-- END PROFILE DETAIL -->
                    </div>
                    <!-- END LEFT COLUMN -->
                    <!-- RIGHT COLUMN -->
                    <div class="profile-right">
                        <!-- TABBED CONTENT -->
                        <div class="custom-tabs-line tabs-line-bottom left-aligned">
                            <ul class="nav" role="tablist">
                                <li class="active"><a href="#tab-bottom-left1" role="tab" data-toggle="tab">Profile</a></li>
                                
                                <li><a href="#tab-bottom-left2" role="tab" data-toggle="tab">Projects <span class="badge"></span></a></li>
                                
                            </ul>
                        </div>
                        <div class="tab-content active">
                            
                            <div class="tab-pane fade in active" id="tab-bottom-left1">
                                {!! $developer->profile !!}
                            </div>

                             <div class="tab-pane fade" id="tab-bottom-left2">

                                
                                    <table class="table data-table">
                                        <thead>
                                          <tr>
                                            <th class="text-left">#</th>
                                            <th class="text-left">Name</th>
                                            <th class="text-left">Location</th>
                                            <th class="text-center">Developer</th>
                                            <th class="text-center">Status</th>
                                            
                                          </tr>
                                        </thead>
                                        <tbody>
                                          @php ($i = 1)  
                                          @foreach( $developer_projects as $project )

                                          <tr id="{{ $project->id }}" class="data @if( $i == 1) active @endif">
                                            <td>{{ $i }}</td>
                                            <td>{{ $project->project_name  }}</td>
                                            <td>{{ $project->project_location  }}</td>
                                            <td>{{ $project->developer  }}</td>
                                            <td class="text-center">
                                                @if( !$project->deleted )
                                                  <span class="label label-success">active</span>
                                                @else
                                                  <span class="label label-danger">not active</span>
                                                @endif
                                            </td>
                                            
                                             @php ($i++)
                                          </tr>
                                          @endforeach
                                        </tbody>
                                      </table>

                            </div>




                        </div>
                        <!-- END TABBED CONTENT -->
                    </div>
                    <!-- END RIGHT COLUMN -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT -->
</div>
<!-- END MAIN -->