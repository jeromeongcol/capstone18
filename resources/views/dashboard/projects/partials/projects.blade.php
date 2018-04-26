
        <div class="SeletedMenuHeader">
          
         <div class="row">
            <div class="col-md-4 col-xs-4">
              <h4>Projects</h4>
            </div>

            <div class="col-md-8 col-xs-8 text-right">

              <div class="btn-group" role="group" aria-label="First group">
                <button type="button" class="btn btn-primary projects-menu"><i class="fa fa-list" aria-hidden="true"></i></button>
              
               <button type="button" class="btn btn-primary projects-menu-grid"><i class="fa fa-table" aria-hidden="true"></i></button>
              </div>

              <button type="button" class="btn btn-primary" id="AddProjectBtn"><img src="{{ asset('layouts/img/adddeveloper.png') }}"> Add Project</button>
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
                            <th class="text-left">#</th>
                            <th class="text-left">Name</th>
                            <th class="text-left">Location</th>
                            <th class="text-center">Developer</th>
                            <th class="text-center">Category</th>
                            <th class="text-center">Status</th>
                            <th>actions</th>
                            
                          </tr>
                        </thead>
                        <tbody>
                          @php ($i = 1)  
                          @foreach( $projects as $project )

                          <tr id="{{ $project->id }}" class="data @if( $i == 1) active @endif">
                            <td>{{ $i }}</td>
                            <td>{{ $project->project_name  }}</td>
                            <td>{{ $project->project_location  }}</td>
                            <td>{{ $project->developer  }}</td>
                            <td>{{ $project->category  }}</td>
                            <td class="text-center">
                                @if( !$project->deleted )
                                  <span class="label label-success">active</span>
                                @else
                                  <span class="label label-danger">not active</span>
                                @endif
                            </td>


                            <td class="actions text-center">

                                <div class="btn-group" role="group" aria-label="First group">
                                
                                <button type="button"  id="{{ $project->id }}" class="btn btn-primary actionViewProject"><i class="fa fa-external-link" aria-hidden="true"></i></button>
                                

                                  <button type="button"  id="{{ $project->id }}" class="btn btn-info actionUpdateProject"><i class="fa fa-pencil" aria-hidden="true"></i></button>

                                @if( !$project->deleted )

                                <button type="button" id="{{ $project->id }}" class="btn btn-danger actionSetNotActiveProjectShowModal"><i class="fa fa-times" aria-hidden="true"></i></button>

                                @else

                                <button type="button" id="{{ $project->id }}" class="btn btn-success actionSetActiveProjectShowModal"><i class="fa fa-undo" aria-hidden="true"></i></button>

                                @endif

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

@include('dashboard.projects.modals.view-photo')