
	<!-- OVERVIEW -->
	<div class="panel panel-headline">
		<div class="panel-heading">
			<h3 class="panel-title">Yearly Sales Overview

			<div class="pull-right">
				<select class="form-control input-lg" id="FilterYearChart">
	                   		@foreach( $years as $year )
								<option value="{{$year}}">{{ $year }}</option>
							@endforeach
				</select>

			</div>
		</h3>
			
		</div>
		<div class="panel-body">

			<div class="row">
				<div class="col-md-12">

					<div class="canvasOuterContainer">
					      
	                   <div id="canvasContainer" style="width: 85%;">
	                      <canvas id="ChartCanvas"></canvas>
	                  </div>

	              </div>

				</div>
			</div>
		</div>
	</div>
	<!-- END OVERVIEW -->

