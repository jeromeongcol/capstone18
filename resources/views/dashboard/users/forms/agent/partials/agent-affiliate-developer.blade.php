@if( count($developers) >  0)
  <thead>
  <tr>
    <th class="text-center"></th>
    <th class="text-center">Developer name</th>
    <th class="text-center">Contact #</th>
    <th class="text-center">Address</th>
  </tr>
</thead>
<tbody>

    @php( $i = 1 )

    @foreach( $developers as $developer )

        <tr class="data">
          <td class="text-center"><input type="radio" name='developer' value="{{ $developer->id }}"></td>
          <td class="text-center  developer-name">{{ $developer->name }}</td>
          <td class="text-center">{{ $developer->contact }}</td>
          <td class="text-center">{{ $developer->address }}</td>
        </tr>
         @php( $i++ )
    @endforeach
    
</tbody>
@else
    <p class="text-center">No Result.</p>
@endif