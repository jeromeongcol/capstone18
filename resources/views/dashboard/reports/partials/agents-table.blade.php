 <table class="table data-table-report">
  <thead>
    <tr>

      <th>#</th>
      <th>Lastname</th>
      <th>Firstname</th>
      <th>Middlename</th>
      <th>Email</th>
      <th>Rank</th>
      <th>Downlines</th>

    </tr>
  </thead>
  <tbody>


    @php ($i = 1)  

    @foreach( $agents as $agent )

    <tr id="{{ $agent->id }}" class="data @if( $i == 1) active @endif">

      <td>{{ $i  }}</td>
      <td>{{ $agent->lastname  }} </td>
      <td>{{ $agent->firstname  }}</td>
      <td>{{ $agent->middlename  }}</td>
      <td>{{ $agent->email  }}</td>
      <td>{{ $agent->rank  }}</td>
      <td>{{ $agent->downlines  }}</td>
       @php ($i++)

    </tr>


    
    @endforeach


   
  </tbody>
</table>