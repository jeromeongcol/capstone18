    <!-- Modal Update User -->
    <div class="modal fade" id="ImportUserExcelModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xs">
                <div class="modal-content">
                    <div class="modal-header">
                        <ul class="modal-head-title">
                            <li class="">IMPORT EXCEL</li>
                        </ul>
                        <ul class="modal-close">
                            <li class="" data-dismiss="modal"><i class="fa fa-close"></i></li>
                        </ul>

                    </div>

                    <form method="POST" action="/users/import" id="ImportExcelUserForm" enctype="multipart/form-data">
                        {{ csrf_field() }}

                    <div class="modal-body">


                        <div class="row"> 
                            <div class="col-md-12">
                                <div class="alert alert-success">
                                        <div class="container-fluid">
                                           Please browse an excel file, The system will automatically import the users to the database. 
                                        </div>
                                </div>
                                <div class="alert alert-danger error_verify" style="display: none">
                                        <div class="container-fluid">
                                          Credentials did not match.
                                        </div>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-12">
                              <label class="btn btn-info btn-file btn-block">
                                  <span id="UserExcelFileBtn">Browse Excel</span><input type="file" name="UserExcelFile" id="UserExcelFile" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" style="display: none;">
                              </label>

                          </div>
                        </div>



                        <br>

                        <div class="row">
                          <div class="col-md-12">

                              <div class="progress">
                                      <div id="progress" class="progress-bar progress-bar-striped active" role="progressbar" >
                                          <span></span>
                                      </div>
                              </div>

                          </div>
                       </div>

                   
                </div>

                <div class="modal-footer modal-footer-center">
                   <button type="submit" class="btn btn-primary">IMPORT</button>
                </div>
              </form>
            </div>
        </div>
    
    </div>