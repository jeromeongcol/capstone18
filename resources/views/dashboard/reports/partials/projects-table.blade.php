 <table class="table data-table-report">
  <thead>
    <tr>

      <th>#</th>
      <th>Project Name</th>
      <th>Project Location</th>
      <th>Developer</th>
      <th>Category</th>
      <th>Added by</th>

    </tr>
  </thead>
  <tbody>


    @php ($i = 1)  

    @foreach( $projects as $project )

    <tr id="{{ $project->id }}" class="data @if( $i == 1) active @endif">

      <td>{{ $i  }}</td>
      <td>{{ $project->project_name  }} </td>
      <td>{{ $project->project_location  }}</td>
      <td>{{ $project->developer  }}</td>
      <td>{{ $project->category  }}</td>
       <td>{{ $project->email  }}</td>
      
       @php ($i++)

    </tr>


    
    @endforeach


   
  </tbody>
</table>