     

	@if( count( $developers ) > 0)

        <div class="row">
            <div class="col-md-12" id="selectedDeveloper-con">
            	<h5>Selected Developer : </h5>
            	<input type="text" class="form-control" name="selectedDeveloper" id="{{  $developers[0]->id }}" disabled value="{{$developers[0]->developer_name}}" />
            </div>
        </div>

	  <h4>DEVELOPER SEARCH {{count( $developers )}} RESULT</h4>
	  <ul class="list-group" id="developer-list">
	  	@foreach( $developers as $developer )
	    <li id="{{  $developer->id }}" class="list-group-item">{{  $developer->developer_name }}</li>
	    @endforeach
	  </ul>  
	  @else
	  	<h4>No Result Found</h4>
	  @endif

	