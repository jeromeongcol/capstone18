 <div class="SeletedMenuHeader">
  <div class="row">
      <div class="col-md-12">
          <h4>SALES TALLY DETAILS</h4>
      </div>
  </div>
</div>

    <div class="clearfix">
        <!-- LEFT COLUMN -->
        <div class="profile-left">
            <!-- PROFILE HEADER -->
            <div class="profile-header">
                <div class="overlay"></div>
                <div class="featured-image">
                    <span class="label label-success">FEATURED PHOTO</span>
                    <a rel="project_photos" title="Custom title" href="{{ $sales->featured_photo }}">
                        <img src="{{ $sales->featured_photo}}" alt="Avatar" >
                    </a>
                </div>
            </div>
            <!-- END PROFILE HEADER -->

            <div class="profile-detail">
                <div class="profile-info">
                        <ul class="list-unstyled list-justify">
                            <li>Project Name <span>{{ $sales->project_name }}</span></li>
                            <li>Total Contract Price <span>{{ $sales->total_contract_price  }}</span></li>
                            <li>Project Type <span>{{ $sales->project_type  }}</span></li>
                            <li>Date Reserve <span>{{ $sales->date_reserve  }}</span></li>
                            <li>Project Location <span>{{ $sales->project_location }}</span></li>
                        </ul>
                </div>
                
            </div>

        </div>
        <!-- END LEFT COLUMN -->
        <!-- RIGHT COLUMN -->
        <div class="profile-right">


             <div class="profile-detail project-details">
                        <div class="profile-info">
                            
                            <div class="row">
                                <div class="col-md-6">

                                    <h4 class="heading">Project Details</h4>
                                    <ul class="list-unstyled list-justify">

                                        <li>Project Phase # <span>{{ $sales->phase_number }}</span></li>
                                        <li>Project Block # <span>{{ $sales->block_number }}</span></li>
                                        <li>Project Lot # <span>{{ $sales->lot_number }}</span></li>
                                        <li>Bed <span>{{ $sales->amenities_bed }}</span></li>
                                        <li>Bath <span>{{ $sales->amenities_bath }}</span></li>
                                        <li>Garage <span>{{ $sales->amenities_garage }}</span></li>
                                        <li>Floor (sqm) <span>{{ $sales->amenities_floor_sqm }}</span></li>
                                        <li>Land (sqm) <span>{{ $sales->amenities_land_sqm }}</span></li>

                                    </ul>



                                 </div>

                                 <div class="col-md-6">

                                    <h4 class="heading">Agent Details</h4>
                                    <ul class="list-unstyled list-justify">
                                        <li>Name <span>{{ $sales->agent_name }}</span></li>
                                        <li>Rank <span>{{ $sales->agent_rank }}</span></li>

                                    </ul>

                                    <h4 class="heading">Buyer Details</h4>
                                    <ul class="list-unstyled list-justify">
                                        <li>Name <span>{{ $sales->client_name }}</span></li>
                                        <li>Contact # <span>{{ $sales->client_contact_number }}</span></li>
                                        <li>Email <span>{{ $sales->client_email }}</span></li>
                                        <li>Gender<span>{{ $sales->client_gender }}</span></li>
                                        <li>Date Birth<span>{{ $sales->client_datebirth }}</span></li>

                                    </ul>


                                    <h4 class="heading">Developer Details</h4>
                                    <ul class="list-unstyled list-justify">
                                        <li>Company name  <span>{{ $sales->developer_name }}</span></li>

                                    </ul>


                                 </div>



                            </div>

                             <div class="row">
                                <div class="col-md-12">

                                    
                                     <h4 class="heading">Project Description</h4>
                                     <p>{!! $sales->project_description !!}</p>



                                </div>
                            </div>
                        </div>
                        
                    </div>

            <!-- END TABBED CONTENT -->
        </div>
        <!-- END RIGHT COLUMN -->
    </div>