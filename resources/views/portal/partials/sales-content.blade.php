<div class="row">
  <div class="col-md-12">

    <div class="panel">
      <div class="panel-body page-content">
    
      @if( count($sales) > 0 )
          
       <table class="table data-table">
        <thead>
          <tr>
            <th>#</th>
            <th>Project</th>
            <th>Developer</th>
            <th>Project Type</th>
            <th>Contract Price</th>
            <th>Date</th>
            <th>Assumed Commission</th>
            <th></th>

          </tr>
        </thead>
        <tbody>
          @php ($i = 1)  

          @foreach( $sales as $sale )

          
          <tr id="{{ $sale->sales_id }}" class="data @if( $i == 1) active @endif">
            <td>{{ $i  }}</td>
            <td>{{ $sale->project_name }}</td>
            <td>{{ $sale->developer_name }}</td>
            <td>{{ $sale->category }}</td>
            <td>{{ $sale->total_contract_price }}</td>
            <td>{{ $sale->date_reserve }}</td>
            <td class="text-center">{{ $sale->assumed_commission }}</td>
            <td><button class="btn btn-info btn-sm actionViewSalesInfo" id="{{$sale->sales_id}}" type="button"><i class="now-ui-icons travel_info"></i> view</button></td>
             @php ($i++)
          </tr>


          
          @endforeach
         
        </tbody>
      </table>

      @else

        <div class="row">
        <div class="col-md-12">
          <div class="alert alert-danger" role="alert">
                    <div class="container">
                        <strong>Ohhh !</strong> You have no sales yet or nothing found in your search.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">
                                <i class="now-ui-icons ui-1_simple-remove"></i>
                            </span>
                        </button>
                    </div>
                </div>
        </div>
       </div>

  
      @endif

      </div>
    </div>
    
  </div>
</div>

