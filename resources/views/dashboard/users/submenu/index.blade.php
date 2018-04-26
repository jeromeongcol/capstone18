<!-- LEFT SIDEBAR -->
<div id="sidebar-nav" class="sidebar">
	<div class="sidebar-scroll">
		
		<div class="panel">
			<div class="panel-body no-padding sub-menu">
				<button type="button" class="btn btn-primary btn-lg col-md-12 col-xs-12" id="backToMainMenu">
					<i class="fa fa-th" aria-hidden="true"></i>  &nbsp;Main Menu
				</button>

				<button type="button" class="btn btn-primary btn-lg col-md-12 col-xs-12 agent-submenu {{ (Request::is('users/agent') ? 'active' : '') }}{{ (Request::is('users/agent/add') ? 'active' : '') }}{{ (Request::is('users/agent/ranks') ? 'active' : '') }}{{ (Request::is('users') ? 'active' : '') }}">Agent</button>
				
				
				@if( ( $auth->role == "Admin") ||  ( $auth->role == "SuperAdmin") )
				<button type="button" class="btn btn-primary btn-lg col-md-12 col-xs-12 staff-submenu {{ (Request::is('users/staff') ? 'active' : '') }}{{ (Request::is('users/staff/add') ? 'active' : '') }}">Staff</button>
				@endif

				@if( $auth->role == "SuperAdmin" )
				<button type="button" class="btn btn-primary btn-lg col-md-12 col-xs-12 admin-submenu {{ (Request::is('users/admin') ? 'active' : '') }}{{ (Request::is('users/admin/add') ? 'active' : '') }}">Admin</button>
				@endif

			</div>
		</div>



	</div>
</div>
<!-- END LEFT SIDEBAR -->