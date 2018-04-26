@if( count($developers) >  0)

	@if( empty($project) )

		<tbody>

		    @php( $i = 1 )

		    @foreach( $developers as $developer )

		        <tr class="data  @if( $i == 1 ) active @endif">
		          <td class="text-center" style="width: 66px;"><input type="radio" name='developer' value="{{ $developer->id }}" @if( $i == 1 ) checked="checked" @endif"></td>
		          <td class="text-left developer">{{ $developer->name }}</td>
		        </tr>
		         @php( $i++ )
		    @endforeach

		</tbody>	

	@else

		<tbody>


		    @foreach( $developers as $developer )

		        <tr class="data  @if( $project->developer_name == $developer->name ) active @endif">
		          <td class="text-center" style="width: 66px;"><input type="radio" name='developer' value="{{ $developer->id }}" @if( $project->developer_name == $developer->name ) checked="checked" @endif"></td>
		          <td class="text-left developer">{{ $developer->name }}</td>
		        </tr>
		    @endforeach

		</tbody>

	@endif

@else
    <p class="text-center">No Result.</p>
@endif