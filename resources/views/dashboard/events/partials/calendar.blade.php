<div class="SeletedMenuHeader">
  
 <div class="row">
    <div class="col-md-4 col-xs-4">
      <h4>Events</h4>
    </div>

    <div class="col-md-8 col-xs-8 text-right">


        <div class="btn-group btn-group-icon-only">

                <button class="btn btn-info btn-md events-list" id="">
                  <i class="fa fa-list" aria-hidden="true"></i>
                </button>
                <button class="btn btn-primary btn-md calendar-view" id="">
                  <i class="fa fa-calendar" aria-hidden="true"></i>
                </button>

        </div>              
      <button type="button" class="btn btn-primary addEventShowModal">
        <img src="{{ asset('layouts/img/add-event.png') }}"> Add Event
      </button>
    </div>
 </div>

</div>

<div class="container-fluid">
  <div class="row">
	<div class="col-md-10 col-md-offset-1" id="calendar-main-container">
		<div id='calendar'></div>
      <div class="calendar-legend">
      <span>LEGEND : </span>
      <span class="label label-default stat-finished">FINISHED</span>
      <span class="label label-primary stat-upcoming">UPCOMING</span>
      <span class="label label-success stat-ongoing">ONGOING</span>
      <span class="label label-success stat-cancelled">CANCELLED</span>
   </div>
	</div>
  </div>
</div>
