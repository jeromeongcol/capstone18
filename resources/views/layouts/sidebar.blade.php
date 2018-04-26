<!-- LEFT SIDEBAR -->
<div id="sidebar-nav" class="sidebar">
	<div class="sidebar-scroll">
		<nav>
			<ul class="nav">
				<li><a href="/dashboard" class="{{ (Request::is('/') ? 'active' : '') }}{{ (Request::is('dashboard') ? 'active' : '') }}{{ (Request::is('home') ? 'active' : '') }} dashboard-submenu" ><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>

				
				<li><a class="{{ (Request::is('users/*') ? 'active' : '') }} agent-submenu"><i class="lnr lnr-users"></i> <span>Users</span></a></li>

				<li><a class="{{ (Request::is('developers') ? 'active' : '') }} developers-menu"><i class="lnr lnr-apartment"></i> <span>Developers</span></a></li>

				<li><a class="{{ (Request::is('projects') ? 'active' : '') }} {{ (Request::is('projects/*') ? 'active' : '') }} projects-menu"><i class="fa fa-tasks" aria-hidden="true"></i> <span>Projects</span></a></li>

				<li><a class="{{ (Request::is('sales') ? 'active' : '') }} {{ (Request::is('sales/*') ? 'active' : '') }} sales-menu-approved"><i class="fa fa-line-chart" aria-hidden="true"></i> <span>Sales</span></a></li>



				<li><a class="{{ (Request::is('events') ? 'active' : '') }} {{ (Request::is('events/*') ? 'active' : '') }} calendar-view"><i class="fa fa-calendar-check-o" aria-hidden="true"></i> <span>Events</span></a></li>
				
				<li><a class="{{ (Request::is('reports') ? 'active' : '') }} reports-menu"><i class="lnr lnr-printer"></i> <span>Reports</span></a></li>

				

				{{-- <li><a class="{{ (Request::is('notifications') ? 'active' : '') }} notification-menu"><i class="lnr lnr-alarm"></i> <span>Notifications</span></a></li>
 --}}

				<!-- <li><a href="/treeview" class="{{ (Request::is('treeview') ? 'active' : '') }} treeview-menu"><i class="lnr lnr-alarm"></i> <span>TreeView</span></a></li> -->
				
			</ul>
		</nav>
	</div>
</div>
<!-- END LEFT SIDEBAR -->

