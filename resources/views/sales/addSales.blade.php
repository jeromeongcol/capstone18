@extends('layouts-admin.app')

@section('content')
    <!-- MAIN -->
    <div class="main" id="app">
      <!-- MAIN CONTENT -->
      <div class="main-content">

          <div class="SeletedMenuHeader">
              <div class="row">
                    <div class="col-md-12">
                      <h4><i class="fa fa-plus-square" aria-hidden="true"></i> SALES TALLY</h4>
                    </div>
                </div>
         </div>
        
        <div class="container-fluid">

              <form class="center-input-placeholder" action="/sales/add" method="POST" id="addSalesForm">
                        {{ csrf_field() }}
                        
                        <div class="row">

                             <div class="col-md-4">

                              <div class="panel">
                              
                                  <div class="panel-heading">
                                    <h3 class="panel-title">CLIENT DETAILS</h3>
                                  </div>

                                  <div class="panel-body">
                                   
                                        
                                        <div class="form-group">
                                             <span class="input-group-addon" >Last name</span>
                                            <input type="text" class="form-control" value="" name="lastname">
                                             <small class="form-text form-error lastname"></small>
                                        </div>
                                    
                                     <div class="row">

                                       <div class="col-md-6 side-by-side-col-left">

                                        <div class="form-group">
                                             <span class="input-group-addon" >First name</span>
                                            <input type="text" class="form-control" value="" name="firstname">
                                             <small class="form-text form-error firstname"></small>
                                        </div>

                                      </div>

                                      <div class="col-md-6 side-by-side-col-right">

                                        <div class="form-group">
                                             <span class="input-group-addon" >Middle name</span>
                                            <input type="text" class="form-control" value="" name="middlename">
                                             <small class="form-text form-error middlename"></small>
                                        </div>

                                      </div>
                                    </div>


                                     <div class="row">

                                       <div class="col-md-6 side-by-side-col-left">
                                          <div class="form-group">
                                              <span class="input-group-addon" >Birth date</span>
                                                  <input type="text" name="datebirth" class="datepicker form-control"/>
                                                  <small class="form-text form-error datebirth"></small>
                                          </div>

                                        </div>
                                        
                                        <div class="col-md-6 side-by-side-col-right">

                                          <div class="form-group">
                                              <span class="input-group-addon" >Gender</span>
                                              <select class="form-control" name="gender">
                                                  <option value="M">Male</option>
                                                  <option value="F">Famale</option>
                                              </select>
                                          </div>

                                        </div>

                                      </div>
                                    <div class="form-group">
                                         <span class="input-group-addon" >Email address</span>
                                        <input type="text" class="form-control" name="email">
                                         <small class="form-text form-error email"></small>
                                    </div>

                                    <div class="form-group">
                                         <span class="input-group-addon" >Contact number</span>
                                        <input type="text" class="form-control" value="" name="contact">
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
                                                      <input class="form-control" type="text" name="agent_name" id="agent_name" value="{{ old('agent_name')  }}" required>
                                                    </div>

                                                     <div class="col-md-3 side-by-side-col-right">
                                                      <input class="form-control" type="text" name="agent_rank" id="agent_rank" value="{{ old('agent_rank')  }}" required>
                                                    </div>
                                                  </div>


                                                   <input class="form-control hidden" type="text" name="agent" id="agent" value="{{ old('recruiter')  }}" required>
                                                  <small class="form-text form-error agent">{{ $errors->first('agent') }}</small>

                                              </div>

                                        </div>

                                        <div class="col-md-6">

                                                <div class="form-group">
                                                <span class="input-group-addon" >Date Reserve</span>
                                                    <input type="text" class="datepicker-inline form-control" name="date_reserve"/>
                                                     <small class="form-text form-error date_reserve">{{ $errors->first('agent') }}</small>
                                               </div>

                                          </div>
                                         

                                      </div>


                                      <div class="row">

                                         <div class="col-md-6">

                                              <div class="form-group">
                                                  <span class="input-group-addon" >Developer</span>
                                                  <input class="form-control" type="text" name="developer_name" id="developer_name" value="{{ old('developer_name')  }}" required>

                                                   <input class="form-control hidden" type="text" name="developer" id="developer" value="{{ old('developer')  }}" required>
                                                  <small class="form-text form-error developer_name">{{ $errors->first('recruiter') }}</small>
                                              </div>

                                        </div>

                                        <div class="col-md-6">

                                                <div class="form-group">
                                                    <span class="input-group-addon" >Project</span>
                                                    <input class="form-control" type="text" name="project_name" id="project_name" value="{{ old('project_name')  }}" required>

                                                     <input class="form-control hidden" type="text" name="project" id="project" value="{{ old('project')  }}" required>
                                                    <small class="form-text form-error project">{{ $errors->first('recruiter') }}</small>
                                                </div>

                                          </div>
                                           


                                      </div>

                                      <div class="row">

                                          <div class="col-md-6">

                                                <div class="form-group">
                                                    <span class="input-group-addon" >Project Location</span>
                                                    <input class="form-control" type="text" name="project_location" id="project_location" value="{{ old('developer_name')  }}" disabled required>
                                                    <small class="form-text form-error location">{{ $errors->first('developer') }}</small>
                                                </div>

                                          </div>

                                        <div class="col-md-6">

                                                <div class="form-group">
                                                    <span class="input-group-addon" >Total Contract Price</span>
                                                    <input class="form-control input-number-custom"  type="text" name="project_price" id="project_price" value="{{ old('project_name')  }}" required>
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

                                            <button type="submit" class="btn btn-primary btn-lg"><i class="fa fa-plus" aria-hidden="true"></i> ADD SALES</button>

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
</div>


@include('sales.partials.modals.select-agent')
@include('sales.partials.modals.select-project')

@endsection
