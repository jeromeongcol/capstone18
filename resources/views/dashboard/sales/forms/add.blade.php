<div class="SeletedMenuHeader">
    <div class="row">
        <div class="col-md-6 col-xs-6">

          <h4>
              <a class="back sales-menu-approved"><img src="{{ asset('layouts/img/back.png') }}"></a>Sales > Tally
          </h4>

        </div>
    </div>

</div>


<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">


      <div class="panel">
        <div class="panel-body page-content">

            
            <div class="AddSalesSteps steps-con steps-with-auto">
                <h2>Select Project</h2>
                <section>
                   
                   <div class="row">
                       <div class="col-md-12">


                          <div class="panel addproject-panel-select">
                            <div class="panel-heading">

                                  <h3 class="panel-title">Project List</h3>

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
                   </div>

                </section>


                <h2>Tally Contract Information</h2>
                <section>

                  <form action="/sales/validateContractInfo" method="POST" id="validateContractInfoForm">
                    {{ csrf_field() }}

                     <div class="row">
                         <div class="col-md-8 col-md-offset-2">
                          <br><br><br>
                           <div class="row account-con">
                                <div class="col-md-6">
                                        <div class="form-group">
                                               <span class="input-group-addon" >Date Reserve</span>
                                                <input type="text" name="date_reserve" data-date-end-date="0d" class="datepicker form-control" value="03/12/2017" />
                                                <small class="help-block with-errors form-error date_reserve"></small>
                                          </div>

                                </div>

                                <div class="col-md-6">
                                        <div class="form-group">
                                             <span class="input-group-addon" >Total Contract Price</span>
                                              <input class="form-control" name="contract_price" type="text" required>
                                             <small class="help-block with-errors form-error contract_price"></small>
                                        </div>


                                </div>

                           </div>

                    </div>

                   </div>
                 </form>

                </section>



                <h2>Select Agent</h2>
                <section>
                    <div class="row">

                        <div class="col-md-12">

                          <div class="panel addproject-panel-select">
                            <div class="panel-heading">

                                  <h3 class="panel-title">Project List</h3>

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
                   </div>
                </section>




                <h2>Client Details</h2>
                <section>

                   <div class="row">
                       <div class="col-md-10 col-md-offset-1">
                        <br><br><br>
                         <div class="row account-con">
                            <form action="/sales/validateClientInfo" method="POST" id="validateClientInfoForm">

                               {{ csrf_field() }}

                              <div class="col-md-4">
                                      <div class="form-group">
                                             <span class="input-group-addon" >Last Name</span>
                                              <input type="text" name="lastname" class="form-control"/>
                                              <small class="help-block with-errors form-error lastname"></small>
                                        </div>

                              </div>

                              <div class="col-md-4">
                                      <div class="form-group">
                                           <span class="input-group-addon" >First Name</span>
                                            <input type="text" name="firstname" class="form-control"/>
                                            <small class="help-block with-errors form-error firstname"></small>
                                      </div>
                              </div>

                              <div class="col-md-4">
                                      <div class="form-group">
                                             <span class="input-group-addon" >Middle Name</span>
                                              <input type="text" name="middlename" class="form-control" />
                                              <small class="help-block with-errors form-error middlename"></small>
                                        </div>

                              </div>
                            
                            </form>

                         </div>

                  </div>

                 </div>
                </section>





                <h2>Finish</h2>
                <section>

                  <form action="/sales/add" method="POST" id="AddSalesForm">
                  {{ csrf_field() }}

                  <div class="row account-con">


                        <div class="col-md-12">
                           <div class="row">
                              <div class="col-md-3">

                                      <h3 class="h3-title">Project Info</h3>


                                      <div class="form-group">
                                           <span class="input-group-addon" >Project Name</span>
                                            <input class="form-control" name="project_name" type="text" required="" readonly>
                                            <input  name="project" type="hidden" required="" readonly>
                                            <small class="help-block with-errors form-error project_name"></small>
                                      </div>
                                      <div class="form-group">
                                           <span class="input-group-addon" >Project Developer</span>
                                           <input class="form-control" name="project_developer" type="text" required readonly>
                                            <small class="help-block with-errors form-error project_developer"></small>
                                      </div>

                              </div>



                              <div class="col-md-3">


                                        <h3 class="h3-title">Contract Info</h3>


                                        <div class="form-group">
                                             <span class="input-group-addon" >Date Reserve</span>
                                              <input class="form-control" name="date_reserve" type="text" required="" readonly>
                                              <small class="help-block with-errors form-error date_reserve"></small>
                                        </div>
                                       <div class="form-group">
                                             <span class="input-group-addon" >Total Contract Price</span>
                                             <input class="form-control" name="contract_price" type="text" required readonly>
                                              <small class="help-block with-errors form-error contract_price"></small>
                                        </div>


                              </div>




                              <div class="col-md-3">


                                        <h3 class="h3-title">Agent Info</h3>
                                        

                                        <input type="hidden" name="agent" class="form-control"/>

                                        <div class="form-group">
                                             <span class="input-group-addon" >Agent Name</span>
                                              <input class="form-control" name="agent_name" type="text" required="" readonly>
                                              <small class="help-block with-errors form-error agent_name"></small>
                                        </div>

                                        <div class="form-group">
                                             <span class="input-group-addon"  >Agent Email Address</span>
                                             <input class="form-control" name="agent_email" type="text" required readonly>
                                              <small class="help-block with-errors form-error agent_email"></small>
                                        </div>
                                        
                                       <div class="form-group">
                                             <span class="input-group-addon" >Agent Rank</span>
                                             <input class="form-control" name="agent_rank" type="text" required readonly>
                                              <small class="help-block with-errors form-error agent_rank"></small>
                                        </div>

                                </div>




                              <div class="col-md-3">


                                        <h3 class="h3-title">Client Info</h3>


                                       <div class="form-group">
                                             <span class="input-group-addon" >Client Last Name</span>
                                             <input class="form-control" name="lastname" type="text" required readonly>
                                              <small class="help-block with-errors form-error lastname"></small>
                                        </div>

                                        <div class="form-group">
                                             <span class="input-group-addon" >Client First Name</span>
                                              <input class="form-control"  name="firstname" type="text" required="" readonly>
                                              <small class="help-block with-errors form-error firstname"></small>
                                        </div>
                                        <div class="form-group">
                                             <span class="input-group-addon" >Client Middle Name</span>
                                             <input class="form-control" name="middlename" type="text" required readonly>
                                              <small class="help-block with-errors form-error middlename"></small>
                                        </div>

                                </div>




                              </div>

                            </div>



                        </div>


                   </div>




                 </form>


                </section>


            </div>  

        </div>
      </div>
      <!-- END RECENT PURCHASES -->
    </div>
  </div>



</div>