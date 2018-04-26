     
	@if( count( $projects ) > 0)

		<div class="row">
			<div class="col-md-12" id="selectedProject-con">
				<h5>Selected Project : </h5>
				<input type="text" class="form-control" location="{{ $projects[0]->project_location }}" price="{{  $projects[0]->project_price }}" name="selectedProject" id="{{ $projects[0]->id }}" disabled value="{{$projects[0]->project_name}}" />
			</div>
		</div>


		<h4>PROJECT SEARCH {{count( $projects )}} RESULT</h4>


		<ul class="list-group" id="project-list">
		@foreach( $projects as $project )
		<li id="{{  $project->id }}" location="{{ $project->project_location }}" price="{{  $project->project_price }}" developer="{{  $project->developer_id }}" class="list-group-item">{{  $project->project_name }}</li>
		@endforeach
		</ul>  

		
	@else
		<h4>No Result Found</h4>
	@endif


	