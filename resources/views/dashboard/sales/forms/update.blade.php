<!-- MAIN -->
<div class="main">
    <!-- MAIN CONTENT -->
    <div class="main-content">


        <div class="container container-full">


        <div class="SeletedMenuHeader">
          
             <div class="row">
                    <div class="col-md-12">
                      <h4>UPDATE SALES TALLY</h4>
                    </div>
                </div>

        </div>

        <div class="panel panel-profile panel-update text">


          <form action="/sales/updateSales" method="POST" id="updateSalesForm">
            {{ csrf_field() }}

            <input type="hidden" name="transaction_id" class="form-control" value=" {{ $sales->transaction_id }}" />

            <input type="hidden" name="sales_id" class="form-control" value=" {{ $sales->sales_id }}" />

            <div class="row">
              
              <div class="col-md-6">

                <div class="panel addproject-panel-select">
                    <div class="panel-heading">

                          <h3 class="panel-title">Project List<span class="pull-right label label-success">Current Sales Project : {{ $sales->project_name }}</span></h3>

                      </div>
                      <div class="panel-body">
                        <div class="Selection-Container">
                           <table class="table" id="DevelopersTable">
                              @include('dashboard.sales.forms.partials.projects')
                          </table>
                        </div>

                      </div>
                </div>

                <br/>


                <div class="panel addproject-panel-select">
                        <div class="panel-heading">

                              <h3 class="panel-title">Agent List<span class="pull-right label label-success">Current Sales Agent : {{ $sales->agent_name }}</span></h3>

                          </div>
                          <div class="panel-body">
                            <div class="Selection-Container">
                               <table class="table" id="DevelopersTable">
                                  @include('dashboard.sales.forms.partials.agents')
                              </table>
                            </div>

                          </div>
                  </div>


              </div>

              <div class="col-md-6">


                <div class="panel">
                        <div class="panel-heading">

                          <h3 class="panel-title">Contract Price</h3>

                      </div>

                      <div class="panel-body">

                                 <div class="row account-con">
                                      <div class="col-md-6">
                                        <div class="form-group">
                                               <span class="input-group-addon" >Date Reserve</span>
                                                <input type="text" name="date_reserve" data-date-end-date="0d" class="datepicker form-control" value="{{ $sales->date_reserve }}" />
                                                <small class="help-block with-errors form-error date_reserve"></small>
                                          </div>

                                      </div>

                                      <div class="col-md-6">
                                        <div class="form-group">
                                             <span class="input-group-addon" >Total Contract Price</span>
                                              <input class="form-control" name="contract_price" type="text" value="{{ $sales->total_contract_price }}" required>
                                             <small class="help-block with-errors form-error contract_price"></small>
                                        </div>


                                      </div>

                                 </div>

                      </div>


                  </div>

                  <br/>

                  <div class="panel">

                          <div class="panel-heading">

                              <h3 class="panel-title">Client Details</h3>

                          </div>

                              <div class="panel-body">

                                          <input type="hidden" name="client_id" class="form-control" value="{{ $sales->client_id }}"/>

                                         <div class="row account-con">
                                            <div class="col-md-4">
                                              <div class="form-group">
                                                     <span class="input-group-addon" >Last Name</span>
                                                      <input type="text" name="lastname" class="form-control" value="{{ $sales->client_lastname }}"/>
                                                      <small class="help-block with-errors form-error lastname"></small>
                                                </div>

                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                     <span class="input-group-addon" >First Name</span>
                                                      <input type="text" name="firstname" class="form-control" value="{{ $sales->client_firstname }}"/>
                                                      <small class="help-block with-errors form-error firstname"></small>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                              <div class="form-group">
                                                     <span class="input-group-addon" >Middle Name</span>
                                                      <input type="text" name="middlename" class="form-control" value="{{ $sales->client_middlename }}"/>
                                                      <small class="help-block with-errors form-error middlename"></small>
                                                </div>

                                            </div>

                                         </div>

                              </div>


                          </div>

                          <br/>

                      <div class="panel addproject-panel-select">
                        <div class="panel-heading">

                              <h3 class="panel-title">Sales Status</h3>

                          </div>
                          <div class="panel-body">
                            
                            <div class="row">

                               <div class="col-md-12">

                                Sales Status : 

                                @if( $sales->cancelled )
                                <span class="label label-danger">cancelled</span>
                                @else
                                  <span class="label label-success">active</span>
                                @endif

                                 and 

                                @if( $sales->approved )
                                  <span class="label label-success">approved</span>
                                @else
                                  <span class="label label-primary">disapproved</span>
                                @endif


                              </div>


                            </div>

                            <br/>
                                              
                         </div>
                  </div>


                <button type="submit" class="btn btn-info UpdateSales_btn btn-lg">Update</button>




              </div>



            </div>





         





      </form>



        </div>
    </div>
    <!-- END MAIN CONTENT -->
</div>
<!-- END MAIN -->