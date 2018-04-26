     

	@if( count( $agents ) > 0)
      <h4>{{count( $agents )}} Search Results</h4>
	  <ul class="list-group" id="recruiter-list">
	  	@foreach( $agents as $agent )
	    <li id="{{  $agent->id }}" rank="{{  $agent->rank }}" class="list-group-item">{{  $agent->fullname }}</li>
	    @endforeach
	  </ul>  

        <div class="row">
            <div class="col-md-12">
            	<h5>Selected Recruiter : </h5>


            	<div class="row">
            		<div class="col-md-12" id="selectedRecruiter-con">

		            	 <div class="row">
		            		<div class="col-md-10 side-by-side-col-left">
		            			<input type="text" id="{{$agents[0]->id}}" class="form-control" name="selectedRecruiter" disabled value="{{$agents[0]->fullname}}" />
				            </div>
				            <div class="col-md-2 side-by-side-col-right">
		            			<input type="text" class="form-control" name="selectedRecruiter-rank" disabled value="{{$agents[0]->rank }}" />
				            </div>
				        </div>

					</div>
		        </div>




            </div>
        </div>
	  @else
	  	<h4>No Result Found</h4>
	  @endif

	