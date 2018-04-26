<div class="SeletedMenuHeader">
    <div class="row">
        <div class="col-md-6 col-xs-6">

          <h4>
              <a class="back developers-menu"><img src="{{ asset('layouts/img/back.png') }}"></a>Developers > Add developer
          </h4>

        </div>
    </div>

</div>


<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">


      <div class="panel">
        <div class="panel-body page-content">

            
            <div class="AddDevloperSteps steps-con steps-with-auto">
                <h2>Developer Information</h2>
                <section>
                   
                   <div class="row account-con">
                        <div class="col-md-10 col-md-offset-1">
                            <br/><br/>

                            <form action="/developer/add/validate/basicinformation" method="POST" id="DeveloperBasicInfoForm">
                                
                                {{ csrf_field() }}

                                <div class="row">
                                   <div class="col-md-6">
                                       <div class="form-group">
                                             <span class="input-group-addon" >Company name</span>
                                              <input class="form-control" value="{{ old('name') }}" name="name" type="text" required="">
                                              <small class="help-block with-errors form-error name"></small>
                                        </div>
                                   </div>
                                    <div class="col-md-6">
                                      <div class="form-group">
                                             <span class="input-group-addon" >Contact number</span>
                                             <input class="form-control" value="{{ old('contact') }}" name="contact" type="text" required>
                                              <small class="help-block with-errors form-error contact"></small>
                                        </div>
                                   </div>
                                 </div>

                                 <div class="row">
                                   <div class="col-md-6">

                                        <div class="form-group">
                                             <span class="input-group-addon" >Company Address</span>
                                              <input class="form-control" value="{{ old('address') }}" name="address" type="text" required>
                                             <small class="help-block with-errors form-error address"></small>
                                        </div>
                                   </div>
                                   <div class="col-md-6">
                                        <div class="form-group">
                                             <span class="input-group-addon" >Fax number</span>
                                             <input class="form-control" value="{{ old('fax') }}" name="fax" type="text">
                                              <small class="help-block with-errors form-error fax"></small>
                                        </div>
                                   </div>

                                 </div>

                            </form>
                        </div>
                   </div>

                </section>

                <h2>Developer Profile</h2>
                <section class="profile-con">
                    <div class="row">

                        <div class="col-md-12">

                          <div class="form-group">
                             <textarea name="company_profile" class="summernote" id="company_profile" title="Contents"></textarea>
                          </div>

                        </div>
                   </div>
                </section>
                
                <h2>Developer Profile Overview</h2>
                <section class="profile-con">
                    <div class="row">

                        <div class="col-md-10 col-md-offset-1">

                           <div class="panel">
                                <div class="panel-body">  
                                  
                                    <div class="developer-profile-con"></div>
                                             
                                </div>
                            </div>


                        </div>
                   </div>
                </section>



                <h2>Developer Logo</h2>
                <section>
                    <div class="row">

                         <div class="col-md-4 col-md-offset-4">
                            
                            <div class="profile-picture-con user-picture-container">

                              <div class="overlay showCropboxModal" id="user-photo">
                                <div class="text">+</div>
                              </div>

                               <img src="{{ asset('storage/default.png') }}" id="profile-picture">
                               <input type="hidden" id="imgUpload" name="company_logo" value="">

                            </div>

                         </div>
                   </div>
                </section>





                <h2>Finish</h2>
                <section>

                  <form action="/developers/add" method="POST" id="AddDeveloperForm">
                  {{ csrf_field() }}

                  <div class="row account-con">


                        <div class="col-md-8">
                            <br><br>
                            <div class="row">
                              <div class="col-md-6">
                                  <div class="form-group">
                                       <span class="input-group-addon" >Company name</span>
                                        <input class="form-control" value="{{ old('name') }}" name="name" type="text" required="" readonly>
                                        <small class="help-block with-errors form-error name"></small>
                                  </div>
                              </div>

                               <div class="col-md-6">
                                 <div class="form-group">
                                       <span class="input-group-addon" >Contact number</span>
                                       <input class="form-control" value="{{ old('contact') }}" name="contact" type="text" required readonly>
                                        <small class="help-block with-errors form-error contact"></small>
                                  </div>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-md-6">
                                  <div class="form-group">
                                       <span class="input-group-addon" >Company Address</span>
                                        <input class="form-control" value="{{ old('address') }}" name="address" type="text" required="" readonly>
                                        <small class="help-block with-errors form-error address"></small>
                                  </div>
                              </div>

                               <div class="col-md-6">
                                  <div class="form-group">
                                       <span class="input-group-addon" >Fax number</span>
                                       <input class="form-control" value="{{ old('fax') }}" name="fax" type="text" readonly>
                                        <small class="help-block with-errors form-error fax"></small>
                                  </div>
                              </div>
                            </div>


                            <div class="row">


                                  <div class="col-md-12">
                                    <textarea name="profile" style="display:none" readonly></textarea>
                                  </div>

                            </div>



                        </div>

                        <div class="col-md-4">
                          <div class="profile-picture-con user-picture-container">  
                               <img src="{{ asset('storage/default.png') }}" id="profile-picture">
                               <input type="hidden" name="avatar" value="">

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