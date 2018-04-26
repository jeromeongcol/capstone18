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
            <div class="col-md-12">


              <div class="panel">
                <div class="panel-body page-content">

                 <table class="table data-table">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Status</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      
                      @php ($i = 1)

                      @foreach( $events as $event )

                      <tr id="{{ $event->id }}" class="data @if( $i == 1) active @endif">
                       <td>{{ $i  }}</td>
                       <td>{{$event->title}}</td>
                       <td>{{$event->date}}</td>
                       <td>{{$event->time}}</td>
                       <td>
                          <span class="label @if($event->status == "cancelled")  label-danger @else  label-info @endif">{{$event->status}}</span>
                       </td>
                       <td>

                        <div class="btn-group">

                            <button type="submit" class="btn btn-primary btn-sm updateEventShowModal" id="{{$event->id}}">
                              <i class="fa fa-external-link" aria-hidden="true"></i></button>
                              @if( ( $event->status != "finished" ) && ( $event->status != "ongoing" ) )
                               
                               @if( $event->status == "upcoming")
                                  <button class="btn btn-danger btn-sm cancelEventBtn" id="{{$event->id}}">
                                    <i class="fa fa-trash" aria-hidden="true"></i></button>
                                @else
                                  <button class="btn btn-success btn-sm resumeEventBtn" id="{{$event->id}}">
                                <i class="fa fa-undo" aria-hidden="true"></i></button>
                                @endif

                              @endif
                            

                        </div>


                       </td>
                      </tr>

                       @php ($i++)

                      @endforeach

                    </tbody>
                  </table>
          

                </div>
              </div>
              <!-- END RECENT PURCHASES -->
            </div>
          </div>



        </div>
