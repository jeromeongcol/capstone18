<!-- MAIN -->
<div class="main">
    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="container-full">

            <div class="SeletedMenuHeader">
              <div class="row">
                  <div class="col-md-12">
                      <h4>EVENT DETAILS</h4>
                  </div>
              </div>
            </div>

            <div class="panel panel-profile panel-sales">
                <div class="row">

                    <div class="col-md-4" >

                        <div class="panel">
                            <div class="panel-heading">
                                <h3 class="panel-title">Project Details</h3>
                            </div>
                            <div class="panel-body">
                                 <ul class="list-unstyled list-justify">
                                    <li><b>Title</b> <span>{{ $event->title }}</span></li>
                                    <li><b>Date</b> <span>{{ $event->date  }}</span></li>
                                    <li><b>Time</b> <span>{{ $event->time  }}</span></li>
                                    <li><b>Speaker</b> <span>{{ $event->speaker  }}</span></li>
                                    <li><b>Venue</b> <span>{{ $event->venue }}</span></li>
                                    <li><b>Status</b> <span>{{ $event->status }}</span></li>
                                </ul>
                            </div>
                        </div>


                    </div>
                    
                    <div class="col-md-8" >

                        <div class="panel">
                            <div class="panel-heading">
                                <h3 class="panel-title">Event Description</h3>
                            </div>
                            <div class="panel-body project-description-con">
                                <p>{!! $event->description !!}</p>
                            </div>
                        </div>

                    </div>


                </div>
            </div>



        </div>
    </div>
</div>

