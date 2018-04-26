@if( count($projects) >  0)


		@if( empty($sales) )

			<tbody>

			    @php( $i = 1 )
				<tr>
			          <td class="text-center" style="width: 66px;"></td>
			          <td class="text-left"><b>Project Name</b></td>
			          <td class="text-left"><b>Project Location</b></td>
			          <td class="text-left"><b>Developer</b></td>
			          <td class="text-left"><b>Project Category</b></td>
			    </tr>

			    @foreach( $projects as $project )

			        <tr class="data  @if( $i == 1 ) active @endif">
			          <td class="text-center" style="width: 66px;"><input type="radio" name='project' value="{{ $project->id }}" @if( $i == 1 ) checked="checked" @endif"></td>
			          <td class="text-left project_name">{{ $project->project_name }}</td>
			          <td class="text-left project">{{ $project->project_location }}</td>
			          <td class="text-left project_developer">{{ $project->developer }}</td>
			          <td class="text-left project">{{ $project->category }}</td>
			        </tr>
			         @php( $i++ )
			    @endforeach

			</tbody>	
		@else

				<tbody>

			    @php( $i = 1 )
				<tr>
			          <td class="text-center" style="width: 66px;"></td>
			          <td class="text-left"><b>Project Name</b></td>
			          <td class="text-left"><b>Project Location</b></td>
			          <td class="text-left"><b>Developer</b></td>
			          <td class="text-left"><b>Project Category</b></td>
			    </tr>

			    @foreach( $projects as $project )

			        <tr class="data  @if( $sales->project_id == $project->id ) active @endif">
			          <td class="text-center" style="width: 66px;"><input type="radio" name='project' value="{{ $project->id }}" @if( $sales->project_id == $project->id ) checked="checked" @endif"></td>
			          <td class="text-left project_name">{{ $project->project_name }}</td>
			          <td class="text-left project">{{ $project->project_location }}</td>
			          <td class="text-left project_developer">{{ $project->developer }}</td>
			          <td class="text-left project">{{ $project->category }}</td>
			        </tr>
			         @php( $i++ )
			    @endforeach

			</tbody>

		@endif

@else
    <p class="text-center">No Result.</p>
@endif