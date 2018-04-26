    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-info fixed-top navbar-transparent" color-on-scroll="400">
        <div class="container">
            <div class="navbar-translate">
                <a class="navbar-brand avatar-link" href="/profile" rel="tooltip" title="My Awesome Profile" data-placement="bottom" target="_self">
                    
                 <img src="{{ $auth->photo }}" alt="" class="rounded-circle"> {{ $auth->lastname }}, {{ $auth->firstname }} {{ $auth->middlename }}
                </a>
                <button class="navbar-toggler navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-bar bar1"></span>
                    <span class="navbar-toggler-bar bar2"></span>
                    <span class="navbar-toggler-bar bar3"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse justify-content-end" id="navigation" data-nav-image="../assets/img/blurred-image-1.jpg">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ (Request::is('profile') ? 'active' : '') }}" href="/profile">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ (Request::is('developers/projects') ? 'active' : '') }} {{ (Request::is('project/*') ? 'active' : '') }}" href="/developers/projects">Projects</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ (Request::is('mysales') ? 'active' : '') }}" href="/mysales">Sales</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ (Request::is('agent/events') ? 'active' : '') }}" href="/agent/events">Events</a>
                    </li>
                    
                
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-expanded="false">
                            <i class="now-ui-icons ui-1_bell-53" aria-hidden="true"></i>
                            <span class="badge bg-danger">{{ count( auth()->user()->unreadNotifications ) }}</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right notifications" aria-labelledby="navbarDropdownMenuLink">


                                @foreach( auth()->user()->unreadNotifications->toArray() as $notifications )

                                <a class="dropdown-item">
                                    <div class='notification-item-con'>

                                        <div class="notificaton-item-logo"><img src="{{ $notifications['data']['Author']['photo'] }}" /></div>
                                        <div class="notificaton-item-title">{!! $notifications['data']['Message'] !!}<br>
                                        <b>{{ Carbon\Carbon::parse($notifications['data']['Event']['created_at'])->diffForHumans() }}</b></div>

                                    </div>
                                </a>

                                @endforeach
                                @if( count( auth()->user()->unreadNotifications ) > 0)
                                   <a class="dropdown-item text-center">See all notifications</a>
                                @else
                                   <a class="dropdown-item text-center">No notifications</a>
                                @endif


                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" rel="tooltip" data-toggle="modal" data-target="#LogOutModal" title="Logout" data-placement="bottom" >
                            <i class="fa fa-sign-out"></i>
                            <p class="d-lg-none d-xl-none">Logout</p>
                        </a>
                    </li>


                </ul>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->


