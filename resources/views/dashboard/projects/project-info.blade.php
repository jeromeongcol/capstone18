<!-- MAIN -->
<div class="main">
    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="container container-full">

        <div class="SeletedMenuHeader">
          
             <div class="row">
                    <div class="col-md-12">
                      <h4>PROJECT INFORMATION</h4>
                    </div>
                </div>

        </div>

            <div class="panel panel-profile">
                <div class="clearfix">
                    <!-- LEFT COLUMN -->
                    <div class="profile-left">
                        <!-- PROFILE HEADER -->
                        <div class="profile-header project-featured-photo">
                            <img src="{{ $project->featured_photo }}" alt="Avatar">
                        </div>
                        <!-- END PROFILE HEADER number_format( $totalSales, 2, '.', ',' ) -->
                        <!-- PROFILE DETAIL -->
                        <div class="profile-detail">
                            <div class="profile-info project-info text-center">

                                <br><br>
                                <button type="button" class="btn btn-success actionUpdateProject" id="{{ $project->id }}">UPDATE INFORMATION</button>
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
                                <li class="active"><a href="#tab-bottom-left1" role="tab" data-toggle="tab">Project Information</a></li>

                                <li><a href="#tab-bottom-left3" role="tab" data-toggle="tab">Project Descriptioin</a></li>
                                
                                <li><a href="#tab-bottom-left2" role="tab" data-toggle="tab">Project Photos<span class="badge"></span></a></li>
                                
                            </ul>
                        </div>
                        <div class="tab-content active">
                            
                            <div class="tab-pane fade in active" id="tab-bottom-left1">

                                <ul class="list-unstyled list-justify text-left">
                                    <li><b>Project Name </b><span>{{ $project->project_name }}</span></li>
                                    <li><b>Project Location </b><span>{{ $project->project_location }}</span></li>
                                    <li><b>Developer </b><span>{{ $project->developer_name }}</span></li>
                                    <li><b>Category </b><span>{{ $project->type }}</span></li>
                                </ul>

                            </div>


                           <div class="tab-pane fade" id="tab-bottom-left3">
                                {!! $project->project_description !!}

                            </div>

                            <div class="tab-pane fade project-photos-gallery" id="tab-bottom-left2">
                                
                                @foreach( $project_photos as $photo )

                                <a class="fancybox" href="{{ $photo->photo }}" data-fancybox-group="gallery" title="{{ $project->project_name }}"><img src="{{ $photo->photo }}" alt="" height="70px"/></a>
                                
                                @endforeach

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