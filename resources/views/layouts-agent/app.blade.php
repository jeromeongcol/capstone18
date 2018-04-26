<!DOCTYPE html>
<html lang="en">

<head>
	@include('layouts-agent.head')
</head>

<body class="sidebar-collapse">

	<div id="MainContentNav">
		@include('layouts-agent.header')
	</div>

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



	<div id="MainContent">
		@yield('content')
	</div>

	@include('layouts-agent.footer')

</body>

	@include('layouts-agent.foot') 
	@include('layouts-agent.modals.logout')
	@include('layouts-agent.modals.update')
	@include('layouts-agent.modals.cropbox')
	@include('layouts-agent.modals.error')
	@include('layouts-agent.modals.success')


</html>