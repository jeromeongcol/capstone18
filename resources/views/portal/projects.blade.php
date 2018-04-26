@extends('layouts-agent.app')

@section('content')

    <div class="profile-page project-page  wrapper">
        <div class="page-header page-header-small" filter-color="orange">
            <div class="page-header-image" data-parallax="true" style="background-image: url('{{ asset('layouts-default/assets/img/bg5.jpg') }}');">
            </div>
            <div class="container">
                <div class="content-center">
                    
                </div>
            </div>
        </div>


        <div class="section">
            <div class="container">
				
              <div class="row">
                <div class="col-md-4">

                  <select class="form-control" id="FilterProjects">
                    <option value="ALL" id="ALL">ALL</option>
                    @foreach( $project_types as $project_type )
                    <option value="{{ $project_type->type }}" id="{{ $project_type->id }}">{{$project_type->type}}</option>
                    @endforeach
                  </select>

                </div>

                <div class="col-md-4">
                </div>

                <div class="col-md-4">
                  <form action="/developers/projects" method="GET" id="searchProjectForm">

                    {{ csrf_field() }}
                    
                      <input class="form-control" name="action" value="search" type="hidden">
                    <div class="input-group pull-right">
                      <input class="form-control" name="key" placeholder="Search Project" type="text">
                      <span class="input-group-addon">
                          <i class="now-ui-icons ui-1_zoom-bold search-button"></i>
                      </span>
                    </div>
                  </form>
                </div>


              </div>

          <div class="row">
            <div class="col-md-12">


              <div class="panel">
                <div class="panel-body ProjectFilterAll" id="ProjectList">

                         
                          
                          @include('portal.partials.search-project')


                </div>
              </div>


				

              <!-- END -->
            </div>
          </div>




        </div>

      </div>




    </div> 



@endsection



