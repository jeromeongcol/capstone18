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


            
            <div class="row">
              
              <div class="col-md-6">

                <div class="panel addproject-panel-select">
                    <div class="panel-heading">

                          <h3 class="panel-title">Project List<span class="pull-right label label-success">Sales Project : {{ $sales->project_name }}</span></h3>

                      </div>
                      <div class="panel-body">
                        <div class="Selection-Container">
                           <table class="table" id="DevelopersTable">
                              @include('dashboard.sales.forms.partials.projects')
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
                           <div class="row">
                               <div class="col-md-8 col-md-offset-2">
                                <br>
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
                      </div>


                  </div>


              </div>



            </div>



            <div class="row">
              
              <div class="col-md-6">


                   <div class="panel addproject-panel-select">
                        <div class="panel-heading">

                              <h3 class="panel-title">Agent List<span class="pull-right label label-success">Sales Agent : {{ $sales->agent_name }}</span></h3>

                          </div>
                          <div class="panel-body">
                            <div class="Selection-Container">
                               <table class="table" id="DevelopersTable">
                                  @include('dashboard.sales.forms.partials.agents')
                              </table>
                            </div>

                          </div>
                          <div class="panel-footer text-right">
                              <button type="submit" class="btn btn-info">Update</button>
                          </div>
                  </div>


              </div>

                  <div class="col-md-6">

                        <div class="panel">

                          <div class="panel-heading">

                              <h3 class="panel-title">Client Details</h3>

                          </div>

                              <div class="panel-body">

                                   <div class="row">
                                       <div class="col-md-10 col-md-offset-1">
                                        <br>
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
                              </div>


                          </div>


              </div>




            </div>













            <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
             <li class="pull-right"><a href="#tab_5" class="Status_Tab" data-toggle="tab" aria-expanded="false">Sales Tally Status</a></li>
              <li class="pull-right"><a href="#tab_4" class="Client_Tab" data-toggle="tab" aria-expanded="false">Client Details</a></li>
              <li class="pull-right"><a href="#tab_3" class="Agent_Tab" data-toggle="tab" aria-expanded="false">Agent Details</a></li>
              <li class="pull-right"><a href="#tab_2" class="Contract_Tab" data-toggle="tab" aria-expanded="false">Contract Details</a></li>
              <li class="pull-right active"><a href="#tab_1" class="Project_Tab" data-toggle="tab" aria-expanded="true">Project Details</a></li>
              <li class="img-circle-xs-con">

                <a class="viewSalesDetails update-avatar-con" id="{{ $sales->sales_id }}">
                   <div class="pull-left">
                    <img src="{{ $sales->featured_photo }}" class="img-circle img-circle-xs" id="profile-picture">
                   </div>
                   <div class="pull-left">
                      <p>{{ $sales->project_name }}</p>
                      <p>{{ $sales->project_location }}</p>
                   </div>
                 </a>
               </li>

            </ul>
            <div class="tab-content">

              <div class="tab-pane active" id="tab_1">
                <div class="row">

                    <div class="col-md-8 col-md-offset-2">

                        <form action="/sales/updateSalesProject" method="POST" id="updateSalesProjectForm">
                          {{ csrf_field() }}
                          
                        <input type="hidden" name="transaction_id" value="{{ $sales->transaction_id }}">
                        <input type="hidden" name="sales_id" value="{{ $sales->sales_id }}">
                        

                        <div class="panel addproject-panel-select">
                            <div class="panel-heading">

                                  <h3 class="panel-title">Project List<span class="pull-right label label-success">Sales Project : {{ $sales->project_name }}</span></h3>

                              </div>
                              <div class="panel-body">
                                <div class="Selection-Container">
                                   <table class="table" id="DevelopersTable">
                                      @include('dashboard.sales.forms.partials.projects')
                                  </table>
                                </div>

                              </div>
                              <div class="panel-footer text-right">
                                  <button type="submit" class="btn btn-info">Update</button>
                              </div>
                        </div>
                      
                      </form>

                    </div>
    
                  </div>

              </div>
              <!-- /.tab-pane -->


              <div class="tab-pane" id="tab_2">
                <div class="row">

                    <div class="col-md-8 col-md-offset-2">
                          

                        <form action="/sales/updateSalesContract" method="POST" id="updateSalesContractForm">
                          {{ csrf_field() }}
                          
                        <input type="hidden" name="sales_id" value="{{ $sales->sales_id }}">

                        <div class="panel">
                              <div class="panel-body">

                                   <div class="row">
                                       <div class="col-md-8 col-md-offset-2">
                                        <br>
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
                              </div>

                              <div class="panel-footer text-right">
                                  <button type="submit" class="btn btn-info">Update</button>
                              </div>

                          </div>


                        </form>

                    </div>
    
                  </div>

              </div>
              <!-- /.tab-pane -->



              <div class="tab-pane" id="tab_3">
                <div class="row">

                    <div class="col-md-8 col-md-offset-2">

                        <form action="/sales/updateSalesAgent" method="POST" id="updateSalesAgeFormnt">
                          {{ csrf_field() }}

                        <input type="hidden" name="transaction_id" value="{{ $sales->transaction_id }}">
                        <input type="hidden" name="sales_id" value="{{ $sales->sales_id }}">

                        <div class="panel addproject-panel-select">
                            <div class="panel-heading">

                                  <h3 class="panel-title">Agent List<span class="pull-right label label-success">Sales Agent : {{ $sales->agent_name }}</span></h3>

                              </div>
                              <div class="panel-body">
                                <div class="Selection-Container">
                                   <table class="table" id="DevelopersTable">
                                      @include('dashboard.sales.forms.partials.agents')
                                  </table>
                                </div>

                              </div>
                              <div class="panel-footer text-right">
                                  <button type="submit" class="btn btn-info">Update</button>
                              </div>
                      </div>
                      
                      </form>

                    </div>
    
                  </div>

              </div>
              <!-- /.tab-pane -->



              <div class="tab-pane" id="tab_4">
                <div class="row">

                    <div class="col-md-8 col-md-offset-2">
                          

                        <form action="/sales/updateSalesClient" method="POST" id="updateSalesClientForm">
                          {{ csrf_field() }}
                          
                        <input type="hidden" name="sales_id" value="{{ $sales->sales_id }}">
                        <input type="hidden" name="client_id" value="{{ $sales->client_id }}">

                        <div class="panel">
                              <div class="panel-body">

                                   <div class="row">
                                       <div class="col-md-10 col-md-offset-1">
                                        <br>
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
                              </div>

                              <div class="panel-footer text-right">
                                  <button type="submit" class="btn btn-info">Update</button>
                              </div>

                          </div>


                        </form>

                    </div>
    
                  </div>

              </div>
              <!-- /.tab-pane -->



              <div class="tab-pane" id="tab_5">
                
                <div class="row">
                   <div class="col-md-4 col-md-offset-4">
                        <div class="panel">
                            <div class="panel-heading">
                                <h3 class="panel-title"></h3>
                            </div>
                            <div class="panel-body text-center status-con">
                              
                              <center>This account is
                              @if( $sales->cancelled )
                                <span class="label label-success">cancelled</span>
                              @else
                                <span class="label label-danger"></span>
                              @endif

                               and 

                              @if( $sales->approved )
                                <span class="label label-success">approved</span>
                              @else
                                <span class="label label-primary">disapproved</span>
                              @endif

                             .</center>

                              <br><br>
                             

                              @if( ( $auth->role == "Admin" ) &&  ( $auth->role != "SuperAdmin" ) )

                                 <div class="row">
                                  
                                   @if( $sales->approved )

                                     <div class="col-md-12 text-center">

                                          @if( !$sales->cancelled )
                                            <button type="button" class="btn btn-primary btn-block cancelSalesBtn" id="{{ $sales->sales_id }}">CANCEL?</button>
                                          @else
                                            <button type="button" class="btn btn-primary btn-block unCancelSalesBtn" id="{{ $sales->sales_id  }}">UNCANCEL?</button>
                                          @endif

                                     </div>

                                    @else

                                      <div class="col-md-6 text-center">

                                          @if( !$sales->cancelled )
                                            <button type="button" class="btn btn-primary btn-block cancelSalesBtn" id="{{ $sales->sales_id }}">CANCEL?</button>
                                          @else
                                            <button type="button" class="btn btn-primary btn-block unCancelSalesBtn" id="{{ $sales->sales_id  }}">UNCANCEL?</button>
                                          @endif

                                      </div>

                                      <div class="col-md-6 text-center">

                                            <button type="button" class="btn btn-primary btn-block approveSalesBtn" id="{{ $sales->sales_id  }}">APPROVE?</button>

                                      </div>



                                    @endif

                                 </div>

                              @else


                                  <div class="row">
                                   <div class="col-md-12 text-center">

                                          @if( $sales->cancelled )
                                            <button type="button" class="btn btn-primary btn-block actionSetNotActiveUserBtnShowModal" id="{{ $sales->sales_id }}">CANCEL?</button>
                                          @else
                                            <button type="button" class="btn btn-primary btn-block actionSetActiveUserBtnShowModal" id="{{ $sales->sales_id  }}">UNCANCEL?</button>
                                          @endif

                                     </div>
                                  </div>

                               @endif
                                          

                            <br /><br />
                            </div>
                        </div>
                      </div>

                  </div>

              </div>
              <!-- /.tab-pane -->




            <!-- /.tab-content -->
            </div>





          </div>








        </div>
    </div>
    <!-- END MAIN CONTENT -->
</div>
<!-- END MAIN -->