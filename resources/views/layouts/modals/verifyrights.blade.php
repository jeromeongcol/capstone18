    <!-- Modal Update User -->
    <div class="modal fade" id="VerifyUserModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xs">
                <div class="modal-content">
                    <div class="modal-header">
                        <ul class="modal-head-title">
                            <li class="">RIGHTS VERIFICATION</li>
                        </ul>
                        <ul class="modal-close">
                            <li class="" data-dismiss="modal"><i class="fa fa-close"></i></li>
                        </ul>

                    </div>
                    <div class="modal-body">
                        <div class="row"> 
                            <div class="col-md-12">
                                <div class="alert alert-success">
                                        <div class="container-fluid">
                                           Please enter your password. The action that you are about to do requires an admin rights for additional security purposes.
                                        </div>
                                </div>
                                <div class="alert alert-danger error_verify" style="display: none">
                                        <div class="container-fluid">
                                          Credentials did not match.
                                        </div>
                                </div>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input type="hidden" id="targetId" class="form-control" required />
                                        <input type="hidden" id="targetAction" class="form-control" required />
                                        <input type="password" placeholder="Password" name="verifypassword" autocomplete="off" id="verifypassword" class="form-control" required />
                                    </div>
                                    
                                 </div>
                            </div>
                        <br>
                        <div class="row"> 
                            <div class="col-md-12 text-center">
                                <button type="button" id="verifypasswordbtn" class="btn btn-info btn-block">VERIFY AND PROCEED</button>
                            </div>
                        </div>

                </div>
            </div>
        </div>
    
    </div>