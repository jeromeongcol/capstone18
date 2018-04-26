<!-- MAIN -->
<div class="main">
    <!-- MAIN CONTENT -->
    <div class="main-content">


        <div class="container container-full">


        <div class="SeletedMenuHeader">
          
             <div class="row">
                    <div class="col-md-12">
                      <h4>UPDATE PROJECT</h4>
                    </div>
                </div>

        </div>

            <div class="panel panel-profile panel-update text">


            <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="pull-right"><a href="#tab_5" class="Status_Tab" data-toggle="tab" aria-expanded="false">Status</a></li>
              <li class="pull-right"><a href="#tab_4" class="Project_Photos_Tab" data-toggle="tab" aria-expanded="false">Project Photos</a></li>
              <li class="pull-right"><a href="#tab_3" class="Project_Category_Tab" data-toggle="tab" aria-expanded="false">Category</a></li>
              <li class="pull-right"><a href="#tab_6" class="Project_Description_Tab" data-toggle="tab" aria-expanded="false">Description</a></li>
              <li class="pull-right"><a href="#tab_2" class="Project_Developer_Tab" data-toggle="tab" aria-expanded="false">Developer</a></li>
              <li class="pull-right active"><a href="#tab_1" class="Project_Information_Tab" data-toggle="tab" aria-expanded="true">Project Information</a></li>
              <li class="img-circle-xs-con">

                <a class="actionViewProject update-avatar-con" id="{{ $project->id }}">
                   <div class="pull-left">
                    <img src="{{ $project->featured_photo }}" class="img-circle img-circle-xs" id="profile-picture">
                   </div>
                   <div class="pull-left">
                      <p>{{ $project->project_name }}</p>
                      <p>{{ $project->project_location }}</p>
                   </div>
                 </a>
               </li>

            </ul>
            <div class="tab-content">


              <div class="tab-pane active" id="tab_1">
                <div class="row">

                    <div class="col-md-8 col-md-offset-2">

                      <form method="POST" action="/project/updateProjectInformation" id="updateProjectInformationForm">

                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{ $project->id }}" />
                          <div class="panel">
                              <div class="panel-heading">
                                  <h3 class="panel-title"></h3>
                              </div>
                              <div class="panel-body">

                                  <div class="row">

                                    <div class="col-md-6">

                                      <div class="form-group">
                                        <span class="input-group-addon">Project Name</span>
                                        <input class="form-control" name="project_name" required="" type="text" value="{{ $project->project_name }}">
                                        <small class="help-block with-errors form-error project_name"></small>
                                      </div>

                                    </div>

                                    <div class="col-md-6">

                                       <div class="form-group">
                                        <span class="input-group-addon">Project Location</span>
                                        <input class="form-control" name="project_location" required="" type="text" value="{{ $project->project_location }}">
                                        <small class="help-block with-errors form-error project_location"></small>
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


              <div class="tab-pane" id="tab_6">
                
                <div class="row">

                      <div class="col-md-12">

                       <form method="POST" action="/project/updateProjectDescription" id="updateProjectDescriptionForm">

                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{ $project->id }}" />


                        <div class="panel">
                              <div class="panel-body">

                                  <div class="form-group">
                                     <textarea name="project_description" class="summernote" id="profile" title="Contents">{!! $project->project_description !!}</textarea>
                                  </div>
                                  <button type="submit" class="btn btn-info pull-right">Update</button>

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
                          
                        <form method="POST" action="/project/updateProjectDeveloper" id="updateProjectDeveloperForm">

                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{ $project->id }}" />

                          <div class="panel addproject-panel-select">
                            <div class="panel-heading">

                                  <h3 class="panel-title">Developers

                                      <span class="pull-right label label-success">Project Developer : {{ $project->developer_name }}</span>

                                  </h3>

                              </div>
                              <div class="panel-body">
                                <div class="Selection-Container">
                                   <table class="table">
                                      @include('dashboard.projects.forms.partials.developers')
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



              <div class="tab-pane" id="tab_3">
                
                <div class="row">

                      <div class="col-md-8 col-md-offset-2">
                          
                      <form method="POST" action="/project/updateProjectCategory" id="updateProjectCategoryForm">

                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{ $project->id }}" />
                        <div class="panel addproject-panel-select">
                            <div class="panel-heading">
                                <h3 class="panel-title">Project Categories <span class="pull-right label label-success">Project Category : {{ $project->type }}</span></h3>
                            </div>
                            <div class="panel-body text-center">
                              
                              <div class="Selection-Container">

                                <table class="table">
                                    @include('dashboard.projects.forms.partials.categories')
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
                   <div class="col-md-4">

                      <form method="POST" action="/project/updateProjectFeaturedPhoto" enctype="multipart/form-data" id="updateProjectFeaturedPhotoForm">

                        {{ csrf_field() }}

                        <input type="hidden" name="id" value="{{ $project->id }}" />
                        <div class="panel">
                            <div class="panel-heading">
                                <h3 class="panel-title">Featured Photo</h3>
                            </div>
                            <div class="panel-body text-center">
                            

                            <div class="change-profile-picture-con user-picture-container">

                              <div class="overlay showCropboxModal" id="user-photo">
                                <div class="text">+</div>
                              </div>

                               <img src="{{ $project->featured_photo }}" class="img-circle" id="profile-picture">
                               <input id="imgUpload" name="featured_photo" value="" type="hidden">

                            </div>

                            <br />
                            </div>
                            <div class="panel-footer text-right">
                               <button type="submit" class="btn btn-info">Change</button>
                            </div>
                        </div>

                      </form>

                      </div>


                   <div class="col-md-8">

                        <div class="panel">
                            <div class="panel-heading">
                                <h3 class="panel-title">Additional Photos</h3>
                            </div>
                            <div class="panel-body">
                              
                            <div class="AdditionalPhoto-Container">
                                <div class="row">

                                  @foreach( $project_photos as $project_photo )
                                   <div class="col-md-3 text-center">
                                      <div class="additional-photos-action">

                                          
                                            <form method="POST" action="/project/deleteProjectAdditionalPhoto" id="deleteProjectAdditionalPhotoForm">
                                              {{ csrf_field() }}
                                               <input type="hidden" name="id" value="{{ $project_photo->id }}">

                                                  
                                                  <button type="button" class="btn btn-danger actionDeleteAdditionalPhoto pull-left" id="{{$project_photo->id}}"><i class="fa fa-times" aria-hidden="true"></i></button> <span>DELETE</span>


                                            </form>

                                      </div>

                                      <div class="additional-photos-con">
                                        
                                         <a class="fancybox" href="{{ $project_photo->photo }}" data-fancybox-group="gallery" title="{{ $project->project_name }}"><img class="img-circle additional-photos" src="{{ $project_photo->photo }}"/></a>

                                      </div>

                                   </div>

                                   @endforeach

                                   


                                </div>
                            </div>

                            </div>



                            <div class="panel-footer text-right">

                             <form method="POST" action="/project/updateProjectAdditionalPhotos" enctype="multipart/form-data" id="updateProjectAdditionalPhotosForm">

                              {{ csrf_field() }}

                              <input type="hidden" name="id" value="{{ $project->id }}" />

                                  <label class="btn btn-primary btn-file">
                                    <span class="btn-file-project-photos"><i class="fa fa-file-image-o"></i> <span class="SelectedPhotos">Add Photos</span></span><input type="file" id="project_photos" name="project_photos[]" accept="image/*" style="display: none;" multiple>
                                </label>
                               <button type="submit" class="btn btn-info addAdditionalPhotoBtn">SUBMIT</button>

                             </form>
                            </div>
                        </div>

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
                              
                              <center>This project is
                              @if( !$project->deleted )
                                <span class="label label-success">active</span>
                              @else
                                <span class="label label-danger">not active</span>
                              @endif</center>

                              <br><br>
                             

                                <div class="row">
                                 <div class="col-md-12 text-center">
                                      @if( $project->deleted )
                                        
                                        <button type="button" class="btn btn-primary btn-block actionSetActiveProjectShowModal" id="{{ $project->id }}">ACTIVATE?</button>

                                      @else
                                        
                                        <button type="button" class="btn btn-primary btn-block actionSetNotActiveProjectShowModal" id="{{ $project->id }}">DEACTIVATE?</button>

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



        