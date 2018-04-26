@extends('layouts-agent.app')

@section('content')

   
<div class="profile-page sales-page wrapper">
	    <div class="page-header page-header-small" filter-color="orange">
	        <div class="page-header-image" data-parallax="true" style="background-image: url('{{ asset('layouts-default/assets/img/bg5.jpg') }}');">
	        </div>
	    </div>



	    <div class="section">
	    	<div class="container">


	      	 <div class="row" id="FilterSales-con">
                <div class="col-md-5">
					
					<div class="filter-con">
				      	<label>Year : </label>
		                <select class="form-control" id="FilterSales">
		                	<option value="ALL">ALL</option>
		                    @foreach( $years as $year )
								<option value="{{$year}}">{{ $year }}</option>
							@endforeach
		                </select>
		            </div>



		              <div class="filter-con">

				      	<label>Month : </label>
		                <select class="form-control" id="FilterMonthSales">
		                	@include('portal.partials.filters.monthsInYear')
		                </select>

		              </div>

		              <div class="filter-con" id="Filter_length-con">

		              </div>
	         </div>



              <div class="col-md-3" id="Filter_search-con">

                
              </div>

              <div class="col-md-4">
                <form action="/mysales" method="GET" id="searchSalesForm">

                  {{ csrf_field() }}
                  <div class="input-group pull-right">
                    <input class="form-control" name="key" placeholder="Search in all Sales" type="text">
                    <span class="input-group-addon">
                        <i class="now-ui-icons ui-1_zoom-bold search-button"></i>
                    </span>
                  </div>
                </form>
              </div>



              </div>

		<br>

		<div  id="Sales-Content">

 			@include("portal.partials.sales-content")

	    </div><!-- Sales Content -->



		    </div>
		</div>




	</div>




@endsection
