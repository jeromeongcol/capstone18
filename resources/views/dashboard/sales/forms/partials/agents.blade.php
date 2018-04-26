@if( count($agents) >  0)

	@if( empty($sales) )

		<tbody>

		    @php( $i = 1 )

		    <tr>
		          <td class="text-center" style="width: 66px;"></td>
		          <td class="text-left">Agent Name</td>
		          <td class="text-left">Agent Email Address</td>
		          <td class="text-left">Agent Rank</td>
		          <td class="text-left">Downlines</td>
		    </tr>

		    @foreach( $agents as $agent )

		        <tr class="data  @if( $i == 1 ) active @endif">
		          <td class="text-center" style="width: 66px;"><input type="radio" name='agent' value="{{ $agent->id }}" @if( $i == 1 ) checked="checked" @endif"></td>
		          <td class="text-left agent_name">{{ $agent->lastname }}, {{ $agent->firstname }} {{ $agent->middlename}}</td>
		          <td class="text-left agent_email">{{ $agent->email }}</td>
		          <td class="text-left agent_rank">{{ $agent->rank }}</td>
		          <td class="text-left agent_downlines">{{ $agent->downlines }}</td>
		        </tr>
		         @php( $i++ )
		    @endforeach

		</tbody>	

	@else

	
			@php( $i = 1 )

		    <tr>
		          <td class="text-center" style="width: 66px;"></td>
		          <td class="text-left">Agent Name</td>
		          <td class="text-left">Agent Email Address</td>
		          <td class="text-left">Agent Rank</td>
		          <td class="text-left">Downlines</td>
		    </tr>

		    @foreach( $agents as $agent )

		        <tr class="data  @if( $sales->agent_id == $agent->id ) active @endif">
		          <td class="text-center" style="width: 66px;"><input type="radio" name='agent' value="{{ $agent->id }}" @if( $sales->agent_id == $agent->id ) checked="checked" @endif"></td>
		          <td class="text-left agent_name">{{ $agent->lastname }}, {{ $agent->firstname }} {{ $agent->middlename}}</td>
		          <td class="text-left agent_email">{{ $agent->email }}</td>
		          <td class="text-left agent_rank">{{ $agent->rank }}</td>
		          <td class="text-left agent_downlines">{{ $agent->downlines }}</td>
		        </tr>
		         @php( $i++ )
		    @endforeach




	@endif

@else
    <p class="text-center">No Result.</p>
@endif