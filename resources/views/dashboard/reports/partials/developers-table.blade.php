 <table class="table data-table-report">
  <thead>
    <tr>

      <th>#</th>
      <th>Company name</th>
      <th>Address</th>
      <th>Contact #</th>
      <th>Fax #</th>
      <th>Active</th>

    </tr>
  </thead>
  <tbody>


    @php ($i = 1)  

    @foreach( $developers as $developer )

    <tr id="{{ $developer->id }}" class="data @if( $i == 1) active @endif">

      <td>{{ $i  }}</td>
      <td>{{ $developer->name  }} </td>
      <td>{{ $developer->address  }}</td>
      <td>{{ $developer->contact  }}</td>
      <td>{{ $developer->fax  }}</td>
      <td>{{ $developer->active  }}</td>
       @php ($i++)

    </tr>


    
    @endforeach


   
  </tbody>
</table>