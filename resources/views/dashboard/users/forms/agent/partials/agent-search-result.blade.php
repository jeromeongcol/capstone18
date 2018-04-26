@if( count($agents) >  0)
  <thead>
  <tr>
    <th class="text-center"></th>
    <th class="text-center">email</th>
    <th class="text-center">Name</th>
    <th class="text-center">Rank</th>
  </tr>
</thead>
<tbody>

    @php( $i = 1 )

    @if( !empty($user) )

    @foreach( $agents as $agent )

        @if( ( $user->user_id != $agent->id ) && ( $agent->recruiter != $user->user_id ) )
        <tr class="data  @if($user->recruiter == $agent->id ) active @endif">
          <td class="text-center"><input type="radio" name='recruiter' value="{{ $agent->id }}" @if($user->recruiter == $agent->id ) checked="checked" @endif></td>
          <td class="text-center">{{ $agent->email }}</td>
          <td class="text-center recruiter">{{ $agent->fullname }}</td>
          <td class="text-center">{{ $agent->rank }}</td>
        </tr>
         @php( $i++ )
         @endif
    @endforeach

    @else

    @foreach( $agents as $agent )
        <tr class="data @if($i == 1) active @endif">
          <td class="text-center"><input type="radio" name='recruiter' value="{{ $agent->id }}" @if($i == 1) checked="checked" @endif></td>
          <td class="text-center">{{ $agent->email }}</td>
          <td class="text-center recruiter">{{ $agent->fullname }}</td>
          <td class="text-center">{{ $agent->rank }}</td>
        </tr>
         @php( $i++ )
    @endforeach

    @endif
    
</tbody>
@else
    <p class="text-center">No Result.</p>
@endif