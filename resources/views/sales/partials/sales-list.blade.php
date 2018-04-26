
<div class="col-md-12 col-list">
  <!-- TABLE HOVER -->


  <div class="list-con float-left">


        <div class="list-container">

         <table class="table table-hover data-table-list" id="sales-table">
          <thead>
            <tr>
              <th>#</th>
              <th>Agent</th>
              <th>Project</th>
              <th>Developer</th>
              <th>Contract Price</th>
              <th>Date Reserve</th>
              <th>Status</th>
              <th class="text-center">Actions</th>

            </tr>
          </thead>
          <tbody>
            @php ($i = 1)  

            @foreach( $sales as $sale )

            
            <tr id="{{ $sale->sales_id }}" class="data @if( $i == 1) active @endif">
              <td>{{ $i  }}</td>
              <td>{{ $sale->agent_name }}</td>
              <td>{{ $sale->project_name }}</td>
              <td>{{ $sale->developer_name }}</td>
              <td>{{ $sale->total_contract_price }}</td>
              <td>{{ $sale->date_reserve }}</td>
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
                <div class="btn-group" role="group" aria-label="First group">
                 <button type="submit" class="btn btn-info btn-sm updateSalesShowForm" id="{{ $sale->sales_id }}">
                  <i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                  
                  @if( $sale->cancelled )

                    <button type="submit" class="btn btn-success btn-sm unCancelSalesBtn" id="{{ $sale->sales_id }}">
                    <i class="fa fa-undo" aria-hidden="true"></i></button>

                  
                  @else
                  


                     @if( !$sale->approved )
                      <button type="submit" class="btn btn-success btn-sm approveSalesBtn" id="{{ $sale->sales_id }}">
                      <i class="fa fa-thumbs-up" aria-hidden="true"></i></button>
                    @endif
                  

                     <button type="submit" class="btn btn-danger btn-sm cancelSalesBtn" id="{{ $sale->sales_id }}">
                    <i class="fa fa-times" aria-hidden="true"></i></button>

                  @endif



                      <button type="submit" class="btn btn-primary btn-sm viewSalesDetails" id="{{ $sale->sales_id }}">
                    <i class="fa fa-external-link" aria-hidden="true"></i></button>
                    
                </div>

               </td>
               @php ($i++)
            </tr>
  

            
            @endforeach
           
          </tbody>
        </table>
        </div>

        
</div>
</div>
