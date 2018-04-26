@extends('layouts-agent.app')

@section('content')

   
<div class="profile-page project-page wrapper">
    <div class="page-header page-header-small" filter-color="orange">
        <div class="page-header-image" data-parallax="true" style="background-image: url('{{ asset('layouts-default/assets/img/bg5.jpg') }}');">
        </div>
    </div>
    <div class="section">

		<div class="container view-project-container">

			<div class="row">
				<div class="col-md-12">

					<h3>{{ $project->project_name}}</h3> 
					<p class="address">{{ $project->project_location }}</p>

				</div>
			</div>


			<div class="row">
				<div class="col-md-6">
					
					<h3 class="h3-title">Project Photos</h3> 
					<br>

					<div class="featured-photo-con">

						<a class="fancybox" href="{{ $project->featured_photo }}" data-fancybox-group="gallery" title="{{ $project->project_name }}"><img src="{{ $project->featured_photo }}" alt=""/></a>

					</div>

	
					<div class="additional-photo-con">
							@foreach( $project_photos as $project_photo )

									<a class="fancybox" href="{{ $project_photo->photo }}" data-fancybox-group="gallery" title="{{ $project->project_name }}"><img src="{{ $project_photo->photo }}" alt=""/></a>

							@endforeach
					</div>

				</div>

				
				<div class="col-md-6">

					<h3 class="h3-title">Project Details</h3> 
					<p class="address">{!! $project->project_description !!}</p>

				</div>

			</div>


		</div>                 

    </div>
</div>

@endsection



