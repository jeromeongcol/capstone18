<div class="row">
  <div class="col-md-12">

    <div class="panel">
      <div class="panel-body page-content">

              @if( count($events) > 0 )
          
                 <table class="table data-table">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Status</th>
                        <th class="text-center">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      
                      @php ($i = 1)

                      @foreach( $events as $event )

                      <tr id="{{ $event->id }}" class="data @if( $i == 1) active @endif @if($event->status == 'ongoing') ongoing-event @endif">
                       <td>{{ $i  }}</td>
                       <td>{{$event->title}}</td>
                       <td>{{$event->date}}</td>
                       <td>{{$event->time}}</td>
                       <td><span class="label label-info">{{$event->status}}</span></td>
                       <td class="text-center">

                        <div class="btn-group">

                            <button type="submit" class="btn btn-info btn-sm actionViewEventDetails" id="{{$event->id}}"><i class="fa fa-external-link aria-hidden="true"></i> view</button>

                        </div>


                       </td>
                      </tr>

                       @php ($i++)

                      @endforeach

                    </tbody>
                  </table>

      @endif

    
    
      </div>
    </div>
    
  </div>
</div>

