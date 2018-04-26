 <table class="table data-table-report">
  <thead>
    <tr>

      <th>#</th>
      <th>Agent Name</th>
      <th>Project Name</th>
      <th>Developer</th>
      <th>Client</th>
      <th>Date Reserve</th>
      <th>Contract Price</th>

    </tr>
  </thead>
  <tbody>


    @php ($i = 1)  
    @php ($totalSales = 0)  

    @foreach( $sales as $sale )

    
    <tr id="{{ $sale->sales_id }}" class="data @if( $i == 1) active @endif">

      <td>{{ $i  }}</td>
      <td>{{ $sale->agent_name }}</td>
      <td>{{ $sale->project_name }}</td>
      <td>{{ $sale->developer_name }}</td>
      <td>{{ $sale->client_name }}</td>
      <td>{{ $sale->date_reserve }}</td>
      <td>{{ $sale->total_contract_price }}</td>
       @php ($i++)
       @php ($totalSales = $totalSales + $sale->total_contract_price)

    </tr>


    
    @endforeach

    <tfoot align="right">
      <tr>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th class="text-right">Total : </th>
        <th>{{$totalSales}}</th>
      </tr>
    </tfoot>

   
  </tbody>
</table>