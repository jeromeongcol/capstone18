@if( $user->role == "Agent")



<!-- MAIN -->
<div class="main">
    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="container container-full">

        <div class="SeletedMenuHeader">
          
             <div class="row">
                    <div class="col-md-12">
                      <h4>USER PROFILE</h4>
                    </div>
                </div>

        </div>

            <div class="panel panel-profile">
                <div class="clearfix">
                    <!-- LEFT COLUMN -->
                    <div class="profile-left">
                        <!-- PROFILE HEADER -->
                        <div class="profile-header">
                            <div class="overlay"></div>
                            <div class="profile-main">
                                <img src="{{ $user->photo_thumb }}" class="img-circle" alt="Avatar">
                                <h3 class="name">{{ $user->lastname }} {{ $user->firstname }}</h3>
                                @if($user->active)
                                    <span class="online-status status-available">Active</span>
                                @else
                                    <span class="offline-status status-available">Not Active</span>
                                @endif
                            </div>
                        </div>
                        <!-- END PROFILE HEADER -->
                        <!-- PROFILE DETAIL -->
                        <div class="profile-detail">
                            <div class="profile-info text-center">
                                <h4 class="heading text-left">Account Info</h4>
                                <ul class="list-unstyled list-justify text-left">
                                    <li>Name <span>{{ $user->lastname }}, {{ $user->firstname }} {{ $user->middlename }}</span></li>
                                    <li>Email Address <span>{{ $user->email }}</span></li>
                                    <li>Role <span>{{ $user->role }}</span></li>

                                    @if( $user->role == "Agent")
                                      <li>Rank <span>{{ $user->rank }}</span></li>
                                      <li>Status <span>
                                          @if( $user->approved )
                                            <span class="label label-success">approved</span>
                                          @else
                                            <span class="label label-primary">disapproved</span>
                                          @endif
                                          </span>
                                      </li>
                                  @endif

                                </ul>
                                <br>
                                <button type="button" class="btn btn-success actionUpdateUserBtnShowModal" id="{{ $user->user_id }}">UPDATE INFORMATION</button>
                            </div>
                            
                        </div>
                        <!-- END PROFILE DETAIL -->
                    </div>
                    <!-- END LEFT COLUMN -->
                    <!-- RIGHT COLUMN -->
                    <div class="profile-right">
                        <!-- TABBED CONTENT -->
                        <div class="custom-tabs-line tabs-line-bottom left-aligned">
                            <ul class="nav" role="tablist">
                                <li class="active"><a href="#tab-bottom-left2" role="tab" data-toggle="tab">Downlines <span class="badge">{{ count($downlines) }}</span></a></li>
                            </ul>
                        </div>
                        <div class="tab-content">

                                <div class="tab-pane fade" id="tab-bottom-left2">
                                     <ul class="list-unstyled activity-timeline">
                                        @foreach( $downlines as $downline )
                                            <li>
                                                <i class="fa fa-check activity-icon"></i>
                                                <p>{{ $downline->name }} - {{ $downline->email }}<span class="timestamp">
                                                    {{ Carbon\Carbon::parse($downline->created_at)->diffForHumans() }}</span></p>
                                            </li>
                                        @endforeach

                                    </ul>
                                </div>

                        </div>
                        <!-- END TABBED CONTENT -->
                    </div>
                    <!-- END RIGHT COLUMN -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT -->
</div>
<!-- END MAIN -->









@else








<!-- MAIN -->
<div class="main">
    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="container container-full">

        <div class="SeletedMenuHeader">
          
             <div class="row">
                    <div class="col-md-12">
                      <h4>USER PROFILE</h4>
                    </div>
                </div>

        </div>

            <div class="panel panel-profile">
                <div class="clearfix">
                    <!-- LEFT COLUMN -->
                    <div class="profile-left myprofile-con">
                        <!-- PROFILE HEADER -->
                        <div class="profile-header">
                            <div class="overlay"></div>
                            <div class="profile-main">
                                <img src="{{ $user->photo_thumb }}" class="img-circle" alt="Avatar">
                                <h3 class="name">{{ $user->lastname }} {{ $user->firstname }}</h3>
                                @if($user->active)
                                    <span class="online-status status-available">Active</span>
                                @else
                                    <span class="offline-status status-available">Not Active</span>
                                @endif
                            </div>
                        </div>
                        <!-- END PROFILE HEADER -->
                        <!-- PROFILE DETAIL -->
                        <div class="profile-detail">
                            <div class="profile-info text-center">
                                <h4 class="heading text-left">Account Info</h4>
                                <ul class="list-unstyled list-justify text-left">
                                    <li>Name <span>{{ $user->lastname }}, {{ $user->firstname }} {{ $user->middlename }}</span></li>
                                    <li>Email Address <span>{{ $user->email }}</span></li>
                                    <li>Role <span>{{ $user->role }}</span></li>

                                    @if( $user->role == "Agent")
                                      <li>Rank <span>{{ $user->rank }}</span></li>
                                      <li>Status <span>
                                          @if( $user->approved )
                                            <span class="label label-success">approved</span>
                                          @else
                                            <span class="label label-primary">disapproved</span>
                                          @endif
                                          </span>
                                      </li>
                                  @endif

                                </ul>
                                <br>
                                <button type="button" class="btn btn-success actionUpdateUserBtnShowModal" id="{{ $user->user_id }}">UPDATE INFORMATION</button>
                            </div>
                            
                        </div>
                        <!-- END PROFILE DETAIL -->
                    </div>
                    <!-- END LEFT COLUMN -->

                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT -->
</div>
<!-- END MAIN -->





@endif

