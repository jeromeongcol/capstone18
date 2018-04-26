<!-- MAIN -->
<div class="main">
    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="container-full">

            <div class="SeletedMenuHeader">
              <div class="row">
                  <div class="col-md-12">
                      <h4>SALES DETAILS</h4>
                  </div>
              </div>
            </div>

            <div class="panel panel-profile panel-sales">
                <div class="row">

                    <div class="col-md-6" >

                        <div class="panel">
                            <div class="panel-heading">
                                <h3 class="panel-title">Project Details</h3>
                            </div>
                            <div class="panel-body">
                                 <ul class="list-unstyled list-justify">
                                    <li><b>Project Name</b> <span>{{ $sales->project_name }}</span></li>
                                    <li><b>Total Contract Price</b> <span>{{ $sales->total_contract_price  }}</span></li>
                                    <li><b>Project Type</b> <span>{{ $sales->project_type  }}</span></li>
                                    <li><b>Date Reserve</b> <span>{{ $sales->date_reserve  }}</span></li>
                                    <li><b>Project Location</b> <span>{{ $sales->project_location }}</span></li>
                                </ul>
                            </div>
                        </div>

                        <div class="panel">
                            <div class="panel-heading">
                                <h3 class="panel-title">Developer Details</h3>
                            </div>
                            <div class="panel-body">
                                 <ul class="list-unstyled list-justify">
                                   <li><b>Company name</b>  <span>{{ $sales->developer_name }}</span></li>
                                </ul>
                            </div>
                        </div>



                        <div class="panel">
                            <div class="panel-heading">
                                <h3 class="panel-title">Agent Details</h3>
                            </div>
                            <div class="panel-body">
                                 <ul class="list-unstyled list-justify">
                                    <li><b>Name</b> <span>{{ $sales->agent_name }}</span></li>
                                    <li><b>Email</b> <span>{{ $sales->agent_email }}</span></li>
                                    <li><b>Rank</b> <span>{{ $sales->agent_rank }}</span></li>
                                </ul>
                            </div>
                        </div>


                    </div>
                    
                    <div class="col-md-6" >

                        <div class="panel">
                            <div class="panel-heading">
                                <h3 class="panel-title">Project Description</h3>
                            </div>
                            <div class="panel-body project-description-con">
                                <p>{!! $sales->project_description !!}</p>
                            </div>
                        </div>


                        <div class="panel">
                            <div class="panel-heading">
                                <h3 class="panel-title">Buyer Details</h3>
                            </div>
                            <div class="panel-body">
                                 <ul class="list-unstyled list-justify">
                                   <li><b>Name</b> <span>{{ $sales->client_name }}</span></li>
                                </ul>
                            </div>
                        </div>


                    </div>


                </div>
            </div>



        </div>
    </div>
</div>

