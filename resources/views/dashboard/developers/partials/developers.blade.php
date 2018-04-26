
        <div class="SeletedMenuHeader">
          
         <div class="row">
            <div class="col-md-4 col-xs-4">
              <h4>Developers</h4>
            </div>

            <div class="col-md-8 col-xs-8 text-right">
              <button type="button" class="btn btn-primary"  id="AddDeveloperBtn">
                <img src="{{ asset('layouts/img/addproject.png') }}"> Add Developer
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
                            <th class="text-left">#</th>
                            <th class="text-left">Name</th>
                            <th class="text-left">Address</th>
                            <th class="text-left">Contacts</th>
                            <th class="text-center">Status</th>
                            <th>actions</th>
                            
                          </tr>
                        </thead>
                        <tbody>
                          @php ($i = 1)  
                          @foreach( $developers as $developer )

                          <tr id="{{ $developer->id }}" class="data @if( $i == 1) active @endif">
                            <td>{{ $i }}</td>
                            <td>{{ $developer->name  }}</td>
                            <td>{{ $developer->address  }}</td>
                            <td>{{ $developer->contact  }}</td>
                            <td class="text-center">
                                @if( $developer->active )
                                  <span class="label label-success">active</span>
                                @else
                                  <span class="label label-danger">not active</span>
                                @endif
                            </td>



                            <td class="actions text-center">

                                <div class="btn-group" role="group" aria-label="First group">
                              
                                <button type="button"  id="{{ $developer->id }}" class="btn btn-primary actionViewDeveloper"><i class="fa fa-user-o" aria-hidden="true"></i></button>
                               

                                <button type="button"  id="{{ $developer->id }}" class="btn btn-info actionUpdateDeveloper"><i class="fa fa-pencil" aria-hidden="true"></i></button>

                                @if( $developer->active )
              
                                <button type="button" id="{{ $developer->id }}" class="btn btn-danger actionSetNotActiveDeveloperShowModal"><i class="fa fa-times" aria-hidden="true"></i></button>

                                @else

                                <button type="button" id="{{ $developer->id }}" class="btn btn-success actionSetActiveDeveloperShowModal"><i class="fa fa-undo" aria-hidden="true"></i></button>

                                @endif

                              </div>
                           </td>

                            
                             @php ($i++)
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
          

                </div>
              </div>
              <!-- END RECENT PURCHASES -->
            </div>
          </div>



        </div>