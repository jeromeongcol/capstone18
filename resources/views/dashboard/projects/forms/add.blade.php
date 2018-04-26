<div class="SeletedMenuHeader">
    <div class="row">
        <div class="col-md-6 col-xs-6">

          <h4>
              <a class="back developers-menu"><img src="{{ asset('layouts/img/back.png') }}"></a>Project > Add project
          </h4>

        </div>
    </div>

</div>


<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">


      <div class="panel">
        <div class="panel-body page-content">

            
            <div class="AddProjectSteps steps-con steps-with-auto">
                <h2>Select Developer</h2>
                <section>
                   
                    <div class="row">
                       <div class="col-md-8 col-md-offset-2">


                          <div class="panel addproject-panel-select">
                            <div class="panel-heading">

                                  <h3 class="panel-title">Project Developer

                                      <a type="button" class="btn btn-primary btn-sm pull-right"  id="AddDeveloperBtn">
                                        <i class="fa fa-plus-circle" aria-hidden="true"></i> Add Developer
                                      </a>

                                  </h3>

                              </div>
                              <div class="panel-body">
                                <div class="Selection-Container">
                                   <table class="table" id="DevelopersTable">
                                      @include('dashboard.projects.forms.partials.developers')
                                  </table>
                                </div>

                              </div>
                          </div>


                       </div>



                   </div>

                </section>


                <h2>Project Details</h2>
                <section>
                   
                    <div class="row">
                          <div class="col-md-10 col-md-offset-1">
                              <br/><br/>

                              <form action="/projects/validate/projectDetails" method="POST" id="ProjectDetailsForm">
                                  
                                  {{ csrf_field() }}

                                  <div class="row">
                                     <div class="col-md-6">
                                         <div class="form-group">
                                               <span class="input-group-addon" >Project Name</span>
                                                <input class="form-control" value="{{ old('project_name') }}" name="project_name" type="text" required="">
                                                <small class="help-block with-errors form-error project_name"></small>
                                          </div>
                                     </div>
                                      <div class="col-md-6">
                                              <div class="form-group">
                                                   <span class="input-group-addon" >Project Location</span>
                                                    <input class="form-control" value="{{ old('project_location') }}" name="project_location" type="text" required>
                                                   <small class="help-block with-errors form-error project_location"></small>
                                              </div>
                                     </div>
                                  </div>

                              </form>
                          </div>
                     </div>

                </section>



                 <h2>Project Category</h2>
                <section>
                   
                    <div class="row">
                       <div class="col-md-8 col-md-offset-2">
                        
                                <div class="panel addproject-panel-select">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Project Categories</h3>
                                    </div>
                                    <div class="panel-body text-center">
                                      
                                      <div class="Selection-Container">

                                        <table class="table" id="DevelopersTable">
                                            @include('dashboard.projects.forms.partials.categories')
                                        </table>

                                      </div>

                                    </div>
                                </div>



                        </div>



                   </div>

                </section>






                <h2>Description</h2>
                <section class="profile-con">
                    <div class="row">

                        <div class="col-md-12">

                          <div class="form-group">
                             <textarea name="company_profile" class="summernote-project" id="project_description_textarea" title="Contents"></textarea>
                          </div>

                        </div>
                   </div>
                </section>
                






                <h2>Project Photos</h2>
                <section>
                    <div class="row">

                          <div class="col-md-10 col-md-offset-1">
                              
                              <div class="row">

                                 <div class="col-md-6">

                                        <div class="profile-picture-con user-picture-container featured-photo-con">

                                            <div class="overlay photo-overlay-square showCropboxModal" id="user-photo">
                                              <div class="text">+</div>
                                            </div>

                                             <img src="{{ asset('storage/default.png') }}" id="profile-picture" class="photo-overlay-square">
                                             <input type="hidden" id="imgUpload" name="company_logo" value="">

                                         </div>
                                   

                                 </div>

                                 <div class="col-md-6">
                                      

                                  <button class="btn btn-primary btn-lg upload-more-photo-btn" onclick="document.getElementById('project_photos').click();"><i class="fa fa-file-image-o"></i> Add More Photos</span></button>
                                      


                                 </div>

                               </div>

                           </div>

                   </div>
                </section>









                <h2>Finish</h2>
                <section>

                  <form action="/projects/add" method="POST" id="AddProjectForm" enctype="multipart/form-data">
                  {{ csrf_field() }}

                  <div class="row account-con">


                        <div class="col-md-9">
                            <br><br>
                            <div class="row">

                              <div class="col-md-6">
                                  <div class="form-group">
                                       <span class="input-group-addon" >Developer</span>
                                        <input class="form-control" value="{{ old('developer_name') }}" name="developer_name" type="text" required="" readonly>
                                        <input type="hidden" name="developer">
                                        <small class="help-block with-errors form-error developer"></small>
                                  </div>
                              </div>

                              <div class="col-md-6">
                                  <div class="form-group">
                                       <span class="input-group-addon" >Project Name</span>
                                        <input class="form-control" value="{{ old('name') }}" name="project_name" type="text" required="" readonly>
                                        <small class="help-block with-errors form-error project_name"></small>
                                  </div>
                              </div>


                            </div>

                            <div class="row">

                                <div class="col-md-6">
                                  <div class="form-group">
                                       <span class="input-group-addon" >Project Category</span>
                                        <input class="form-control" value="{{ old('catergory_name') }}" name="project_category_name" type="text" required="" readonly>
                                        <input type="hidden" name="project_category">
                                        <small class="help-block with-errors form-error catergory_name"></small>
                                  </div>
                              </div>

                              <div class="col-md-6">
                                 

                              </div>

                              <div class="col-md-6">
                                  <div class="form-group">
                                       <span class="input-group-addon" >Project Location</span>
                                        <input class="form-control" value="{{ old('project_location') }}" name="project_location" type="text" required="" readonly>
                                        <small class="help-block with-errors form-error project_location"></small>
                                  </div>
                              </div>

                            </div>


                            <div class="row">


                                  <div class="col-md-12">
                                    <textarea name="project_description" style="display:none" readonly></textarea>
                                  </div>

                            </div>



                        </div>

                        <div class="col-md-3">
                          <br><br>
                          <div class="profile-picture-con user-picture-container finish-project-photo">  
                               <img src="{{ asset('storage/default.png') }}" id="profile-picture">
                               <input type="hidden" name="featured_photo" value="">

                                <label class="btn btn-primary btn-lg btn-file upload-more-photo-btn" id="project_photos" style="display:none;">
                                    <span class="btn-file-project-photos"><i class="fa fa-file-image-o"></i> Add More Photos</span><input type="file"  name="project_photos[]" accept="image/*" style="display: none;" multiple>
                                </label>

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