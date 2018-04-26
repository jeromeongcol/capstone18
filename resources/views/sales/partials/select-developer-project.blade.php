<div class="row">
                        
 
<div class="col-md-6" id="projects-container">



</div>

<div class="col-md-6" id="projects-container">



</div>


</div>

@if( count( $projects ) > 0)
<div class="row">

	<div class="col-md-6" id="selectedProject-con">
			<h5>Selected Project : </h5>
			<input type="text" class="form-control" name="selectedProject" id="{{  $projects[0]->project_id }}" disabled value="{{$projects[0]->project_name}}" />
	</div>

	<div class="col-md-6" id="selectedDeveloper-con">
		<h5>Selected Developer : </h5>
			<input type="text" class="form-control" name="selectedDeveloper" id="{{  $projects[0]->developer_id }}" disabled value="{{$projects[0]->developer_name}}" />
	</div>

</div>
@endif