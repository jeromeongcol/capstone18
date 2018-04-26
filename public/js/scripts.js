  

    function readURL1(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#UserPictureUp').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    };





    function readURL2(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#UserChangePicture').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    };
    

    function readURL3(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#AddDeveloperModal #UserPictureUp').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    };



    function readURL4(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#UpdateDeveloperModal #UserPictureUp').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    };
    

    function readURL5(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#UserPictureUp').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    };
    
function reloadDataTable() {

        $(".data-table-list").DataTable({
            "scrollY":        "350px",
            "scrollCollapse": true,
            drawCallback: function(settings) {
                var pagination = $(this).closest('.dataTables_wrapper').find('.dataTables_paginate');
                pagination.toggle(this.api().page.info().pages > 1);
              }
        });

 };

    var userToCrop = "";




    
    $(function() {


        $('.summernote').summernote({
            height: 200,
            maxHeight: 278  
          });


        $( ".item" ).hover(
          function() {
            $(this).find(".item-action").show();
          }, function() {
            $(this).find(".item-action").hide();
          }
        );


        $(document).on('change','#imgUpload', {} ,function(e){
            readURL1(this);
        });


        $(document).on('change','#imgChangeProfilePic', {} ,function(e){
            readURL2(this);
        });

        $(document).on('change','#imgUploadDevAdd', {} ,function(e){
            readURL3(this);
        });


        $(document).on('change','#imgUploadDevinfo', {} ,function(e){
            readURL4(this);
        });


        $(document).on('change','#imgUploadDevAdd', {} ,function(e){
            readURL5(this);
        });



        // Activate Datepicker
        //$('.datepicker').datepicker({
        //     weekStart:1,
        //     dateFormat: 'yy-mm-dd'
        //});


        $('.datetimepicker').datetimepicker({
            format: 'LT'
        });


        $('.datepicker').datetimepicker({
            viewMode: 'years',
            format: 'YYYY/MM/DD',
            maxDate: moment().subtract(18, 'years').startOf('year'),
            minDate: moment().subtract(60, 'years').startOf('year')
        });


        $('.datepicker-inline').datetimepicker({
            viewMode: 'months',
            format: 'YYYY/MM/DD',
            maxDate: moment(),
            minDate: moment().subtract(60, 'years').startOf('year')
        });

        

        $('.eventdatepicker').datetimepicker({
            viewMode: 'months',
            showTodayButton: true,
            sideBySide: true,
            minDate: moment().subtract(0, 'years').startOf('year')
        });



         $('#cp001').colorpicker({  
            color: '#149bb1'
            });

        $('#cp002').colorpicker({  
            color: '#FFFFFF' 
        });


         $('#cp003').colorpicker({  
            color: '#149bb1'
            });

        $('#cp004').colorpicker({  
            color: '#FFFFFF' 
        });



        if( $( ".userrole" ).val() != "1" ){
            $(".agentrank").attr('disabled','disabled')
            $("input[name='recruiter_name']").attr('required','required');
            $("input[name='recruiter']").attr('required', 'required');
        }else{

            $("input[name='recruiter_name']").removeAttr('required');
            $("input[name='recruiter']").removeAttr('required');
            $(".agentrank").removeAttr('disabled')

        }


        $(".show-event-list-btn").click( function(){

            $("#Event-List").show();
            $(".event-list-filter-buttons").show();
            $("#Event-Calendar").hide();

        });

        $(".show-event-calendar-btn").click( function(){

            $("#Event-List").hide();
            $(".event-list-filter-buttons").hide();
            $("#Event-Calendar").show();

        });



        $(".userrole").change(function () {

            if( $(this).val() != "1" ){
                $(".agentrank").attr('disabled','disabled')
                    $(".register-form input[name='recruiter']").val('');
                    $(".register-form input[name='recruiterid']").val('' );
            }else{
                $(".agentrank").removeAttr('disabled')
            }

        });




        var minimizeUserList = true;

        $(".maximize-list").click(function(){
            $("#user-list .col-list").addClass("col-md-12");
            $("#user-list .col-list").removeClass("col-md-8");
            $("#user-information-con").hide();
            $(".btn-toggle-fullwidth").trigger("click");
            $("#full-list").hide();
            $(this).hide();
            $(".minimize-list").show();
            minimizeUserList = false;
        });


        $(".minimize-list").click(function(){
            $("#user-list .col-list").removeClass("col-md-12");
            $("#user-list .col-list").addClass("col-md-8");
            $("#user-information-con").show();
            $(".btn-toggle-fullwidth").trigger("click");
            $("#full-list").hide();
            $(this).hide();
            $(".maximize-list").show();
            minimizeUserList = true;
        });



        //populate user data

        $(document).on('click','#users-table tr.data', {} ,function(e){

            $("#users-table tr.data").removeClass('active');
            $(this).addClass('active');

            var userid = $(this).attr('id');



            if( minimizeUserList ){

                $.ajax({
                url: "/user",
                type:"GET", 
                data: {"id":userid}, 
                success: function(result){


                    $("#user-information .user-avatar-info img").attr('src',result.photo_thumb);
                    $("#user-information .email").html(result.email);
                    $("#user-information .birth").html(result.datebirth);
                    $("#user-information .name").html(result.lastname + " , " + result.firstname + " " +result.middlename);
                    $("#user-information .role").html(result.name);


                    if(result.active){
                        $(this).children(".actionSetNotActiveUserBtnShowModal").show();
                        $(this).children(".actionSetActiveUserBtnShowModal").hide();
                    }else{
                        $(this).children(".actionSetNotActiveUserBtnShowModal").hide();
                        $(this).children(".actionSetActiveUserBtnShowModal").show();
                    }

                },error: function (data) {
                    alert(data.status);
                    }
                 });
             }
        });









        $(document).on('submit','form#updateUserForm', {} ,function(e){
            e.preventDefault();

            var formdata = $(this).serializeArray();

            $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'), 
            data: formdata ,
            success: function(data){    
                
                   if($.isEmptyObject(data.error)){

                        $("#user-list").html(data.content);
                        $("#SuccessModal .feedback-message").html( data.success );
                        $("#SuccessModal").modal("show");
                        $("#UpdateUserModal").modal("hide");

                        reloadDataTable();


                    }else{

                        var ul = "<ul>";

                        $.each( data.error, function( key, value ) {
                          ul += "<li>" + value + "</li>";
                        });

                        ul += "</ul>";

                        $("#UpdateUserModal #form-errors").html( ul );
                        $("#UpdateUserModal .form-errors-con").show();
                    }
                
                },
            error: function (data) {
                alert(data.status);
                }

            });

            return false;
        });











        $(document).on('submit','form#updateUserAccountForm', {} ,function(e){
            e.preventDefault();

            var formdata = $(this).serializeArray();
            
            $.ajax({
            url: $(this).attr('action'),
            type:"POST", 
            data: formdata ,
            success: function(data){    
                
                   if($.isEmptyObject(data.error)){

                        $("#user-list").html(data.content);
                        $("#SuccessModal .feedback-message").html( data.success );
                        $("#SuccessModal").modal("show");
                        $("#UpdateUserAccountModal").modal("hide");

                        reloadDataTable();



                    }else{

                        $("#UpdateUserAccountModal #form-errors").html(data.error);
                        $("#UpdateUserAccountModal .form-errors-con").show();
                    }
                
                }

            });

            return false;
        });









        $(document).on('click','.actionUpdateUserBtnShowModal', {} ,function(e){
         

            var userid = $(this).attr('id');


            $("#UpdateUserModal .form-errors-con").hide();

            $.ajax({
            url: "/user",
            type:"GET", 
            data: {"id":userid}, 
            success: function(result){

                $("#UpdateUserModal #UserPictureUp").attr('src',result.photo_thumb);
                $("#UpdateUserModal input[name='id']").val(result.user_id);
                $("#UpdateUserModal input[name='lastname']").val(result.lastname);
                $("#UpdateUserModal input[name='firstname']").val(result.firstname);
                $("#UpdateUserModal input[name='middlename']").val(result.middlename);
                $("#UpdateUserModal input[name='datebirth']").val(result.datebirth);
                $("#UpdateUserModal input[name='email']").val(result.email);
                $("#UpdateUserModal input[name='street']").val(result.street);
                $("#UpdateUserModal input[name='barangay']").val(result.barangay);
                $("#UpdateUserModal input[name='city']").val(result.city);
                $("#UpdateUserModal input[name='province']").val(result.province);
                $("#UpdateUserModal input[name='state']").val(result.state);
                $("#UpdateUserModal input[name='zipcode']").val(result.zipcode);
                $("#UpdateUserModal select[name='gender'] option[value='" + result.gender + "']").attr('selected','selected');
                $("#UpdateUserModal select[name='userrole'] option[value='" + result.role_id + "']").attr('selected','selected');
                $("#UpdateUserModal select[name='active'] option[value='" + result.active + "']").attr('selected','selected');
                $("#UpdateUserModal select[name='status'] option[value='" + result.status + "']").attr('selected','selected');

                $("#UpdateUserModal").modal("show");
                
                },
            error: function (data) {
                alert(data);
                }
             });

        });









        $(document).on('click','.actionUpdateUserAccountBtnShowModal', {} ,function(e){

            var userid = $(this).attr('id');

            $("#UpdateUserAccountModal .form-errors-con").hide();

            $.ajax({
            url: "/user",
            type:"GET", 
            data: {"id":userid}, 
            success: function(result){

                $("#UpdateUserAccountModal input[name='id']").val(userid);
                $("#UpdateUserAccountModal input[name='email']").val(result.email);
                $("#UpdateUserAccountModal select[name='userrole'] option[value='" + result.role_id + "']").attr('selected','selected');
                $("#UpdateUserAccountModal select[name='active'] option[value='" + result.active + "']").attr('selected','selected');
               

                $("#UpdateUserAccountModal").modal("show");
                
                },
            error: function (data) {
                alert(data);
                }
             });

        });






        $(document).on('click','.actionChangePasswordBtnShowModal', {} ,function(e){

            var userid = $(this).attr('id');

            $.ajax({
            url: "/user",
            type:"GET", 
            data: {"id":userid}, 
            success: function(result){

                $("#ChangePasswordModal input[name='id']").val(userid);
                $("#ChangePasswordModal input[name='email']").val(result.email);
                $("#ChangePasswordModal").modal("show");
                
                },
            error: function (data) {
                alert(data);
                }
             });

        });





        $(document).on('submit','form#changePasswordForm', {} ,function(e){
            e.preventDefault();

            var formdata = $(this).serializeArray();

            $.ajax({
            url: "/user/changepassword",
            type:"POST", 
            data: formdata,
            success: function(data){


                if($.isEmptyObject(data.error)){

                    $("#user-list").html(data.content);
                    $("#SuccessModal .feedback-message").html( data.success );
                    $("#SuccessModal").modal("show");
                    $("#ChangePasswordModal").modal("hide");

                     $("#ChangePasswordModal .form-error.password").html("");
                     $("#ChangePasswordModal .form-error.password_confirmation").html("");

                     $("#ChangePasswordModal input[name='password']").val("");
                     $("#ChangePasswordModal input[name='password_confirmation']").val("");

                    }else{

                        $("#ChangePasswordModal .form-error.password").html("");
                        $("#ChangePasswordModal .form-error.password_confirmation").html("");

                        $("#ChangePasswordModal .form-error.password").html( data.error['password'] );
                        $("#ChangePasswordModal .form-error.password_confirmation").html( data.error['password_confirmation'] );
                    }   
                
                },
            error: function (data) {
                alert(data.status);
                }
             });

        });








        $(document).on('click','.actionViewUserBtnShowModal', {} ,function(e){

            var userid = $(this).attr('id');
            
            $.ajax({
            url: "/user/profile",
            type:"GET", 
            data: {"id":userid}, 
            success: function(data){

                $(".view-overlay-content").html(data.content);
                $(".overlay-fullscreen").css("opacity","1");
                $(".overlay-fullscreen").css("z-index","1550");
                
                },
            error: function (data) {
                alert(data.status);
                }
             });

        });





        $(document).on('click','.actionSetNotActiveUserBtnShowModal', {} ,function(e){

            $("#VerifyUserModal #targetAction").val( ".actionSetNotActiveUserBtnShowModal" );
            $("#VerifyUserModal #targetId").val( $(this).attr('id') );
            $("#VerifyUserModal #verifypassword").val("");
            $("#VerifyUserModal").modal("show");

        });









        $(document).on('click','.actionSetActiveUserBtnShowModal', {} ,function(e){

            $("#VerifyUserModal #targetAction").val( ".actionSetActiveUserBtnShowModal" );
            $("#VerifyUserModal #targetId").val( $(this).attr('id') );
            $("#VerifyUserModal").modal("show");

        });











        $("#verifypasswordbtn").on('click',function(e){

            var verifypassword = $('#verifypassword').val();
            
            $.ajax({
            url: "/verifyrights",
            type:"GET", 
            data: { "verifypassword":verifypassword }, 
            success: function(result){

                if( result ){

                    var userid = $("#VerifyUserModal #targetId").val();

                    if( $("#VerifyUserModal #targetAction").val() == ".actionSetNotActiveUserBtnShowModal" )
                    {


                         $.ajax({
                            url: "/user",
                            type:"GET", 
                            data: {"id":userid}, 
                            success: function(result){

                                $("#SetNotActiveUserModal input[name='email']").val(result.email);
                                $("#SetNotActiveUserModal #setToNotActiveForm input[name='id']").val(userid);
                                $("#SetNotActiveUserModal").modal('show');
                                $("#VerifyUserModal").modal("hide");
                                $('#verifypassword').val("");

                                },
                            error: function (data) {
                                alert(data);
                                }
                             });

                    }else if( $("#VerifyUserModal #targetAction").val() == ".actionSetActiveUserBtnShowModal" )
                    {
                           

                            $.ajax({
                            url: "/user",
                            type:"GET", 
                            data: {"id":userid}, 
                            success: function(result){

                                $("#SetActiveUserModal input[name='email']").val(result.email);
                                $("#SetActiveUserModal #setToActiveForm input[name='id']").val(userid);
                                $("#SetActiveUserModal").modal('show');
                                $("#VerifyUserModal").modal("hide");
                                $('#verifypassword').val("");

                                },
                            error: function (data) {
                                alert(data);
                                }
                             });
                    }else{
                        alert("none");
                    }



                }else{

                    $(".error_verify").show();
                    
                }

                },error: function (xhr, ajaxOptions, thrownError) {
                    alert( xhr.status);
                }
             });

        });






        $(document).on('submit','form#setToNotActiveForm', {} ,function(e){
             e.preventDefault();
           var formdata = $(this).serializeArray();
    
            $.ajax({
            url: "/users/setToNotActive",
            type:"POST", 
            data: formdata, 
            success: function(data){

                  if($.isEmptyObject(data.error)){

                        $("#user-list").html(data.content);
                        $("#SuccessModal .feedback-message").html( data.success );
                        $("#SuccessModal").modal("show");
                        $("#SetNotActiveUserModal").modal("hide");

                        reloadDataTable();

                    }
                
                },
            error: function (data) {
                alert(data);
                }
             });

        });





        $(document).on('submit','form#setToActiveForm', {} ,function(e){
            e.preventDefault();
           var formdata = $(this).serializeArray();
           
            $.ajax({
            url: "/users/setToActive",
            type:"POST", 
            data: formdata, 
            success: function(data){

                  if($.isEmptyObject(data.error)){

                        $("#user-list").html(data.content);
                        $("#SuccessModal .feedback-message").html( data.success );
                        $("#SuccessModal").modal("show");
                        $("#SetActiveUserModal").modal("hide");

                       reloadDataTable();

                    }
                
                },
            error: function (data) {
                alert(data);
                }
             });

        });









        $(document).on('click','.actionChangeProfilePicBtnShowModal', {} ,function(e){

            var userid = $(this).attr('id');
            

            $.ajax({
            url: "/user",
            type:"GET", 
            data: {"id":userid}, 
            success: function(data){

                if($.isEmptyObject(data.error)){

                        $("#ChangeProfilepicModal #UserChangePicture").attr( 'src', "" );
                        $("#ChangeProfilepicModal #UserChangePicture").attr( 'src', data.photo_thumb );
                        $("#ChangeProfilepicModal input[name='email']").val( data.email );
                        $("#ChangeProfilepicModal input[name='id']").val( userid );
                        $("#ChangeProfilepicModal").modal("show");

                    }   
                
                },
            error: function (data) {
                alert(data);
                }
             });

        });



        $(document).on('submit','form#ChangeProfilePictureForm', {} ,function(e){
            e.preventDefault();

            var data = new FormData(this);

            $.ajax({
            url: "/user/changeprofilepicture",
            type:"POST", 
            data: data,
            async: false, 
            cache: false,
            contentType: false,
            processData: false, 
            success: function(data){

                if($.isEmptyObject(data.error)){

                    $("#user-list").html(data.content);
                    $("#SuccessModal .feedback-message").html( data.success );
                    $("#SuccessModal").modal("show");
                    $("#ChangeProfilepicModal").modal("hide");


                    reloadDataTable();


                    }   
                
                },
            error: function (data) {
                alert(data.status);
                }
             });

        });






     $(document).on('submit','form#AddDeveloperForm', {} ,function(e){
            e.preventDefault();

            var data = new FormData(this);
            alert();

            $.ajax({
            url: "/developers",
            type:"POST",
            async: false, 
            data: data, 
            success: function(data){

                    if($.isEmptyObject(data.error)){

                        $("#developers").html(data.content);
                        $("#SuccessModal .feedback-message").html( data.success );
                        $("#SuccessModal").modal("show");
                        $("#AddDeveloperModal").modal("hide");

                        reloadDataTable();

                    }else{

                        $("#AddDeveloperModal .form-error.name").html(data.error['name']);
                        $("#AddDeveloperModal .form-error.contact").html(data.error['contact']);
                        $("#AddDeveloperModal .form-error.fax").html(data.error['fax']);
                        $("#AddDeveloperModal .form-error.address").html(data.error['address']);
                        $("#AddDeveloperModal .form-error.profile").html(data.error['profile']);



                    }                          

                
                },
                cache: false,
                contentType: false,
                processData: false

            });

            return false;
      });








      $(document).on('submit','form#updateDeveloperForm', {} ,function(e){
            e.preventDefault();

           var data = new FormData(this);

            $.ajax({
            url: $(this).attr('action'),
            type:"POST", 
            data: data ,
            async: false, 
            success: function(data){    
                
                   if($.isEmptyObject(data.error)){

                        $("#developers").html(data.content);
                        $("#SuccessModal .feedback-message").html( data.success );
                        $("#SuccessModal").modal("show");
                        $("#UpdateDeveloperModal").modal('hide');

                        reloadDataTable();


                    }else{

                        $("#UpdateDeveloperModal .form-error.name").html(data.error['name']);
                        $("#UpdateDeveloperModal .form-error.contact").html(data.error['contact']);
                        $("#UpdateDeveloperModal .form-error.fax").html(data.error['fax']);
                        $("#UpdateDeveloperModal .form-error.address").html(data.error['address']);
                        $("#UpdateDeveloperModal .form-error.profile").html(data.error['profile']);
                    }

                
                },
                cache: false,
                contentType: false,
                processData: false

            });

            return false;
      });







      $(document).on('click','.actionUpdateDeveloper', {} ,function(e){

            var id = $(this).attr('id');

            $.ajax({
            url: "/developer",
            type:"GET", 
            data: {"id":id},
            success: function(data){

                    $("#UpdateDeveloperModal .form-error.name").html("");
                    $("#UpdateDeveloperModal .form-error.contact").html("");
                    $("#UpdateDeveloperModal .form-error.fax").html("");
                    $("#UpdateDeveloperModal .form-error.address").html("");
                    $("#UpdateDeveloperModal .form-error.profile").html("");

                   $("#UpdateDeveloperModal input[name='id']").val(data.id);
                   $("#UpdateDeveloperModal input[name='name']").val(data.name);
                   $("#UpdateDeveloperModal input[name='contact']").val(data.contact);
                   $("#UpdateDeveloperModal input[name='fax']").val(data.fax);
                   $("#UpdateDeveloperModal textarea[name='address']").val(data.address);
                   $("#UpdateDeveloperModal textarea[name='profile']").val(data.profile);
                   $("#UpdateDeveloperModal .developer-avatar-info img").attr("src",data.logo);
                   $("#UpdateDeveloperModal").modal('show');
                
                },
            error: function (data) {
                 alert(data);
                }

            });

            return false;
      });








        $(document).on('click','.developer-table tr.data', {} ,function(e){

            $(".developer-table tr.data").removeClass('active');
            $(this).addClass('active');


            var id = $(this).attr('id');

            $(".SelectedDeveloperId").val( id );


      });





      $(document).on('submit','form#SetToNotActiveDeveloperForm', {} ,function(e){
            e.preventDefault();

            var formdata = $(this).serializeArray();

            $.ajax({
            url: $(this).attr('action'),
            type:"POST", 
            data: formdata ,
            success: function(data){    
                
                   if($.isEmptyObject(data.error)){

                        $("#developers").html(data.content);
                        $("#SuccessModal .feedback-message").html( data.success );
                        $("#SuccessModal").modal("show");
                        $("#Developer_SetNotActiveUserModal").modal("hide");

                        reloadDataTable();

                    }
                
                },
            error: function (data) {
                alert(data.status);
                }

            });

            return false;
      });






      $(document).on('submit','form#SetToActiveDeveloperForm', {} ,function(e){
            e.preventDefault();

            var formdata = $(this).serializeArray();

            $.ajax({
            url: $(this).attr('action'),
            type:"POST", 
            data: formdata ,
            success: function(data){    
                
                   if($.isEmptyObject(data.error)){

                        $("#developers").html(data.content);
                        $("#SuccessModal .feedback-message").html( data.success );
                        $("#SuccessModal").modal("show");
                        $("#Developer_SetActiveUserModal").modal("hide");
                       
                        reloadDataTable();


                    }

                
                },
            error: function (data) {
                alert(data.status);
                }

            });

            return false;
      });






      $(document).on('click','.actionSetActiveDeveloperShowModal', {} ,function(e){

            $("#Developer_SetActiveUserModal .SelectedDeveloperId").val( $(this).attr("id") );
            $("#Developer_SetActiveUserModal").modal("show");

      });






      $(document).on('click','.actionSetNotActiveDeveloperShowModal', {} ,function(e){

            $("#Developer_SetNotActiveUserModal .SelectedDeveloperId").val( $(this).attr("id") );
            $("#Developer_SetNotActiveUserModal").modal("show");
      });






        $(document).on('click','.actionViewDeveloper', {} ,function(e){


            var id = $(this).attr('id');

            $.ajax({
            url: "/developer/profile",
            type:"GET", 
            data: {"id":id},
            success: function(data){


                $(".view-overlay-content").html(data.content);
                $(".overlay-fullscreen").css("opacity","1");
                $(".overlay-fullscreen").css("z-index","1550");

                //$("#ViewDeveloperModal").modal("show");
                
                },
            error: function (data) {
                alert(data.status);
                }

            });

            return false;
      });




     $(document).on('click','.overlay-close', {} ,function(e){

        $(".overlay-fullscreen").css("opacity","0");
        $(".overlay-fullscreen").css("z-index","0");

    });


     $(document).on('change','#project_photos', {} ,function(e){
        $(".btn-file-project-photos").html( "Add Photos - ( " + this.files.length + " ) photos selected." );
            if(this.files.length>15){
                $('#AlertModal .modal-message').html( 'Too many files selected. Maximum files to upload is 15.' );
                $('#AlertModal').modal("show");
            }
        });





      $(document).on('submit','form#UpdateProjectForm', {} ,function(e){
            e.preventDefault();


            if( $('#project_photos').get(0).files.length <= 15 ){
            var data = new FormData(this);

            $.ajax({
                xhr: function()
                      {
                        var xhr = new window.XMLHttpRequest();
                        //Upload progress
                        xhr.upload.addEventListener("progress", function(evt){
                          if (evt.lengthComputable) {

                            var ratio = Math.floor((evt.loaded / evt.total) * 100) + '%';
                            $('#progress').css('width', ratio);
                            $('#progress span').html(ratio);

                          }
                        }, false);
                        //Download progress
                        xhr.addEventListener("progress", function(evt){
                          if (evt.lengthComputable) {
                            var ratio = Math.floor((evt.loaded / evt.total) * 100) + '%';
                            $('#progress').css('width', ratio);
                            $('#progress span').html(ratio);
                          }
                        }, false);
                        return xhr;
                      },
                url: $(this).attr('action'),
                type:"POST", 
                data: data,
                dataType:'json',
                async: true,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data){    
                    
                      if($.isEmptyObject(data.error)){


                            $("#SuccessModal .feedback-message").html( data.success );
                            $("#SuccessModal").modal("show");

                            $(".overlay-fullscreen").css("opacity","0");
                            $(".overlay-fullscreen").css("z-index","0");


                            $("#projects").html(data.content);

                               reloadDataTable();


                        }else{

                            $(".form-error.project_name").html(data.error['project_name']);
                            $(".form-error.project_address").html(data.error['project_location']);
                            $(".form-error.project_price").html(data.error['project_price']);
                            
                            
                        }      

                    
                    },
                error: function (data) {
                    alert(data.status);
                    }

            });

            return false;
        }else{
                $('#AlertModal .modal-message').html( 'Too many files selected. Maximum files to upload is 15.' );
                $('#AlertModal').modal("show");
        }
      });






     $(document).on('submit','form#AddProjectForm', {} ,function(e){
            e.preventDefault();

            if( $('#project_photos').get(0).files.length <= 15 ){

            var data = new FormData(this);

            $.ajax({

                xhr: function()
                      {
                        var xhr = new window.XMLHttpRequest();
                        //Upload progress
                        xhr.upload.addEventListener("progress", function(evt){
                          if (evt.lengthComputable) {

                            var ratio = Math.floor((evt.loaded / evt.total) * 100) + '%';
                            $('#progress').css('width', ratio);
                            $('#progress span').html(ratio);

                          }
                        }, false);
                        //Download progress
                        xhr.addEventListener("progress", function(evt){
                          if (evt.lengthComputable) {
                            var ratio = Math.floor((evt.loaded / evt.total) * 100) + '%';
                            $('#progress').css('width', ratio);
                            $('#progress span').html(ratio);
                          }
                        }, false);
                        return xhr;
                      },
                url: $(this).attr('action'),
                type:"POST", 
                data: data,
                dataType:'json',
                async: true,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data){


                        if($.isEmptyObject(data.error)){

                            $("#SuccessModal .feedback-message").html( data.success );
                            $("#SuccessModal").modal("show");

                            $("#AddProjectForm input[name='project_name']").val("");
                            $("#AddProjectForm input[name='project_address']").val("");
                            $("#AddProjectForm input[name='project_price']").val("0");
                            $("#AddProjectForm input[name='amenities_bed']").val("0");
                            $("#AddProjectForm input[name='amenities_bath']").val("0");
                            $("#AddProjectForm input[name='amenities_land_sqm']").val("0");
                            $("#AddProjectForm input[name='amenities_floor_sqm']").val("0");
                            $("#AddProjectForm input[name='amenities_garage']").val("0");
                            $("#AddProjectForm textarea[name='project_description']").val("");
                            $("#AddProjectForm input[name='block_number']").val("0");
                            $("#AddProjectForm input[name='phase_number']").val("0");
                            $("#AddProjectForm input[name='lot_number']").val("0");


                        }else{

                            $(".form-error.project_name").html(data.error['project_name']);
                            $(".form-error.project_address").html(data.error['project_location']);
                            $(".form-error.project_price").html(data.error['project_price']);
                            
                            
                        }                          

                    
                    },
                     error: function (data) {
                            alert(data.status);
                            }

        });

            return false;

        }else{
                $('#AlertModal .modal-message').html( 'Too many files selected. Maximum files to upload is 15.' );
                $('#AlertModal').modal("show");
        }
      });























     $(document).on('click','.showAddDeveloperFormBtn', {} ,function(e){
           
           $("#AddDeveloperModal").modal('show');

      });


      $(document).on('click','.showCropboxModal', {} ,function(e){
           

           $("#CropboxModal .modal-body").attr("id",$(this).attr('id'));
           $("#CropboxModal").modal('show');

      });




    $(document).on({

         mouseenter: function(){

            $(this).find(".project-address").show();
        },

         mouseleave: function(){
             $(this).find(".project-address").hide();

        }
    },'.product-container .item-lower-con');









    $(document).on('click','.setToNotActiveProject', {} ,function(e){

            var title = "SET PROJECT TO NOT ACTIVE";
            var message = "Are you sure you want to set this project to not active ?";

            var reloadList = "projects-list";

            $("#SetToNotActiveCustomModal .modal-title").html( title );
            $("#SetToNotActiveCustomModal .modal-message").html( message );

            $("#SetToNotActiveCustomModal .modal-header").addClass("modal-danger");
            $("#SetToNotActiveCustomModal .action-confirm").addClass("btn-danger");
            $("#SetToNotActiveCustomModal .reloadList").val(reloadList);

            $("#SetToNotActiveCustomModal #SetToNotActiveCustom").attr("action", "/developer/project/SetToNotActive");
            $("#SetToNotActiveCustomModal #SetToNotActiveCustom").attr("method", "POST");

            $("#SetToNotActiveCustomModal .SelectedId").val( $(this).attr("id") );
            $("#SetToNotActiveCustomModal").modal("show");

    });




    $(document).on('click','.setToActiveProject', {} ,function(e){

            var title = "SET PROJECT TO ACTIVE";
            var message = "Are you sure you want to set this project to active ?";

            var reloadList = "projects-list";

            $("#SetToNotActiveCustomModal .modal-title").html( title );
            $("#SetToNotActiveCustomModal .modal-message").html( message );

            $("#SetToNotActiveCustomModal .modal-header").addClass("modal-success");
            $("#SetToNotActiveCustomModal .action-confirm").addClass("btn-success");
            $("#SetToNotActiveCustomModal .reloadList").val(reloadList);

            $("#SetToNotActiveCustomModal #SetToNotActiveCustom").attr("action", "/developer/project/SetToActive");
            $("#SetToNotActiveCustomModal #SetToNotActiveCustom").attr("method", "POST");

            $("#SetToNotActiveCustomModal .SelectedId").val( $(this).attr("id") );
            $("#SetToNotActiveCustomModal").modal("show");

    });







    $(document).on('submit','form#SetToNotActiveCustom', {} ,function(e){
            e.preventDefault();

            var formdata = $(this).serializeArray();

            $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'), 
            data: formdata ,
            success: function(data){    
                
                   if($.isEmptyObject(data.error)){

                        var reloadList = $("#SetToNotActiveCustomModal .reloadList").val();
                        $(".SeletedMenuHeader .SelectedMenuTitle").html(data.menu);


                        $("#" + reloadList).html(data.content);
                        
                        reloadDataTable();

                        $("#SuccessModal .feedback-message").html( data.success );
                        $("#SuccessModal").modal("show");
                        $("#SetToNotActiveCustomModal").modal("hide");

                    }
                
                },
            error: function (data) {
                alert(data.status);
                }

            });

            return false;

    });







    $(document).on('click','.veiwProjectDetails', {} ,function(e){
         e.preventDefault();

        var id = $(this).attr('id');

        $.ajax({
        url: "/developer/project/",
        type:"GET",
        data: { 'id' : id } ,  
        success: function(data){

            $(".view-overlay-content").html(data.content);
            $(".overlay-fullscreen").css("opacity","1");
            $(".overlay-fullscreen").css("z-index","1550");
            
            },
        error: function (data) {
            alert(data.status);
            }
         });

    });



    $(document).on('click','.veiwProjectDetails', {} ,function(e){
         e.preventDefault();

        var id = $(this).attr('id');

        $.ajax({
        url: "/developer/project/",
        type:"GET",
        data: { 'id' : id } ,  
        success: function(data){

            $(".view-overlay-content").html(data.content);
            $(".overlay-fullscreen").css("opacity","1");
            $(".overlay-fullscreen").css("z-index","1550");
            
            },
        error: function (data) {
            alert(data.status);
            }
         });

    });







    $(document).on('click','.updateDeveloperDetails', {} ,function(e){

        var id = $(this).attr('id');
        
        $.ajax({
        url: "/developer/project/update",
        type:"GET", 
        data: { "id": id }, 
        success: function(data){

            $(".view-overlay-content").html(data.content);
            $(".overlay-fullscreen").css("opacity","1");
            $(".overlay-fullscreen").css("z-index","1550");

            $('.summernote').summernote({
                height: 200,
                maxHeight: 278  
              });
            
            },
        error: function (data) {
            alert(data.status);
            }
         });

    });














      $(document).on('click','.addEventShowModal', {} ,function(e){
            e.preventDefault();
            
            $("#AddEventModal input[name='start']").val( moment().format("MM/DD/YYYY hh:mm A") ) ;
            $("#AddEventModal input[name='end']").val( moment().format("MM/DD/YYYY hh:mm A") ) ;
            $("#AddEventModal").modal("show");

      });




      $(document).on('submit','form#addEventForm', {} ,function(e){
            e.preventDefault();


            var formdata = $(this).serializeArray();

            $.ajax({
            url: $(this).attr('action'),
            type:"POST", 
            data: formdata ,
            success: function(data){    
                
                  if($.isEmptyObject(data.error)){

                        $("#AddEventModal").modal("hide");
                        $("#SuccessModal .feedback-message").html( data.success );
                        $("#SuccessModal").modal("show");

                        $("#Event-List").html(data.content);

                        reloadDataTable();

                        $('#calendar').fullCalendar( 'removeEventSource' , data.events);
                        $('#calendar').fullCalendar( 'addEventSource' , data.events);

                    }else{

                        $("#AddEventModal .form-error.title").html("");
                        $("#AddEventModal .form-error.speaker").html("");
                        $("#AddEventModal .form-error.venue").html("");
                        $("#AddEventModal .form-error.start").html("");
                        $("#AddEventModal .form-error.end").html("");
                        $("#AddEventModal .form-error.description").html("");

                        $("#AddEventModal .form-error.title").html(data.error['title']);
                        $("#AddEventModal .form-error.speaker").html(data.error['speaker']);
                        $("#AddEventModal .form-error.venue").html(data.error['venue']);
                        $("#AddEventModal .form-error.start").html(data.error['start']);
                        $("#AddEventModal .form-error.end").html(data.error['end']);
                        $("#AddEventModal .form-error.backgroundColor").html(data.error['backgroundColor']);
                        $("#AddEventModal .form-error.textColor").html(data.error['textColor']);
                        $("#AddEventModal .form-error.description").html(data.error['description']);
                    }      

                
                },
            error: function (data) {
                alert(data.status);
                }

            });

            return false;
      });











      $(document).on('submit','form#updateEventForm', {} ,function(e){
           e.preventDefault();  

          var formdata = $(this).serializeArray();

          $.ajax({
                url: "/event/update",
                type:"POST", 
                data: formdata ,
                success: function(data){    
                    
                      if($.isEmptyObject(data.error)){

                            $("#AddEventModal").modal("hide");
                            $("#SuccessModal .feedback-message").html( data.success );
                            $("#SuccessModal").modal("show");
                            $("#EventActionModal").modal("hide");

                            $("#Event-List").html(data.content);

                            $('#calendar').fullCalendar( 'removeEventSource' , data.events);
                            $('#calendar').fullCalendar( 'addEventSource' , data.events);

                        }else{

                            $("#EventActionModal .form-error.title").html("");
                            $("#EventActionModal .form-error.speaker").html("");
                            $("#EventActionModal .form-error.venue").html("");
                            $("#EventActionModal .form-error.start").html("");
                            $("#EventActionModal .form-error.end").html("");
                            $("#EventActionModal .form-error.description").html("");

                            $("#EventActionModal .form-error.title").html(data.error['title']);
                            $("#EventActionModal .form-error.speaker").html(data.error['speaker']);
                            $("#EventActionModal .form-error.venue").html(data.error['venue']);
                            $("#EventActionModal .form-error.start").html(data.error['start']);
                            $("#EventActionModal .form-error.end").html(data.error['end']);
                            $("#EventActionModal .form-error.backgroundColor").html(data.error['backgroundColor']);
                            $("#EventActionModal .form-error.textColor").html(data.error['textColor']);
                            $("#EventActionModal .form-error.description").html(data.error['description']);
                        }      

                    
                    },
                error: function (data) {
                    alert(data.status);
                    }

                });

      });














    $(document).on('click','.cancelEventBtn', {} ,function(e){
            e.preventDefault();  

            var title = "CANCEL EVENT";
            var message = "Are you sure you want to cancel this event ?";

            var reloadList = "Event-List";

            $("#SetToNotActiveCustomModal .modal-title").html( title );
            $("#SetToNotActiveCustomModal .modal-message").html( message );

            $("#SetToNotActiveCustomModal .modal-header").removeClass("modal-success");
            $("#SetToNotActiveCustomModal .action-confirm").removeClass("btn-success");
            $("#SetToNotActiveCustomModal .modal-header").addClass("modal-danger");
            $("#SetToNotActiveCustomModal .action-confirm").addClass("btn-danger");
            $("#SetToNotActiveCustomModal .reloadList").val(reloadList);

            $("#SetToNotActiveCustomModal #SetToNotActiveCustom").attr("action", "/event/cancel");
            $("#SetToNotActiveCustomModal #SetToNotActiveCustom").attr("method", "POST");

            $("#SetToNotActiveCustomModal .SelectedId").val( $(this).attr("id") );
            $("#SetToNotActiveCustomModal").modal("show");
             $("#EventActionModal").modal("hide");

    });




    $(document).on('click','.resumeEventBtn', {} ,function(e){

            var title = "RE OPEN EVENT";
            var message = "Are you sure you want to re open this event ?";

            var reloadList = "Event-List";

            $("#SetToNotActiveCustomModal .modal-title").html( title );
            $("#SetToNotActiveCustomModal .modal-message").html( message );

            $("#SetToNotActiveCustomModal .modal-header").removeClass("modal-danger");
            $("#SetToNotActiveCustomModal .action-confirm").removeClass("btn-danger");
            $("#SetToNotActiveCustomModal .modal-header").addClass("modal-success");
            $("#SetToNotActiveCustomModal .action-confirm").addClass("btn-success");
            $("#SetToNotActiveCustomModal .reloadList").val(reloadList);

            $("#SetToNotActiveCustomModal #SetToNotActiveCustom").attr("action", "/event/resume");
            $("#SetToNotActiveCustomModal #SetToNotActiveCustom").attr("method", "POST");

            $("#SetToNotActiveCustomModal .SelectedId").val( $(this).attr("id") );
            $("#SetToNotActiveCustomModal").modal("show");
             $("#EventActionModal").modal("hide");

    });







      $(document).on('click','.updateEventShowModal', {} ,function(e){
      
        $.ajax({
                url: '/event',
                type:"GET", 
                data: { "id":  $(this).attr('id') },
                success: function(data){    
                    
                    if( data.cancelled ){
                        $("#EventActionModal .cancelEventBtn").hide();
                        $("#EventActionModal .resumeEventBtn").show();
                    }else{
                        $("#EventActionModal .resumeEventBtn").hide();
                         $("#EventActionModal .cancelEventBtn").show();
                    }
                    $("#EventActionModal .resumeEventBtn").attr( 'id', data.id );
                    $("#EventActionModal .cancelEventBtn").attr( 'id', data.id );
                    $("#EventActionModal input[name='id']").val( data.id );
                    $("#EventActionModal input[name='speaker']").val( data.speaker );
                    $("#EventActionModal input[name='venue']").val( data.venue );
                    $("#EventActionModal input[name='start']").val( moment( data.start ).format('MM/DD/YYYY hh:mm A') );
                    $("#EventActionModal input[name='end']").val( moment( data.end ).format('MM/DD/YYYY hh:mm A') );
                    $("#EventActionModal input[name='title']").val( data.title ); 
                    $("#EventActionModal input[name='backgroundColor']").val( data.backgroundColor ); 
                    $("#EventActionModal input[name='textColor']").val( data.textColor ); 
                    $("#EventActionModal textarea[name='description']").html( data.description );
                   

                    $("#EventActionModal").modal("show");
                },
                error: function (data) {
                    alert(data.status);
                    }

            });
        

      });










      $(document).on('submit','form#ImportExcelUserForm', {} ,function(e){
        e.preventDefault(); 


        var data = new FormData(this);

        $.ajax({

            xhr: function()
                      {
                        var xhr = new window.XMLHttpRequest();
                        //Upload progress
                        xhr.upload.addEventListener("progress", function(evt){
                          if (evt.lengthComputable) {

                            var ratio = Math.floor((evt.loaded / evt.total) * 100) + '%';
                            $('#ImportUserExcelModal #progress').css('width', ratio);
                            $('#ImportUserExcelModal #progress span').html(ratio);

                          }
                        }, false);
                        //Download progress
                        xhr.addEventListener("progress", function(evt){
                          if (evt.lengthComputable) {
                            var ratio = Math.floor((evt.loaded / evt.total) * 100) + '%';
                            $('#ImportUserExcelModal #progress').css('width', ratio);
                            $('#ImportUserExcelModal #progress span').html(ratio);
                          }
                        }, false);
                        return xhr;
                      },
            url: "/users/import",
            type: "POST", 
            data: data,
            async: true, 
            success: function(data){    

                   if($.isEmptyObject(data.error)){

                        $("#user-list").html(data.content);
                        $("#SuccessModal .feedback-message").html( data.success );
                        $("#SuccessModal").modal("show");
                        $("#ImportUserExcelModal").modal("hide");

                        reloadDataTable();

                        $('#ImportUserExcelModal #progress').css('width', "0%");
                        $('#ImportUserExcelModal #progress span').html("0%");

                    }else{

                        $("#AlertModal .modal-message").html(data.error);
                        $("#AlertModal").modal("show");
                        $("#ImportUserExcelModal").modal("hide");
                    }
                
                },
                cache: false,
                contentType: false,
                processData: false

            });

            return false;
        
      });
        













      $(document).on('submit','form#projectTypeForm', {} ,function(e){
        e.preventDefault(); 

          var data = $(this).serializeArray();

        $.ajax({

            url: $(this).attr('action'),
            type: $(this).attr('method'), 
            data: data,
            success: function(data){    
                    $("#projects").html(data.content);
                }

            });

            return false;
        
      });






      $(document).on('submit','form#addProjectTypeForm', {} ,function(e){
        e.preventDefault(); 

          var data = $(this).serializeArray();

        $.ajax({

            url: $(this).attr('action'),
            type: $(this).attr('method'), 
            data: data,
            success: function(data){ 


                 if($.isEmptyObject(data.error)){

                        $("#ProjectType-List").html(data.content);
                        $("#SuccessModal .feedback-message").html( data.success );
                        $("#SuccessModal").modal("show");

                        $("#addProjectTypeForm .form-error.type").html("");
                        $("#addProjectTypeForm input[name='type']").val("");

                       reloadDataTable();


                    }else{

                        $("#AlertModal .modal-message").html(data.error['type']);
                        $("#AlertModal").modal("show"); 

                    }

                    
                }

            });

            return false;
        
      });





      $(document).on('click','#ProjectType-List tr.data', {} ,function(e){

        var projectId = $(this).attr('id');
        
        $("#updateProjectTypeForm").show();
        $("#deleteProjectTypeForm input[name='id']").val( projectId );
        $("#undeleteProjectTypeForm input[name='id']").val( projectId );
        $("#updateProjectTypeForm input[name='id']").val( projectId );
        $("#updateProjectTypeForm input[name='type']").val( $("#ProjectType-List tr#"+projectId+" td.project-type-data").html() );
        

      });






      $(document).on('submit','form#updateProjectTypeForm', {} ,function(e){
        e.preventDefault(); 

        var data = $(this).serializeArray();

        $.ajax({

            url: $(this).attr('action'),
            type: $(this).attr('method'), 
            data: data,
            success: function(data){ 

                 if($.isEmptyObject(data.error)){

                        $("#ProjectType-List").html(data.content);
                        $("#SuccessModal .feedback-message").html( data.success );
                        $("#SuccessModal").modal("show");

                        $("#updateProjectTypeForm input[name='type']").val("");

                        reloadDataTable();

                        $("#updateProjectTypeForm").hide();


                    }else{

                        $("#AlertModal .modal-message").html(data.error['type']);
                        $("#AlertModal").modal("show"); 

                    }

                    
                }

            });

            return false;
        
      });










    $(document).on('click','.actionDeleteProjectType', {} ,function(e){
            e.preventDefault();  

            var title = "SET PROJECT TYPE TO NOT ACTIVE";
            var message = "Are you sure you want to set this type to not active ?";

            var reloadList = "ProjectType-List";

            $("#SetToNotActiveCustomModal .modal-title").html( title );
            $("#SetToNotActiveCustomModal .modal-message").html( message );

            $("#SetToNotActiveCustomModal .modal-header").removeClass("modal-success");
            $("#SetToNotActiveCustomModal .action-confirm").removeClass("btn-success");
            $("#SetToNotActiveCustomModal .modal-header").addClass("modal-danger");
            $("#SetToNotActiveCustomModal .action-confirm").addClass("btn-danger");
            $("#SetToNotActiveCustomModal .reloadList").val(reloadList);

            $("#SetToNotActiveCustomModal #SetToNotActiveCustom").attr("action", "/developers/projects/type/delete");
            $("#SetToNotActiveCustomModal #SetToNotActiveCustom").attr("method", "POST");

            $("#SetToNotActiveCustomModal .SelectedId").val( $(this).attr("id") );
            $("#SetToNotActiveCustomModal").modal("show");

    });




    $(document).on('click','.actionUnDeleteProjectType', {} ,function(e){

            var title = "SET PROJECT TYPE TO ACTIVE";
            var message = "Are you sure you want to re open this event ?";

            var reloadList = "ProjectType-List";

            $("#SetToNotActiveCustomModal .modal-title").html( title );
            $("#SetToNotActiveCustomModal .modal-message").html( message );

            $("#SetToNotActiveCustomModal .modal-header").removeClass("modal-danger");
            $("#SetToNotActiveCustomModal .action-confirm").removeClass("btn-danger");
            $("#SetToNotActiveCustomModal .modal-header").addClass("modal-success");
            $("#SetToNotActiveCustomModal .action-confirm").addClass("btn-success");
            $("#SetToNotActiveCustomModal .reloadList").val(reloadList);

            $("#SetToNotActiveCustomModal #SetToNotActiveCustom").attr("action", "/developers/projects/type/undelete");
            $("#SetToNotActiveCustomModal #SetToNotActiveCustom").attr("method", "POST");

            $("#SetToNotActiveCustomModal .SelectedId").val( $(this).attr("id") );
            $("#SetToNotActiveCustomModal").modal("show");

    });








      $(document).on('click','#agent-ranks-table tr.data', {} ,function(e){

        var rankId = $(this).attr('id');

            $.ajax({
            url: "/agent/rank",
            type:"GET", 
            data: { "id": rankId }, 
            success: function(data){

                    $("#updateAgentRankTypeForm .form-error.rank").html("");
                    $("#updateAgentRankTypeForm .form-error.description").html("");
                    $("#updateAgentRankTypeForm .form-error.commission_rate").html("");



                    $("#updateAgentRankTypeForm .selectedAgentRankTypeId").val( rankId );
                    $("#updateAgentRankTypeForm input[name='rank']").val( data.rank );
                    $("#updateAgentRankTypeForm input[name='description']").val( data.description );
                    $("#updateAgentRankTypeForm input[name='commission_rate']").val( data.commission_rate );
                
                },
            error: function (data) {
                alert(data.status);
                }
             });



      });








      $(document).on('submit','form#updateAgentRankTypeForm', {} ,function(e){
        e.preventDefault(); 

            var formdata = $(this).serializeArray();

            $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'), 
            data: formdata, 
            success: function(data){

                    if($.isEmptyObject(data.error)){

                        $("#Agent_Rank_list").html(data.content);
                        $("#SuccessModal .feedback-message").html( data.success );
                        $("#SuccessModal").modal("show");

                        reloadDataTable();

                        $("#updateAgentRankTypeForm .form-control").val("");
                        $("#updateAgentRankTypeForm .form-error").html("");


                    }else{

                        $("#updateAgentRankTypeForm .form-error").html("");

                        $("#updateAgentRankTypeForm .form-error.rank").html(data.error['rank']);
                        $("#updateAgentRankTypeForm .form-error.description").html(data.error['description']);
                        $("#updateAgentRankTypeForm .form-error.commission_rate").html(data.error['commission_rate']);


                    }
                
                },
            error: function (data) {
                alert(data.status);
                }
             });



      });







     $(document).on('focus','#recruiter_name', {} ,function(e){


        $("#SelectRecruiterModal").modal('show');

     });






     $(document).on('submit','form#searchAgent', {} ,function(e){
        e.preventDefault();

        var formdata = $(this).serializeArray();


        $.ajax({
            url: "/agent/search",
            type:"GET",  
            data : formdata ,
            success: function(data){

                $("#recruiter-query-result").html(data.content);


                },
            error: function (data) {
                alert(data.status);
                }
        });

     });




     $(document).on('change','#search_recuiter', {} ,function(e){
        e.preventDefault();


        var key = $(this).val();

            $.ajax({
                url: "/agent/search",
                type:"GET",  
                data : { 'key' : key } ,
                success: function(data){

                    $("#recruiter-query-result").html(data.content);


                    },
                error: function (data) {
                    alert(data.status);
                    }
            });

     });


     $(document).on('click','#recruiter-list li', {} ,function(e){
        e.preventDefault();

        $("#selectedRecruiter-con input[name='selectedRecruiter-rank']").val( $(this).attr('rank') );
        $("#selectedRecruiter-con input[name='selectedRecruiter']").val( $(this).html() );
        $("#selectedRecruiter-con input[name='selectedRecruiter']").attr( 'id',  $(this).attr('id') );

     });





     $(document).on('click','#AddRecruiterToInput', {} ,function(e){
        e.preventDefault();
        
        if( ( $("#selectedRecruiter-con input[name='selectedRecruiter']").val() != "" ) ){

            $("input[name='recruiter_rank']").val( $("#selectedRecruiter-con input[name='selectedRecruiter-rank']").val() );
            $("input[name='recruiter_name']").val( $("#selectedRecruiter-con input[name='selectedRecruiter']").val() );
            $("input[name='recruiter']").val( $("#selectedRecruiter-con input[name='selectedRecruiter']").attr('id') );
            
            alert( $("input[name='recruiter']").val() );

            $("#SelectRecruiterModal").modal('hide');

        }else{

             $("#AlertModal .modal-message").html("Please select recruiter.");
             $("#AlertModal").modal("show"); 

        }

     });









     $(document).on('focus','#agent_name', {} ,function(e){


        $("#SelectAgentModal").modal('show');

     });




     $(document).on('change','#agent_name', {} ,function(e){
        e.preventDefault();


        var key = $(this).val();

            $.ajax({
                url: "/agent/search",
                type:"GET",  
                data : { 'key' : key } ,
                success: function(data){

                    $("#recruiter-query-result").html(data.content);


                    },
                error: function (data) {
                    alert(data.status);
                    }
            });

     });




     $(document).on('click','#AddAgentToInput', {} ,function(e){
        e.preventDefault();
        
        if(  $("#selectedRecruiter-con input[name='selectedRecruiter']").val() != "" ){

            $("input[name='agent_rank']").val( $("#selectedRecruiter-con input[name='selectedRecruiter-rank']").val() );
            $("input[name='agent_name']").val( $("#selectedRecruiter-con input[name='selectedRecruiter']").val() );
            $("input[name='agent']").val( $("#selectedRecruiter-con input[name='selectedRecruiter']").attr('id') );
            $("#SelectAgentModal").modal('hide');

        }else{

             $("#AlertModal .modal-message").html("Please select recruiter.");
             $("#AlertModal").modal("show"); 

        }

     });








     $(document).on('focus','#developer_name', {} ,function(e){


        $("#SelectProjectDeveloperModal").modal('show');

     });






     $(document).on('submit','form#searchDeveloper', {} ,function(e){
        e.preventDefault();

        var formdata = $(this).serializeArray();


        $.ajax({
            url: "/developer/search",
            type:"GET",  
            data : formdata ,
            success: function(data){

                $("#developer-query-result").html(data.content);


                },
            error: function (data) {
                alert(data.status);
                }
        });

     });




     $(document).on('change','#search_developer', {} ,function(e){
        e.preventDefault();


        var key = $(this).val();

            $.ajax({
                url: "/developer/search",
                type:"GET",  
                data : { 'key' : key } ,
                success: function(data){

                    $("#developer-query-result").html(data.content);


                    },
                error: function (data) {
                    alert(data.status);
                    }
            });

     });




     $(document).on('click','#developer-list li', {} ,function(e){
        e.preventDefault();


        $("#selectedDeveloper-con input[name='selectedDeveloper']").val( $(this).html() );
        $("#selectedDeveloper-con input[name='selectedDeveloper']").attr( 'id',  $(this).attr('id') );


        var key = $(this).attr('id');

        $.ajax({
            url: "/project/getProjectById",
            type:"GET",  
            data : { 'key' : key } ,
            success: function(data){

                $("#project-query-result").html(data.content);


                },
            error: function (data) {
                alert(data.status);
                }
        });


     });







     $(document).on('focus','#project_name', {} ,function(e){


        $("#SelectProjectDeveloperModal").modal('show');

     });





     $(document).on('submit','form#searchProject', {} ,function(e){
        e.preventDefault();

        var formdata = $(this).serializeArray();

        $.ajax({
            url: "/project/search",
            type:"GET",  
            data : formdata ,
            success: function(data){

                $("#project-query-result").html(data.content);


                },
            error: function (data) {
                alert(data.status);
                }
        });

     });




     $(document).on('change','#search_project', {} ,function(e){
        e.preventDefault();


            var key = $(this).val();

            $.ajax({
                url: "/project/search",
                type:"GET",  
                data : { 'key' : key } ,
                success: function(data){

                    $("#project-query-result").html(data.content);


                    },
                error: function (data) {
                    alert(data.status);
                    }
            });

     });






     $(document).on('click','#project-list li', {} ,function(e){
        e.preventDefault();


        $("#selectedProject-con input[name='selectedProject']").val( $(this).html() );
        $("#selectedProject-con input[name='selectedProject']").attr( 'id',  $(this).attr('id') );
        $("#selectedProject-con input[name='selectedProject']").attr( 'location',  $(this).attr('location') );
        $("#selectedProject-con input[name='selectedProject']").attr( 'price',  $(this).attr('price') );

            
        var key = $(this).attr('developer');

        $.ajax({
            url: "/developer/getDeveloperById",
            type:"GET",  
            data : { 'key' : key } ,
            success: function(data){

                $("#developer-query-result").html(data.content);


                },
            error: function (data) {
                alert(data.status);
                }
        });

     });









     $(document).on('click','#AddProjectDeveloperToInput', {} ,function(e){
        e.preventDefault();


        $("#project_name").val( $("#selectedProject-con input[name='selectedProject']").val() );
        $("#project").val( $("#selectedProject-con input[name='selectedProject']").attr('id') );
        $("#project_location").val( $("#selectedProject-con input[name='selectedProject']").attr('location') );
        $("#project_price").val( $("#selectedProject-con input[name='selectedProject']").attr('price') );


        $("#developer_name").val( $("#selectedDeveloper-con input[name='selectedDeveloper']").val() );
        $("#developer").val( $("#selectedDeveloper-con input[name='selectedDeveloper']").attr('id') );


        $("#SelectProjectDeveloperModal").modal('hide');


     });





     $(document).on('submit','form#addSalesForm', {} ,function(e){
        e.preventDefault();

         var formdata = $(this).serializeArray();

         $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),  
            data : formdata ,
            success: function(data){

               if($.isEmptyObject(data.error)){

                        $("#SuccessModal .feedback-message").html( data.success );
                        $("#SuccessModal").modal("show");
                        $("#addSalesForm .form-control").val("");
                        $("#addSalesForm .form-error").html("");


                }else{

                    $("#addSalesForm .form-error").html("");

                    $("#addSalesForm .form-error.lastname").html(data.error['lastname']);
                    $("#addSalesForm .form-error.firstname").html(data.error['firstname']);
                    $("#addSalesForm .form-error.middlename").html(data.error['middlename']);
                    $("#addSalesForm .form-error.datebirth").html(data.error['datebirth']);
                    $("#addSalesForm .form-error.email").html(data.error['email']);
                    $("#addSalesForm .form-error.contact").html(data.error['contact']);

                    $("#addSalesForm .form-error.agent").html(data.error['agent']);
                    $("#addSalesForm .form-error.date_reserve").html(data.error['date_reserve']);
                    $("#addSalesForm .form-error.developer_name").html(data.error['developer_name']);
                    $("#addSalesForm .form-error.project").html(data.error['project']);
                    $("#addSalesForm .form-error.project_price").html(data.error['project_price']);


                }


            },
            error: function (data) {
                alert(data.status);
                }
        });


     });














     $(document).on('submit','form#updateSalesForm', {} ,function(e){
        e.preventDefault();

         var formdata = $(this).serializeArray();

         $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),  
            data : formdata ,
            success: function(data){

               if($.isEmptyObject(data.error)){

                        $("#sales-list").html(data.content);
                        $("#SuccessModal .feedback-message").html( data.success );
                        $("#SuccessModal").modal("show");
                        $(".overlay-fullscreen").css("opacity","0");
                        $(".overlay-fullscreen").css("z-index","0");

                       reloadDataTable();

                }else{

                    $("#updateSalesForm .form-error").html("");

                    $("#updateSalesForm .form-error.lastname").html(data.error['lastname']);
                    $("#updateSalesForm .form-error.firstname").html(data.error['firstname']);
                    $("#updateSalesForm .form-error.middlename").html(data.error['middlename']);
                    $("#updateSalesForm .form-error.datebirth").html(data.error['datebirth']);
                    $("#updateSalesForm .form-error.email").html(data.error['email']);
                    $("#updateSalesForm .form-error.contact").html(data.error['contact']);

                    $("#updateSalesForm .form-error.agent").html(data.error['agent']);
                    $("#updateSalesForm .form-error.date_reserve").html(data.error['date_reserve']);
                    $("#updateSalesForm .form-error.developer_name").html(data.error['developer_name']);
                    $("#updateSalesForm .form-error.project").html(data.error['project']);
                    $("#updateSalesForm .form-error.project_price").html(data.error['project_price']);


                }


            },
            error: function (data) {
                alert(data.status);
                }
        });


     });















     $(document).on('submit','form#registerNewUserForm', {} ,function(e){
        e.preventDefault();

        
         var data = new FormData(this);

         $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),  
            data : data ,
            async: true, 
            success: function(data){

               if($.isEmptyObject(data.error)){

                        $("#SuccessModal .feedback-message").html( data.success );
                        $("#SuccessModal").modal("show");
                        $("#registerNewUserForm .form-control").val("");
                        $("#registerNewUserForm .form-error").html("");


                }else{

                    $("#registerNewUserForm .form-error").html("");

                    $("#registerNewUserForm .form-error.email").html(data.error['email']);
                    $("#registerNewUserForm .form-error.password").html(data.error['password']);
                    $("#registerNewUserForm .form-error.password_confirmation").html(data.error['password_confirmation']);
                    $("#registerNewUserForm .form-error.recruiter").html(data.error['recruiter']);
                    $("#registerNewUserForm .form-error.lastname").html(data.error['lastname']);
                    $("#registerNewUserForm .form-error.firstname").html(data.error['firstname']);
                    $("#registerNewUserForm .form-error.middlename").html(data.error['middlename']);
                    $("#registerNewUserForm .form-error.datebirth").html(data.error['datebirth']);


                }


            },
            error: function (data) {
                alert(data.status);
                },
            cache: false,
            contentType: false,
            processData: false
        });


     });





     $(document).on('submit','form#searchProjectForm', {} ,function(e){
        e.preventDefault();

        
         var data = $(this).serializeArray();

         $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),  
            data : data ,
            success: function(data){

               $("#projects-list").html(data.content);


            },
            error: function (data) {
                alert(data.status);
                }
        });


     });





    $(document).on('click','.updateSalesShowForm', {} ,function(e){

            var userid = $(this).attr('id');
            
            $.ajax({
            url: "/sales/update",
            type:"GET", 
            data: {"id":userid}, 
            success: function(data){

                $(".view-overlay-content").html(data.content);
                $(".overlay-fullscreen").css("opacity","1");
                $(".overlay-fullscreen").css("z-index","1550");
                    
                    $('.datepicker').datetimepicker({
                        viewMode: 'years',
                        format: 'YYYY/MM/DD',
                        maxDate: moment().subtract(18, 'years').startOf('year'),
                        minDate: moment().subtract(60, 'years').startOf('year')
                    });

                    $('.datepicker-inline').datetimepicker({
                        viewMode: 'months',
                        format: 'YYYY/MM/DD',
                        maxDate: moment(),
                        minDate: moment().subtract(60, 'years').startOf('year')
                    });

                },
            error: function (data) {
                alert(data.status);
                }
             });

        });






     $(document).on('click','.updateClientShowForm', {} ,function(e){
        e.preventDefault();

        
         var clientId = $(this).attr('id');


         $.ajax({
            url: "/client",
            type: "GET",  
            data : { 'id' : clientId } ,
            success: function(data){

                $("#updateClientForm .form-control").val("");
                $("#updateClientForm .form-error").html("");
                $("#UpdateClientModal select[name='gender'] option").removeAttr('selected');

                $("#UpdateClientModal input[name='id']").val( data.id );
                $("#UpdateClientModal input[name='lastname']").val( data.lastname );
                $("#UpdateClientModal input[name='firstname']").val( data.firstname );
                $("#UpdateClientModal input[name='middlename']").val( data.middlename );
                $("#UpdateClientModal input[name='datebirth']").val( data.datebirth );
                $("#UpdateClientModal select[name='gender'] option[value='" + data.gender + "']").attr('selected','selected');
                $("#UpdateClientModal input[name='email']").val( data.email );
                $("#UpdateClientModal input[name='contact']").val( data.contact_number );


               $("#UpdateClientModal").modal("show");


            },
            error: function (data) {
                alert(data.status);
                }
        });


     });







     $(document).on('submit','form#updateClientForm', {} ,function(e){
        e.preventDefault();

        
         var data = $(this).serializeArray();


         $.ajax({
            url: "/client/update",
            type: "POST",  
            data : data,
            success: function(data){

                if($.isEmptyObject(data.error)){


                        $("#client-list").html(data.content);
                        $("#UpdateClientModal").modal("hide");
                        $("#SuccessModal .feedback-message").html( data.success );
                        $("#SuccessModal").modal("show");
                        $("#updateClientForm .form-control").val("");
                        $("#updateClientForm .form-error").html("");

                        reloadDataTable();


                }else{

                    $("#updateClientForm .form-error").html("");

                    $("#updateClientForm .form-error.email").html(data.error['email']);
                    $("#updateClientForm .form-error.contact").html(data.error['contact']);
                    $("#updateClientForm .form-error.lastname").html(data.error['lastname']);
                    $("#updateClientForm .form-error.firstname").html(data.error['firstname']);
                    $("#updateClientForm .form-error.middlename").html(data.error['middlename']);
                    $("#updateClientForm .form-error.datebirth").html(data.error['datebirth']);
                    $("#updateClientForm .form-error.gender").html(data.error['gender']);


                }


            },
            error: function (data) {
                alert(data.status);
                }
        });


     });







    $(document).on('click','.cancelSalesBtn', {} ,function(e){
            e.preventDefault();  

            var title = "CANCEL SALES";
            var message = "Are you sure you want to cancel this sales ?";

            var reloadList = "sales-list";

            $("#SetToNotActiveCustomModal .modal-title").html( title );
            $("#SetToNotActiveCustomModal .modal-message").html( message );

            $("#SetToNotActiveCustomModal .modal-header").removeClass("modal-success");
            $("#SetToNotActiveCustomModal .action-confirm").removeClass("btn-success");
            $("#SetToNotActiveCustomModal .modal-header").addClass("modal-danger");
            $("#SetToNotActiveCustomModal .action-confirm").addClass("btn-danger");
            $("#SetToNotActiveCustomModal .reloadList").val(reloadList);

            $("#SetToNotActiveCustomModal #SetToNotActiveCustom").attr("action", "/sales/cancel");
            $("#SetToNotActiveCustomModal #SetToNotActiveCustom").attr("method", "POST");

            $("#SetToNotActiveCustomModal .SelectedId").val( $(this).attr("id") );
            $("#SetToNotActiveCustomModal").modal("show");

    });




    $(document).on('click','.unCancelSalesBtn', {} ,function(e){

            var title = "UNCANCEL SALES";
            var message = "Are you sure you want to un cancel this sales ?";

            var reloadList = "sales-list";

            $("#SetToNotActiveCustomModal .modal-title").html( title );
            $("#SetToNotActiveCustomModal .modal-message").html( message );

            $("#SetToNotActiveCustomModal .modal-header").removeClass("modal-danger");
            $("#SetToNotActiveCustomModal .action-confirm").removeClass("btn-danger");
            $("#SetToNotActiveCustomModal .modal-header").addClass("modal-success");
            $("#SetToNotActiveCustomModal .action-confirm").addClass("btn-success");
            $("#SetToNotActiveCustomModal .reloadList").val(reloadList);

            $("#SetToNotActiveCustomModal #SetToNotActiveCustom").attr("action", "/sales/uncancel");
            $("#SetToNotActiveCustomModal #SetToNotActiveCustom").attr("method", "POST");

            $("#SetToNotActiveCustomModal .SelectedId").val( $(this).attr("id") );
            $("#SetToNotActiveCustomModal").modal("show");

    });



    $(document).on('click','.approveSalesBtn', {} ,function(e){

            var title = "APPROVE SALES";
            var message = "Are you sure you want to approve this sales ?";

            var reloadList = "sales-list";

            $("#SetToNotActiveCustomModal .modal-title").html( title );
            $("#SetToNotActiveCustomModal .modal-message").html( message );

            $("#SetToNotActiveCustomModal .modal-header").removeClass("modal-danger");
            $("#SetToNotActiveCustomModal .action-confirm").removeClass("btn-danger");
            $("#SetToNotActiveCustomModal .modal-header").addClass("modal-success");
            $("#SetToNotActiveCustomModal .action-confirm").addClass("btn-success");
            $("#SetToNotActiveCustomModal .reloadList").val(reloadList);

            $("#SetToNotActiveCustomModal #SetToNotActiveCustom").attr("action", "/sales/approve");
            $("#SetToNotActiveCustomModal #SetToNotActiveCustom").attr("method", "POST");

            $("#SetToNotActiveCustomModal .SelectedId").val( $(this).attr("id") );
            $("#SetToNotActiveCustomModal").modal("show");

    });






    $(document).on('click','.viewSalesDetails', {} ,function(e){

            var userid = $(this).attr('id');
            
            $.ajax({
            url: "/sales/details",
            type:"GET", 
            data: {"id":userid}, 
            success: function(data){

                $(".view-overlay-content").html(data.content);
                $(".overlay-fullscreen").css("opacity","1");
                $(".overlay-fullscreen").css("z-index","1550");
                    
                 

                },
            error: function (data) {
                alert(data.status);
                }
             });

        });








    $(document).on('click','.salesBtnForApprovalList', {} ,function(e){


            $.ajax({
            url: "/sales/pending",
            type:"GET", 
            success: function(data){

                $(".SeletedMenuHeader .SelectedMenuTitle").html(data.menu);
                $("#sales-list").html(data.content);  

                reloadDataTable();

                },
            error: function (data) {
                alert(data.status);
                }
             });

    });





        $(document).on('click','.salesBtnCancelledList', {} ,function(e){
            
            $.ajax({
            url: "/sales/cancelled",
            type:"GET", 
            success: function(data){

                $(".SeletedMenuHeader .SelectedMenuTitle").html(data.menu);
                $("#sales-list").html(data.content); 

                reloadDataTable();

                },
            error: function (data) {
                alert(data.status);
                }
             });

    });







        $(document).on('click','.salesBtnShowList', {} ,function(e){

            $.ajax({
            url: "/sales/approved",
            type:"GET",  
            success: function(data){

                $(".SeletedMenuHeader .SelectedMenuTitle").html(data.menu);
                $("#sales-list").html(data.content);   

                reloadDataTable();
              

                },
            error: function (data) {
                alert(data.status);
                }
             });

    });
























    $(document).on('click','.data-table-list tr.data', {} ,function(e){

        $(".data-table-list tr.data").removeClass('active');
        $(this).addClass('active');

      
    });





    $(document).on('click','.logout', {} ,function(e){
            e.preventDefault();  

            $("#logOutModal").modal("show");

    });






















    $('#calendar').fullCalendar({
        theme: true,
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },
        defaultDate: new Date(),
        navLinks: true, // can click day/week names to navigate views
        selectable: true,
        selectHelper: true,
        dayClick: function( date, jsEvent, view ) {

             $("#AddEventModal input[name='start']").val( moment( date ).format('MM/DD/YYYY hh:mm A') );
             $("#AddEventModal input[name='end']").val( moment( date ).format('MM/DD/YYYY hh:mm A') );
             $("#AddEventModal").modal("show");
        },
        eventClick: function( calEvent, JsEvent, view){


            $.ajax({
                url: '/event',
                type:"GET", 
                data: { "id": calEvent.id },
                success: function(data){    
                    
                    if( data.status == "cancelled" ){
                        $("#EventActionModal .cancelEventBtn").hide();
                        $("#EventActionModal .resumeEventBtn").show();
                    }else{
                        $("#EventActionModal .resumeEventBtn").hide();
                         $("#EventActionModal .cancelEventBtn").show();
                    }
                    $("#EventActionModal .resumeEventBtn").attr( 'id', data.id );
                    $("#EventActionModal .cancelEventBtn").attr( 'id', data.id );
                    $("#EventActionModal input[name='id']").val( data.id );
                    $("#EventActionModal input[name='start']").val( moment( data.start ).format('MM/DD/YYYY hh:mm A') );
                    $("#EventActionModal input[name='end']").val( moment( data.end ).format('MM/DD/YYYY hh:mm A') );
                    $("#EventActionModal input[name='title']").val( data.title ); 
                    $("#EventActionModal input[name='speaker']").val( data.speaker ); 
                    $("#EventActionModal input[name='venue']").val( data.venue ); 
                    $("#EventActionModal input[name='backgroundColor']").val( data.backgroundColor ); 
                    $("#EventActionModal input[name='textColor']").val( data.textColor ); 
                    $("#EventActionModal textarea[name='description']").html( data.description );
                   

                    $("#EventActionModal").modal("show");
                },
                error: function (data) {
                    alert(data.status);
                    }

            });

        
        },
        editable: false,
        eventLimit: true, // allow "more" link when too many events
        eventRender : function( event , element ){

            element.attr('id', event.id);


        }
        
    });











    $.ajax({
        url: '/events/fetch',
        type:"GET", 
        success: function(data){    
            
             $('#calendar').fullCalendar( 'addEventSource' , data.events);

        },
        error: function (data) {
            alert(data.status);
            }

    });










        $(".data-table-list").DataTable({
            "scrollY":        "350px",
            "scrollCollapse": true,
            drawCallback: function(settings) {
                var pagination = $(this).closest('.dataTables_wrapper').find('.dataTables_paginate');
                pagination.toggle(this.api().page.info().pages > 1);
              }
        });


        $(".alert-dismissible").fadeTo(2000, 500).slideUp(500, function(){
            $(".alert-dismissible").slideUp(500);
        });





        //plugin bootstrap minus and plus
        //http://jsfiddle.net/laelitenetwork/puJ6G/
        $(document).on('click','.btn-number', {} ,function(e){
            e.preventDefault();
            
            fieldName = $(this).attr('data-field');
            type      = $(this).attr('data-type');
            var input = $("input[name='"+fieldName+"']");
            var currentVal = parseInt(input.val());

            if (!isNaN(currentVal)) {
                if(type == 'minus') {
                    
                    if(currentVal > input.attr('min')) {
                        input.val(currentVal - 1).change();
                    } 
                    if(parseInt(input.val()) == input.attr('min')) {
                        $(this).attr('disabled', true);
                    }

                } else if(type == 'plus') {

                    if(currentVal < input.attr('max')) {
                        input.val(currentVal + 1).change();
                    }
                    if(parseInt(input.val()) == input.attr('max')) {
                        $(this).attr('disabled', true);
                    }

                }
            } else {
                input.val(0);
            }
        });


        $('.input-number').focusin(function(){
           $(this).data('oldValue', $(this).val());
        });


        $(document).on('change','.input-number', {} ,function(e){
            
            minValue =  parseInt($(this).attr('min'));
            maxValue =  parseInt($(this).attr('max'));
            valueCurrent = parseInt($(this).val());
            
            name = $(this).attr('name');

            if(valueCurrent >= minValue) {
                $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
            } else {
                alert('Sorry, the minimum value was reached');
                $(this).val($(this).data('oldValue'));
            }

            if(valueCurrent <= maxValue) {
                $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
            } else {
                alert('Sorry, the maximum value was reached');
                $(this).val($(this).data('oldValue'));
            }
            
        });





        $(document).on('keydown','.input-number,.datepicker, .input-number-custom', {} ,function(e){
                // Allow: backspace, delete, tab, escape, enter and .
                if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
                     // Allow: Ctrl+A
                    (e.keyCode == 65 && e.ctrlKey === true) || 
                     // Allow: home, end, left, right
                    (e.keyCode >= 35 && e.keyCode <= 39)) {
                         // let it happen, don't do anything
                         return;
                }
                // Ensure that it is a number and stop the keypress
                if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                    e.preventDefault();
                }
            });











});















   $(window).load(function() {
        var options =
        {
            thumbBox: '.thumbBox',
            spinner: '.spinner',
            imgSrc: 'avatar.png'
        }
        var cropper;
        

        $('#file').on('change', function(){
            var reader = new FileReader();
            reader.onload = function(e) {
                options.imgSrc = e.target.result;
                cropper = $('.imageBox').cropbox(options);
            }
            reader.readAsDataURL(this.files[0]);
            this.files = [];
        })



        $('#btnCrop').on('click', function(){

            var img = cropper.getDataURL()

            if( $("#CropboxModal .modal-body").attr("id") == "developer-logo" ){

                $('.user-picture-container img').attr('src', img);
                $(".user-picture-container #imgUploadDevAdd").val(img);

            }else{

                $('.user-picture-container img').attr('src', img);
                $(".user-picture-container input[name='avatar']").val(img);

            }

            $('#CropboxModal').modal('hide');
            
        })



        $('#btnZoomIn').on('click', function(){
            cropper.zoomIn();
        })


        $('#btnZoomOut').on('click', function(){
            cropper.zoomOut();
        })
    });