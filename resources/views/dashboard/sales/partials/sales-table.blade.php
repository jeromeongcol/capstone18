 <table class="table data-table">
  <thead>
    <tr>
      <th>#</th>
      <th>Project</th>
      <th>Contract Price</th>
      <th>Date Reserve</th>
      <th>Assumed Commission</th>
      <th>Status</th>
      <th class="text-center">Actions</th>

    </tr>
  </thead>
  <tbody>
    @php ($i = 1)  

    @foreach( $sales as $sale )

    
    <tr id="{{ $sale->sales_id }}" class="data @if( $i == 1) active @endif">
      <td>{{ $i  }}</td>
      <td>{{ $sale->project_name }}</td>
      <td>{{ $sale->total_contract_price }}</td>
      <td>{{ $sale->date_reserve }}</td>
      <td>{{ $sale->assumed_commission }}</td>
      <td>
          @if( $sale->approved )
            <span class="label label-success">approved</span>
          @else
             <span class="label label-danger">pending</span>
          @endif

          @if( $sale->cancelled )
            <span class="label label-danger">cancelled</span>
          @endif
      </td>
      
       <td class="actions text-center">

         <div class="dropdown">
          <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">ACTIONS &nbsp;
          <span class="caret"></span></button>
          <ul class="dropdown-menu">

            <li>
              <a class="updateSalesShowForm" id="{{ $sale->sales_id }}">
                <i class="fa fa-pencil-square-o" aria-hidden="true"></i> UPDATE SALES
              </a>
            </li>
            <li class="divider"></li> 
            <li>
              <a class="viewSalesDetails" id="{{ $sale->sales_id }}">
                <i class="fa fa-external-link" aria-hidden="true"></i> REVIEW SALES</a>
            </li>

             <li class="divider"></li> 

            @if( $sale->cancelled )

            <li>
              <a class="unCancelSalesBtn" id="{{ $sale->sales_id }}">
                <i class="fa fa-undo" aria-hidden="true"></i>UNCANCEL SALES
              </a>
            </li>

            @else
              
              <li>
                <a class="cancelSalesBtn" id="{{ $sale->sales_id }}">
                  <i class="fa fa-times" aria-hidden="true"></i>CANCEL SALES
                </a>
              </li>


              @if( ( $auth->role == "Admin") ||  ( $auth->role == "SuperAdmin") )
              
                    @if( !$sale->approved )
                    
                    <li class="divider"></li> 

                      <li>
                        <a class="approveSalesBtn" id="{{ $sale->sales_id }}">
                          <i class="fa fa-thumbs-up" aria-hidden="true"></i>APPROVE SALES
                        </a>
                      </li>

                    @endif
                    
              @endif

            @endif



          </ul>
        </div> 

       </td>
       @php ($i++)
    </tr>


    
    @endforeach
   
  </tbody>
</table>