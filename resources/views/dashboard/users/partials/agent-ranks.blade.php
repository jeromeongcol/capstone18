
        <div class="SeletedMenuHeader">
          
           <div class="row">
              <div class="col-md-4 col-xs-4">
                <h4><a class="back agent-submenu"><img src="{{ asset('layouts/img/back.png') }}"></a> Users <i class="fa fa-angle-right"></i> Agent <i class="fa fa-angle-right"></i> Ranks</h4>
              </div>
          </div>

        </div>


        <div class="container-fluid">
          <div class="row">
            <div class="col-md-8">


              <div class="panel">
                <div class="panel-body page-content">

                    
                      <table class="table data-table" id="agent-ranks-table">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th>agent ranks</th>
                              <th>description</th>
                              <th class="text-center">commision rate</th>
                            </tr>
                          </thead>
                          <tbody class="text-center">
                            @php ($i = 1)  

                            @foreach( $ranks as $rank )

                            
                            <tr id="{{ $rank->id }}" class="data @if( $i == 1) active @endif" >
                              <td>{{ $i  }}</td>
                              <td>{{ $rank->rank  }}</td>
                              <td>{{ $rank->description }}</td>
                              <td>{{ $rank->commission_rate }}</td>
                               @php ($i++)
                            </tr>
                  

                            @endforeach
                           
                          </tbody>
                      </table>
  

                </div>
              </div>
              <!-- END RECENT PURCHASES -->
            </div>

            
            <div class="col-md-4">

                <form method="POST" action="/users/agent/rank/update" id="updateAgentRankTypeForm" >

                  {{ csrf_field() }}

                        <div class="panel">
                        
                            <div class="panel-heading">
                              <h3 class="panel-title text-center">UPDATE RANK TYPE</h3>
                            </div>

                        <div class="panel-body">
                         
                          <input type="hidden" name="id"  class="selectedAgentRankTypeId" value="{{ $ranks[0]->id }}"/>
                          
                          <div class="form-group">
                               <span class="input-group-addon" >Rank Type</span>
                              <input type="text" class="form-control" value="{{ $ranks[0]->rank }}" name="rank">
                               <small class="form-text form-error rank"></small>
                          </div>

                          <div class="form-group">
                               <span class="input-group-addon" >Discription</span>
                              <input type="text" class="form-control" value="{{ $ranks[0]->description }}" name="description">
                               <small class="form-text form-error description"></small>
                          </div>

                          <div class="form-group">
                               <span class="input-group-addon" >Commission Rate</span>
                              <input type="text" class="form-control" value="{{ $ranks[0]->commission_rate }}" name="commission_rate">
                               <small class="form-text form-error commission_rate"></small>
                          </div>


                        </div>
                        <div class="panel-footer">
                              <div class="row">
                                <div class="col-md-12">
                                  <button type="submit" class="btn btn-primary btn-md btn-block">UPDATE</button>
                                </div>
                            </div>
                          </div>
                        </div>

                    </form>

            </div>



          </div>



        </div>