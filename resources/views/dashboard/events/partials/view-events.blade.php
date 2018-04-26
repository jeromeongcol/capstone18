        <div class="SeletedMenuHeader">
          
         <div class="row">
            <div class="col-md-12 col-xs-4">
              <h4>Notificatoins</h4>
            </div>

         </div>

        </div>


        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">


              <div class="panel">
                <div class="panel-body page-content">


	                <div class="col-md-4">
	                	<ul class="notifications-con notification-action">
			              	@foreach( $events as $notifications )

									<li id="{{ Vinkla\Hashids\Facades\Hashids::encode( $notifications['data']['Event']['id'] ) }}" type="{{ $notifications['type'] }}">
										<div class='notification-item-con'>

											<div class="notificaton-item-logo"><img src="{{ $notifications['data']['Author']['photo'] }}" /></div>
											<div class="notificaton-item-title">{!! $notifications['data']['Message'] !!}<br>
											<b>{{ Carbon\Carbon::parse($notifications['data']['Event']['created_at'])->diffForHumans() }}</b></div>

										</div>

							@endforeach
						</ul>
		            </div>


		            <div class="col-md-8">
		              <h4>Events > Notificatoins</h4>
		            </div>

                </div>
              </div>
              <!-- END RECENT PURCHASES -->
            </div>
          </div>



        </div>
