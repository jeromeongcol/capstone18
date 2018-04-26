@extends('layouts-agent.app')

@section('content')

   
<div class="profile-page events-page wrapper">

	    <div class="page-header page-header-small" filter-color="orange">
	        <div class="page-header-image" data-parallax="true" style="background-image: url('{{ asset('layouts-default/assets/img/bg5.jpg') }}');">
	        </div>
	    </div>

	    <div class="section">
	    	<div class="container">
				
	      	 <div class="row" id="FilterSales-con">

	      	 	<div class="col-md-6">
					
					<h3>Upcoming @if( !empty ( $ongoing ) ) And Ongoing @endif Events</h3>
                
           	   </div>

                <div class="col-md-3">
					
					<div class="filter-con">
		            </div>

		              <div class="filter-con">

		              </div>

		              <div class="filter-con" id="Filter_length-con" style="float:right">

		              </div>
	        	 </div>



              <div class="col-md-3" id="Filter_search-con">

                
              </div>




              </div>
	

				<br>

				<div  id="Events-Content">

		 			@include("portal.partials.events-content")

			    </div><!-- Sales Content -->



		    </div>
		</div>




	</div>




@endsection
