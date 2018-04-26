    <div class="SeletedMenuHeader">
        <div class="row">
              <div class="col-md-12">
                <h4><i class="fa fa-pencil-square-o" aria-hidden="true"></i> UPDATE SALES TALLY</h4>
              </div>
          </div>
   </div>
  
  <div class="container-fluid">

        <form class="center-input-placeholder" action="/sales/update" method="POST" id="updateSalesForm">
                  {{ csrf_field() }}

                  <input type="hidden" name="transaction_id" value="{{ $sales->transaction_id }}"/>
                  <input type="hidden" name="client_id" value="{{ $sales->client_id }}"/>
                  <input type="hidden" name="sales_id" value="{{ $sales->sales_id }}"/>

                  <div class="row">

                       <div class="col-md-4">

                        <div class="panel">
                        
                            <div class="panel-heading">
                              <h3 class="panel-title">CLIENT DETAILS</h3>
                            </div>

                            <div class="panel-body">
                             
                                  
                                  <div class="form-group">
                                       <span class="input-group-addon" >Last name</span>
                                      <input type="text" class="form-control" value="{{ $sales->client_lastname }}" name="lastname">
                                       <small class="form-text form-error lastname"></small>
                                  </div>
                              
                               <div class="row">

                                 <div class="col-md-6 side-by-side-col-left">

                                  <div class="form-group">
                                       <span class="input-group-addon" >First name</span>
                                      <input type="text" class="form-control" value="{{ $sales->client_firstname }}" name="firstname">
                                       <small class="form-text form-error firstname"></small>
                                  </div>

                                </div>

                                <div class="col-md-6 side-by-side-col-right">

                                  <div class="form-group">
                                       <span class="input-group-addon" >Middle name</span>
                                      <input type="text" class="form-control" value="{{ $sales->client_middlename }}" name="middlename">
                                       <small class="form-text form-error middlename"></small>
                                  </div>

                                </div>
                              </div>


                               <div class="row">

                                 <div class="col-md-6 side-by-side-col-left">
                                    <div class="form-group">
                                        <span class="input-group-addon" >Birth date</span>
                                            <input type="text" name="datebirth" class="datepicker form-control" value="{{ $sales->client_datebirth }}"/>
                                            <small class="form-text form-error datebirth"></small>
                                    </div>

                                  </div>
                                  
                                  <div class="col-md-6 side-by-side-col-right">

                                    <div class="form-group">
                                        <span class="input-group-addon" >Gender</span>
                                        <select class="form-control" name="gender">
                                            <option value="M" @if( $sales->client_gender == 'M') selected @endif>Male</option>
                                            <option value="F" @if( $sales->client_gender == 'F') selected @endif>Famale</option>
                                        </select>
                                    </div>

                                  </div>

                                </div>
                              <div class="form-group">
                                   <span class="input-group-addon" >Email address</span>
                                  <input type="text" value="{{ $sales->client_email }}" class="form-control" name="email">
                                   <small class="form-text form-error email"></small>
                              </div>

                              <div class="form-group">
                                   <span class="input-group-addon" >Contact number</span>
                                  <input type="text" class="form-control" value="{{ $sales->client_contact_number }}" name="contact">
                                   <small class="form-text form-error contact"></small>
                              </div>

                            </div>
                            </div>
                       </div>

                       <div class="col-md-8">


                          <div class="panel">
                            
                            <div class="panel-heading">
                              <h3 class="panel-title">AGENT SALES DETAILS</h3>
                            </div>

                            <div class="panel-body">
                        
                              <div class="row">

                                <div class="col-md-6">



                                        <div class="form-group">
                                            <span class="input-group-addon" >Agent</span>
                                              <div class="row">

                                               <div class="col-md-9 side-by-side-col-left">
                                                <input class="form-control" type="text" name="agent_name" id="agent_name" value="{{ $sales->agent_name }}" required>
                                              </div>

                                               <div class="col-md-3 side-by-side-col-right">
                                                <input class="form-control" type="text" name="agent_rank" id="agent_rank" value="{{ $sales->agent_rank }}" required>
                                              </div>
                                            </div>


                                             <input class="form-control hidden" type="text" name="agent" id="agent" value="{{ $sales->agent_id }}" required>
                                            <small class="form-text form-error agent">{{ $errors->first('agent') }}</small>

                                        </div>

                                  </div>

                                  <div class="col-md-6">

                                          <div class="form-group">
                                          <span class="input-group-addon" >Date Reserve</span>
                                              <input type="text" class="datepicker-inline form-control" value="{{ $sales->date_reserve }}" name="date_reserve"/>
                                               <small class="form-text form-error date_reserve">{{ $errors->first('agent') }}</small>
                                         </div>

                                    </div>
                                   

                                </div>


                                <div class="row">

                                   <div class="col-md-6">

                                        <div class="form-group">
                                            <span class="input-group-addon" >Developer</span>
                                            <input class="form-control" type="text" name="developer_name" id="developer_name" value="{{ $sales->developer_name }}" required>

                                             <input class="form-control hidden" type="text" name="developer" id="developer" value="{{ $sales->developer_id }}" required>
                                            <small class="form-text form-error developer_name">{{ $errors->first('recruiter') }}</small>
                                        </div>

                                  </div>

                                  <div class="col-md-6">

                                          <div class="form-group">
                                              <span class="input-group-addon" >Project</span>
                                              <input class="form-control" type="text" name="project_name" id="project_name" value="{{ $sales->project_name }}" required>

                                               <input class="form-control hidden" type="text" name="project" id="project" value="{{ $sales->project_id }}" required>
                                              <small class="form-text form-error project">{{ $errors->first('recruiter') }}</small>
                                          </div>

                                    </div>
                                     


                                </div>

                                <div class="row">

                                    <div class="col-md-6">

                                          <div class="form-group">
                                              <span class="input-group-addon" >Project Location</span>
                                              <input class="form-control" type="text" name="project_location" id="project_location" value="{{ $sales->project_location }}" disabled required>
                                              <small class="form-text form-error location">{{ $errors->first('developer') }}</small>
                                          </div>

                                    </div>

                                  <div class="col-md-6">

                                          <div class="form-group">
                                              <span class="input-group-addon" >Total Contract Price</span>
                                              <input class="form-control input-number-custom"  type="text" name="project_price" id="project_price" value="{{ $sales->total_contract_price }}" required>
                                              <small class="form-text form-error project_price">{{ $errors->first('recruiter') }}</small>
                                          </div>


                                    </div>

                                </div>


                            </div>
                          </div>


                          <br />

                          <div class="row">

                               <div class="col-md-12">

                                  <div class="panel">
                                    <div class="panel-body text-center">

                                      <button type="submit" class="btn btn-primary btn-lg"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> UPDATE SALES</button>

                                    </div>

                                </div>

                               </div>

                          </div>









                        </div>




                     </div>

      </form>

  </div>
<!-- END MAIN -->
</div>