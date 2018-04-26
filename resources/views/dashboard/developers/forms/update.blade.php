<!-- MAIN -->
<div class="main">
    <!-- MAIN CONTENT -->
    <div class="main-content">


        <div class="container container-full">


        <div class="SeletedMenuHeader">
          
             <div class="row">
                    <div class="col-md-12">
                      <h4>UPDATE DEVELOPER</h4>
                    </div>
                </div>

        </div>

            <div class="panel panel-profile panel-update text">


            <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="pull-right"><a href="#tab_5" class="Status_Tab" data-toggle="tab" aria-expanded="false">Status</a></li>
              <li class="pull-right"><a href="#tab_3" class="Developer_Logo_Tab" data-toggle="tab" aria-expanded="false">Developer Logo</a></li>
              <li class="pull-right"><a href="#tab_2" class="Developer_Profile_Tab" data-toggle="tab" aria-expanded="false">Developer Profile</a></li>
              <li class="pull-right active"><a href="#tab_1" class="Developer_Information_Tab" data-toggle="tab" aria-expanded="true">Developer Information</a></li>
              <li class="img-circle-xs-con">

                <a class="actionViewDeveloper update-avatar-con" id="{{ $developer->id }}">
                   <div class="pull-left">
                    <img src="{{ $developer->logo }}" class="img-circle img-circle-xs" id="profile-picture">
                   </div>
                   <div class="pull-left">
                      <p>{{ $developer->name }}</p>
                      <p>{{ $developer->address }}</p>
                   </div>
                 </a>
               </li>

            </ul>
            <div class="tab-content">


              <div class="tab-pane active" id="tab_1">
                <div class="row">

                    <div class="col-md-8 col-md-offset-2">

                      <form method="POST" action="/developers/updateDeveloperInformation" id="updateDeveloperInformationForm">

                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{ $developer->id }}" />
                          <div class="panel">
                              <div class="panel-heading">
                                  <h3 class="panel-title"></h3>
                              </div>
                              <div class="panel-body">

                                  <div class="row">

                                    <div class="col-md-6">

                                      <div class="form-group">
                                        <span class="input-group-addon">Company Name</span>
                                        <input class="form-control" name="name" required="" type="text" value="{{ $developer->name }}">
                                        <small class="help-block with-errors form-error name"></small>
                                      </div>

                                      <div class="form-group">
                                        <span class="input-group-addon">Company Address</span>
                                        <input class="form-control" name="address" required="" type="text" value="{{ $developer->address }}">
                                        <small class="help-block with-errors form-error address"></small>
                                      </div>

                                    </div>

                                    <div class="col-md-6">

                                       <div class="form-group">
                                        <span class="input-group-addon">Company Contact Number</span>
                                        <input class="form-control" name="contact" required="" type="text" value="{{ $developer->contact }}">
                                        <small class="help-block with-errors form-error contact"></small>
                                      </div>

                                      <div class="form-group">
                                        <span class="input-group-addon">Company Fax Number</span>
                                        <input class="form-control" name="fax" type="text" value="{{ $developer->fax }}">
                                        <small class="help-block with-errors form-error fax"></small>
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



              <div class="tab-pane" id="tab_2">
                
                <div class="row">

                      <div class="col-md-12">
                        <div class="panel">
                              <div class="panel-body">
                                <form method="POST" action="/developers/updateDeveloperProfile" id="updateDeveloperProfileForm">

                                  {{ csrf_field() }}
                                  <input type="hidden" name="id" value="{{ $developer->id }}" />

                                  <div class="form-group">
                                     <textarea name="profile" class="summernote" id="profile" title="Contents">{!! $developer->profile !!}</textarea>
                                  </div>
                                  <button type="submit" class="btn btn-info pull-right">Update</button>

                                </form>
                              </div>
                          </div>



                      </div>

                </div>

              </div>
              <!-- /.tab-pane -->


              <div class="tab-pane" id="tab_3">
                
                <div class="row">
                   <div class="col-md-4 col-md-offset-4">

                      <form method="POST" action="/developers/updateDeveloperLogo" enctype="multipart/form-data" id="updateDeveloperLogo">

                        {{ csrf_field() }}

                        <input type="hidden" name="id" value="{{ $developer->id }}" />
                        <div class="panel">
                            <div class="panel-heading">
                                <h3 class="panel-title"></h3>
                            </div>
                            <div class="panel-body text-center">
                            

                            <div class="change-profile-picture-con user-picture-container">

                              <div class="overlay showCropboxModal" id="user-photo">
                                <div class="text">+</div>
                              </div>

                               <img src="{{ $developer->logo }}" class="img-circle" id="profile-picture">
                               <input id="imgUpload" name="avatar" value="" type="hidden">

                            </div>

                            <br />
                            </div>
                            <div class="panel-footer text-right">
                               <button type="submit" class="btn btn-info">Change</button>
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
                              
                              <center>This developer is
                              @if( $developer->active )
                                <span class="label label-success">active</span>
                              @else
                                <span class="label label-danger">not active</span>
                              @endif</center>

                              <br><br>
                             

                                <div class="row">
                                 <div class="col-md-12 text-center">
                                      @if( $developer->active )
                                        
                                        <button type="button" class="btn btn-primary btn-block actionSetNotActiveDeveloperShowModal" id="{{ $developer->id }}">DEACTIVATE?</button>

                                      @else
                                        
                                        <button type="button" class="btn btn-primary btn-block actionSetActiveDeveloperShowModal" id="{{ $developer->id }}">ACTIVATE?</button>

                                      @endif

                                 </div>
                                </div>

                                          

                            <br /><br />
                            </div>
                        </div>
                      </div>

                  </div>

              </div>
              <!-- /.tab-pane -->



            </div>
            <!-- /.tab-content -->
          </div>





            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT -->
</div>
<!-- END MAIN -->