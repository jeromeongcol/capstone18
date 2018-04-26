<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<html lang="en">
	<head>

		@include('layouts.head')

	</head>

 <body>
	
	
	<div class="overlay-fullscreen">
 		<div class="overlay-close">
			<i class="fa fa-times" aria-hidden="true"></i>
		</div>
 		<div class="overlay-container">

	        <div class="row">
		        <div class="col-md-12 view-overlay-content">



	           </div>
	       </div>
       </div>
 	</div>

 	<!-- WRAPPER -->
	<div id="wrapper">
		
	    @include('layouts.header')
		
		@include('layouts.sidebar')


		<!-- MAIN -->
		    <div class="main pages">
		      <!-- MAIN CONTENT -->
		      <div class="main-content">
				

		    	<div class="overlay-fullscreen-content">

		    		<img src="{{ asset('layouts/img/loading.gif') }}" />
		 		
				</div>

				<div id="content">
			    	
	       			@yield('content')

			    </div>
			    <!-- END MAIN CONTENT -->
			</div>
			<!-- END MAIN -->


        </div>

        @include('layouts.footer')
	</div>
	<!-- END WRAPPER -->


@include('layouts.modals.logout')
@include('layouts.modals.cropbox')
@include('layouts.modals.success')
@include('layouts.modals.comfirmation-modal')
@include('layouts.modals.error')
@include('layouts.modals.verifyrights')


@include('dashboard.events.modals.add-event')
@include('dashboard.events.modals.event-actions')
@include('dashboard.events.modals.event-actions')

@include('layouts.foot')
</body>
</html>
