@if( count($categories) >  0)

	@if( empty($project) )
	<tbody>

	    @php( $i = 1 )

	    @foreach( $categories as $category )

	        <tr class="data  @if( $i == 1 ) active @endif">
	          <td class="text-center" style="width: 66px;"><input type="radio" name='project_category' value="{{ $category->id }}" @if( $i == 1 )  checked="checked" @endif></td>
	          <td class="text-left category">{{ $category->type }}</td>
	        </tr>
	         @php( $i++ )
	    @endforeach

	</tbody>
	@else

		<tbody>

	    @foreach( $categories as $category )

	        <tr class="data  @if( $project->type == $category->type ) active @endif">
	          <td class="text-center" style="width: 66px;"><input type="radio" name='project_category' value="{{ $category->id }}" @if( $project->type == $category->type )  checked="checked" @endif></td>
	          <td class="text-left category">{{ $category->type }}</td>
	        </tr>

	    @endforeach

		</tbody>


	@endif

@else
    <p class="text-center">No Result.</p>
@endif