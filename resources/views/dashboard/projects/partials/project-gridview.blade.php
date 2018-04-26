
        <div class="SeletedMenuHeader">
          
         <div class="row">
            <div class="col-md-4 col-xs-4">
              <h4>Projects</h4>
            </div>

             
            <div class="col-md-4 col-xs-4 text-right">
              
              <form action="/developers/projects/search" method="GET" id="searchProjectForm">

                {{ csrf_field() }}

                 <div class="input-group search-group">
                      <input class="form-control" type="text" placeholder="Search Projects" name="key">
                      <span class="input-group-btn"><button class="btn btn-primary" type="submit">Go!</button></span>
                    </div>

                  </div>

              </form>

            <div class="col-md-4 col-xs-4 text-right">


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

                    
                   <div class="project-outer-con float-left">
                       <div class="list-group dev-list_scrolling">
                          

                          <div class="row">
                              

                            @if( !empty( $key ) )

                              <p class="project_search_count">Search Key :  {{ $key }}, {{ count( $projects ) }} Projects Found.</p>

                            @endif

                            @if( count( $projects ) )

                              @foreach( $projects as $project )

                              <div class="product-item col-xs-12 col-lg-4">
                                 <div class="product-container">
                                      <div class="product-img">
                                          <img src="{{ $project->featured_photo }}" class="actionViewProject" id="{{ $project->id }}">
                                          <div class="item-upper-con">

                                              <div class="product-action text-right">
                                                  <div class="btn-group">

                                                              
                                                          <button type="submit" class="btn btn-primary btn-sm actionUpdateProject" id="{{ $project->id }}">
                                                              <i class="fa fa-pencil-square-o" aria-hidden="true"></i> 
                                                          </button>
                                                      

                                                      @if( !$project->deleted )

                                                      <button class="btn btn-danger btn-sm actionSetNotActiveProjectShowModal" id="{{ $project->id }}">
                                                          <i class="fa fa-trash" aria-hidden="true"></i> 
                                                      </button>
                                                      @else

                                                       <button class="btn btn-success btn-sm actionSetActiveProjectShowModal" id="{{ $project->id }}">
                                                          <i class="fa fa-undo" aria-hidden="true"></i> 
                                                      </button>

                                                      @endif

                                                           <button class="btn btn-info btn-sm actionViewProject" id="{{ $project->id }}"><i class="fa fa-external-link" aria-hidden="true"></i>
                           
                                                          </button>


                                                          
                                                  </div>

                                              </div>

                                          </div>

                                          <div class="item-lower-con">

                                              <p class="project-name">{{ $project->project_name }}</p>

                                              <p class="project-address">{{ $project->project_location }}</p>
                                              
                                          </div>
                                      </div>

                                      <div class="project-added-by-con">
                                          <span class="pull-left @if( ( $auth->role == 'Admin') ||  ( $auth->role == 'SuperAdmin') ) actionViewUserBtnShowModal @endif" id="{{ $project->added_by }}"><i class="fa fa-user-o" aria-hidden="true"></i> {{ $project->email }}</span>
                                          <span class="pull-right">{{  date('d-m-Y', strtotime($project->created_at)) }} <i class="fa fa-calendar" aria-hidden="true"></i>
                                          </span>
                                      </div>
                                 </div>
                              </div>

                              @endforeach

                            @else

                                <p class="project_search_count">Project Count :  {{ count( $projects ) }} projects.</p>


                            @endif




                          </div>

                          

                      </div> 

                  </div>
          

                </div>
              </div>

              <!-- END -->
            </div>
          </div>



        </div>


@include('dashboard.projects.modals.view-photo')