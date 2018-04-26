

 <p class="project_search_count">Filtered/Searched By :  <b>{{ $key }}</b> Projects , Showing {{ $projects->count() }}/{{ $projects->total() }} Projects.</p>

@if( count( $projects ) )
<div class="row">
    

    @foreach( $projects as $project )
    
        <div class="product-item col-xs-12 col-lg-4">

    <a href="/project/{{ $project->id }}/info" target="_blank">
           <div class="product-container">
                <div class="product-img">
                    <img src="{{ $project->featured_photo }}" class="actionViewProject" id="{{ $project->id }}">
                    
                    <div class="item-upper-con">

                        <div class="product-action text-right">

                          <button class="btn btn-primary btn-simple btn-round btn-category" type="button">{{ $project->type }}</button> 

                        </div>

                    </div>

                    <div class="item-lower-con">

                        <p class="project-name">{{ $project->project_name }}</p>

                        <p class="project-address">{{ $project->project_location }}</p>
                        
                    </div>
                </div>

                <div class="project-added-by-con">

                	<span class="pull-left">Added : {{ Carbon\Carbon::parse($project->created_at)->diffForHumans() }}
                    </span>

                    <span class="pull-right">{{  date('d-m-Y', strtotime($project->created_at)) }} <i class="fa fa-calendar" aria-hidden="true"></i>
                    </span>
                </div>
           </div>

    </a>
        </div>


    @endforeach
        






</div>

@else

<div class="row">
        <div class="col-md-12">
          <div class="alert alert-danger" role="alert">
                    <div class="container">
                        <strong>Ohhh !</strong> No Project found or nothing found in your search.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">
                                <i class="now-ui-icons ui-1_simple-remove"></i>
                            </span>
                        </button>
                    </div>
                </div>
        </div>
       </div>

@endif
<br><br>
<div class="row">
    <div class="col-md-12">
    {!! $projects->render('pagination::bootstrap-4') !!}
    </div>

</div>