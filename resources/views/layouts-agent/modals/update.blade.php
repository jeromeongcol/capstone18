<div class="modal fade" id="AgentUpdateModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog modal-md">
    <div class="modal-content">
        <div class="modal-header justify-content-center">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                <i class="now-ui-icons ui-1_simple-remove"></i>
            </button>
            <h4 class="title title-up">&nbsp;</h4>
        </div>

        <div class="modal-body">
            
            <br>
        
            <div class="row">

                <div class="col-md-6 text-center change-profile-picture-con">
                    
                    <h3>Change Profile Picture</h3>

                    <form action="/agent/profile/changeprofilepicture" method="POST" enctype="multipart/form-data" class="register-form" id="ChangeProfilePicForm">
                    
                    {{ csrf_field() }}

                    <input type="hidden" name="id" value="">

                    <div class="agent-update-picture-con text-center showCropboxModal">

                        <img src="">
                        <input type="hidden" name="avatar">
                        
                    </div>

                    <br>

                    <input type="submit" class="btn btn-info btn-round" value="Save Changes" />

                    </form>

                    <br>
                    <br>


                </div>

                <div class="col-md-6 text-center">

                    <h3>Change Password</h3>
                    <br>
                    
                    <form action="/agent/profile/chanegpassword" method="POST" enctype="multipart/form-data" class="register-form" id="ChangePasswordForm">
                    
                    {{ csrf_field() }}
                    
                    <input type="hidden" name="id" value="">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="now-ui-icons ui-1_lock-circle-open"></i>
                        </span>
                        <input class="form-control" name="password" placeholder="Change Password" type="password">
                        
                    </div>

                    <small class="form-text form-error password"></small>
    
                    <div class="input-group">
                        <span class="input-group-addon">
                           <i class="now-ui-icons ui-1_lock-circle-open"></i>
                        </span>
                        <input class="form-control" name="password_confirmation" placeholder="Confirm Password" type="password">
                    </div>
                    
                        <small class="form-text form-error password_confirmation"></small>
                    <br>

                    <input type="submit" class="btn btn-info btn-round" value="Save Changes" />

                    </form>

                </div>

            </div>

            <br>

            <br>
            <br>


        </div>
    </div>
</div>
</div>