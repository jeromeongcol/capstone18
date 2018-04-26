
        <div class="SeletedMenuHeader">
            <div class="row">
                <div class="col-md-6 col-xs-6">

                  <h4>
                      <a class="back agent-submenu"><img src="{{ asset('layouts/img/back.png') }}"></a>Users > Add Staff
                  </h4>

                </div>
            </div>

        </div>


        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">


              <div class="panel">
                <div class="panel-body page-content">

                    
                  <div class="AddStaffSteps steps-con">
                      <h2>Create Account</h2>
                      <section>
                         
                         <div class="row account-con">
                              <div class="col-md-10 col-md-offset-1">
                                  <br/><br/>

                                  <form action="/users/agent/validate/account" method="POST" id="UserAccountForm">
                                      
                                      {{ csrf_field() }}

                                      <div class="row">
                                         <div class="col-md-4">
                                             <div class="form-group">
                                                   <span class="input-group-addon" >Email Address</span>
                                                    <input class="form-control" value="{{ old('email') }}" name="email" type="text" required="">
                                                    <small class="help-block with-errors form-error email"></small>
                                              </div>
                                         </div>
                                          <div class="col-md-4">
                                                  <div class="form-group">
                                                       <span class="input-group-addon" >Password</span>
                                                        <input class="form-control" value="{{ old('password') }}" name="password" type="password" required>
                                                       <small class="help-block with-errors form-error password"></small>
                                                  </div>
                                         </div>
                                          <div class="col-md-4">
                                                  <div class="form-group">
                                                       <span class="input-group-addon" >Confirm Password</span>
                                                       <input class="form-control" value="{{ old('password_confirmation') }}" name="password_confirmation" type="password" required>
                                                        <small class="help-block with-errors form-error password_confirmation"></small>
                                                  </div>
                                         </div>
                                      </div>

                                  </form>
                              </div>
                         </div>

                      </section>

                      <h2>Basic Information</h2>
                      <section>
                          <div class="row account-con">

                              <form action="/users/agent/validate/account" method="POST" id="UserAdditionalInfoForm">
                                 {{ csrf_field() }}
                              <div class="col-md-10 col-md-offset-1">
                               <br/><br/>

                                <div class="row">

                                    <div class="col-md-4">
                                       <div class="form-group">
                                          <span class="input-group-addon" >Last name</span>
                                          <input class="form-control" value="{{ old('lastname') }}" type="text" name="lastname" required>
                                          <small class="help-block with-errors form-error lastname"></small>
                                      </div>
                                    </div>

                                    <div class="col-md-4">
                                      <div class="form-group">
                                          <span class="input-group-addon" >First name</span>
                                          <input class="form-control" value="{{ old('firstname') }}" type="text" name="firstname" required>
                                          <small class="help-block with-errors form-error firstname"></small>
                                      </div>
                                    </div>

                                    <div class="col-md-4">
                                       <div class="form-group">
                                          <span class="input-group-addon" >Middle name</span>
                                          <input class="form-control" value="{{ old('middlename') }}" type="text" name="middlename" required>
                                          <small class="help-block with-errors form-error middlename"></small>
                                      </div>
                                    </div>

                                </div>  

                              </div>
                            </form>
                         </div>
                      </section>


                      <h2>Choose Photo</h2>
                      <section>
                          <div class="row account-con">

                               <div class="col-md-4 col-md-offset-4">
                                  
                                  <div class="profile-picture-con user-picture-container">

                                    <div class="overlay showCropboxModal" id="user-photo">
                                      <div class="text">+</div>
                                    </div>

                                     <img src="{{ asset('storage/default.png') }}" id="profile-picture">
                                     <input type="hidden" id="imgUpload" name="avatar" value="">

                                  </div>

                               </div>
                         </div>
                      </section>


                      <h2>Finish</h2>
                      <section>

                        <form action="/users/staff/add" method="POST" id="AddStaffForm">
                        {{ csrf_field() }}

                        <div class="row account-con">


                              <div class="col-md-4">
                                
                                  <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <span class="input-group-addon" >Email Address</span>
                                            <input class="form-control" name="email" type="text" required readonly>
                                            <input class="form-control hidden" name="password" type="text" required readonly>
                                            <small class="help-block with-errors form-error email"></small>
                                        </div>
                                    </div>
                                  </div>
                            </div>

                              <div class="col-md-4">

                                  <div class="row">
                                    <div class="col-md-12">
                                       <div class="form-group">
                                          <span class="input-group-addon" >Last name</span>
                                          <input class="form-control" type="text" name="lastname" required readonly>
                                          <small class="help-block with-errors form-error lastname"></small>
                                      </div>
                                    </div>
                                  </div>

                                  <div class="row">
                                    <div class="col-md-12">
                                      <div class="form-group">
                                          <span class="input-group-addon" >First name</span>
                                          <input class="form-control" type="text" name="firstname" required readonly>
                                          <small class="help-block with-errors form-error firstname"></small>
                                      </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                       <div class="form-group">
                                          <span class="input-group-addon" >Middle name</span>
                                          <input class="form-control" type="text" name="middlename" required readonly>
                                          <small class="help-block with-errors form-error middlename"></small>
                                      </div>
                                    </div>
                                </div>  

                              </div>


                               <div class="col-md-4">
                                  
                                  <div class="profile-picture-con user-picture-container">  
                                     <img src="{{ asset('storage/default.png') }}" id="profile-picture">
                                     <input type="hidden" id="imgUpload" name="avatar" value="">

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

