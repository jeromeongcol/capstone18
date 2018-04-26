		<!-- NAVBAR -->
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="brand">
				<a href="/"><img src="{{ asset('layouts/img/LAlogo.png') }}" alt="Klorofil Logo" class="img-responsive logo"></a>
			</div>
			<div class="container-fluid">
				<div class="navbar-btn">
					<button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-arrow-left-circle"></i></button>
				</div>

				<div id="navbar-menu">
					<ul class="nav navbar-nav navbar-right">

						<li class="dropdown">
							<a class="dropdown-toggle icon-menu" id="notifications_menu" data-toggle="dropdown">
								<i class="lnr lnr-alarm"></i>
								<span class="badge bg-danger">{{ count( auth()->user()->unreadNotifications ) }}</span>
							</a>
							<ul class="dropdown-menu notifications">
							
								@foreach( auth()->user()->unreadNotifications->toArray() as $notifications )

								<li>
									<div class='notification-item-con'>

										<div class="notificaton-item-logo"><img src="{{ $notifications['data']['Author']['photo'] }}" /></div>
										<div class="notificaton-item-title">{!! $notifications['data']['Message'] !!}<br>
										<b>{{ Carbon\Carbon::parse($notifications['data']['Event']['created_at'])->diffForHumans() }}</b></div>

									</div>

								@endforeach
								@if( count( auth()->user()->unreadNotifications ) > 0)
									<li><a href="#" class="more">See all notifications</a></li>
								@else
									<li><a href="#" class="more">No notifications</a></li>
								@endif
							</ul>
						</li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="{{ $auth->photo_thumb }}" class="img-circle" alt="Avatar"> <span>{{ $auth->lastname }}</span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
							<ul class="dropdown-menu">
								<li><a class="actionViewUserBtnShowModal" id="{{ $auth->id }}"><i class="lnr lnr-user"></i> <span>My Profile</span></a></li>
								<li><a data-toggle="modal" data-target="#logOutModal"><i class="lnr lnr-exit"></i> <span>Logout</span></a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		<!-- END NAVBAR -->