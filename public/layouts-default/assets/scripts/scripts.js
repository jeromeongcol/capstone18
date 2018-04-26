 $(function() {


    $('.fancybox').fancybox();




    reloadDataTable();
    


     $(document).on('click','.overlay-close', {} ,function(e){

        $(".overlay-fullscreen").removeClass("overlay-fullscreen-active");

    });






    $(document).on({

         mouseenter: function(){

            $(this).find(".project-address").show();
        },

         mouseleave: function(){
             $(this).find(".project-address").hide();

        }
    },'.product-container .item-lower-con');


    $(document).on('submit','form#searchProjectForm', {} ,function(e){
            e.preventDefault();



            var formdata = $(this).serializeArray();

            $("#ProjectList").removeClass('ProjectFilterAll');

            $.ajax({
            url: "/developers/projects",
            type:"GET", 
            data: formdata,
            success: function(data){

                $("#ProjectList").html(data.content);

                $("#ProjectList").addClass('ProjectSearchPaginate');
                $("#ProjectList").removeClass('ProjectFilterPaginate');
                
            },
            error: function (data) {
                alert(data.status);
                }
             });


    });

    

    $(document).on('click','.search-button', {} ,function(e){
       e.preventDefault();

           $("form#searchProjectForm").submit();


    });



     $(document).on('change','#FilterProjects', {} ,function(e){
         e.preventDefault();


                var category_id =  $(this).find(":selected").attr('id');
                var category =  $(this).find(":selected").val();

                $.ajax({
                url: "/developers/projects",
                type:"GET", 
                data: { 'id' : category_id, 'key' : category , 'action' : 'filter' },
                success: function(data){

                    $("#ProjectList").html(data.content);
                    $("#ProjectList").addClass('ProjectFilterPaginate');
                    $("#ProjectList").removeClass('ProjectSearchPaginate');

                    if( category != "ALL"){
                        $("#ProjectList").removeClass('ProjectFilterAll');
                    }else{
                        $("#ProjectList").addClass('ProjectFilterAll');
                    }
                    
                },
                error: function (data) {
                    alert(data.status);
                    }
                 });

     
     });



    $(document).on('click','#ProjectList.ProjectFilterAll .pagination li a', {} ,function(e){

            getProjects( $(this).attr('href').split('page=')[1]);
            e.preventDefault();
    });


    $(document).on('click','#ProjectList.ProjectFilterPaginate .pagination li a', {} ,function(e){

            var category_id =  $("#FilterProjects").find(":selected").attr('id');
            var category =  $("#FilterProjects").find(":selected").val();

            getFilterProjects( $(this).attr('href').split('page=')[1],  category_id, category );
            e.preventDefault();
    });


    $(document).on('click','#ProjectList.ProjectSearchPaginate .pagination li a', {} ,function(e){

            var formdata = $("form#searchProjectForm").serializeArray();

            getSearchProjects( $(this).attr('href').split('page=')[1],  formdata);
            e.preventDefault();
    });


    function getProjects(page) {
       
        $.ajax({
            url: '?page=' + page,
            dataType: 'json',
            data: { 'action' : 'filter', 'key' : 'ALL'},
        }).done(function(data) {
            $("#ProjectList").html(data.content);
            location.hash = page;
        }).fail(function() {
            alert('Posts could not be loaded.');
        });
    }



    function getFilterProjects(page, category_id, category) {
       
        $.ajax({
            url: '?page=' + page,
            dataType: 'json',
            data: { 'id' : category_id, 'key' : category , 'action' : 'filter'},
        }).done(function(data) {
            $("#ProjectList").html(data.content);
            location.hash = page;
        }).fail(function() {
            alert('Posts could not be loaded.');
        });
    }


    function getSearchProjects(page, formdata ) {
       
        $.ajax({
            url: '?page=' + page,
            dataType: 'json',
            data: formdata,
        }).done(function(data) {
            $("#ProjectList").html(data.content);
            location.hash = page;
        }).fail(function() {
            alert('Posts could not be loaded.');
        });
    }





    function reloadDataTable(){

        $(".data-table").DataTable({
            "scrollY":        "320px",
            "scrollCollapse": true,
            drawCallback: function(settings) {
                var pagination = $(this).closest('.dataTables_wrapper').find('.dataTables_paginate');
                pagination.toggle(this.api().page.info().pages > 1);
              },
            columnDefs: [
                 { "width": "5px", "targets": 0 },
                  { "width": "200px", "targets": 1 },
                  { "width": "200px", "targets": 2 }
            ],
            fixedColumns: true
        });


                         
        $("#Filter_length-con").html( "<label>Show : </label>" );
        $("#Filter_length-con").append( $(".dataTables_length select") );
        $(".sales-page .dataTables_filter input").attr("placeholder","Search By Filtered Sales");
        $(".events-page .dataTables_filter input").attr("placeholder","Search Sales");
        $("#Filter_search-con").html( $(".dataTables_filter input") );
        



    }



    $(document).on('change','#FilterSales', {} ,function(e){
         e.preventDefault();

                var year =  $(this).find(":selected").val();
                var month =  $("#FilterMonthSales").find(":selected").val();

                $.ajax({
                url: "/mysales",
                type:"GET", 
                data: { 'year' : year, 'month' : month },
                success: function(data){

                    $("#Sales-Content").html(data.content);
                    $("#FilterMonthSales").html(data.months);
                    
                    reloadDataTable();
                },
                error: function (data) {
                    alert(data.status);
                    }
                 });

     
     });

        $(document).on('change','#FilterMonthSales', {} ,function(e){
         e.preventDefault();

                var year =  $("#FilterSales").find(":selected").val();
                var month =  $(this).find(":selected").val();

                $.ajax({
                url: "/mysales",
                type:"GET", 
                data: { 'year' : year, 'month' : month },
                success: function(data){

                    $("#Sales-Content").html(data.content);
                    
                    reloadDataTable();
                },
                error: function (data) {
                    alert(data.status);
                    }
                 });

     
     });


    $(document).on('submit','#searchSalesForm', {} ,function(e){
         e.preventDefault();

            var formdata =  $(this).serializeArray();

            if( $("#searchSalesForm input[name='key']").val() != "" ){

                $.ajax({
                url: "/mysales",
                type:"GET", 
                data: formdata,
                success: function(data){

                    $("#Sales-Content").html(data.content);
                    reloadDataTable();
                    
                },
                error: function (data) {
                    alert(data.status);
                    }
                 });

            }else{

                $("#ErrorModal .feedback-message").html( "Empty Search Key!" );
                $("#ErrorModal").modal("show");

            }

     
     });



    $(document).on('click','#searchSalesForm .search-button', {} ,function(e){
       e.preventDefault();

           $("form#searchSalesForm").submit();


    });







     $(document).on('click','.AgentUpdateBtn', {} ,function(e){
         e.preventDefault();

                var id =  $(this).attr('id');

                $.ajax({
                url: "/profile/update",
                type:"GET", 
                data: { 'id' : id },
                success: function(data){

                    $(".agent-update-picture-con img").attr( "src" , data.photo);
                    $("#AgentUpdateModal input[name='id']").val(id);
                    $("#AgentUpdateModal").modal("show");
                    $("#Profile_Content").html(data.content);
                    
                },
                error: function (data) {
                    alert(data.status);
                    }
                 });

     
     });






     $(document).on('submit','form#ChangeProfilePicForm', {} ,function(e){
         e.preventDefault();

                var data = new FormData(this);

                $.ajax({
                url: "/agent/profile/changeprofilepicture",
                type:"POST", 
                data: data,
                async: false, 
                cache: false,
                contentType: false,
                processData: false, 
                success: function(data){


                    if($.isEmptyObject(data.error)){

                        $("body #MainContent").html( data.content );
                        $("body #MainContentNav").html( data.header );
                        $("#AgentUpdateModal").modal("hide");

                        $("#SuccessModal .feedback-message").html( data.success );
                        $("#SuccessModal").modal("show");


                    }else{

                       $("#ErrorModal .feedback-message").html( "Something went wrong!" );
                       $("#ErrorModal").modal("show");

                    }      
                    
                },
                error: function (data) {
                    alert(data.status);
                    }
                 });

     
     });





     $(document).on('submit','form#ChangePasswordForm', {} ,function(e){
         e.preventDefault();

                var formdata = $(this).serializeArray();

                $.ajax({
                url: "/agent/profile/chanegpassword",
                type:"POST", 
                data: formdata,
                success: function(data){

                    console.log( data );

                    if($.isEmptyObject(data.error)){

                        $("#SuccessModal .feedback-message").html( data.success );
                        $("#SuccessModal").modal("show");

                        $("#ChangePasswordForm .form-error").html("");


                    }else{

                        $("#ChangePasswordForm .form-error").html("");
                        $("#ChangePasswordForm .form-error.password").html( data.error['password'] );
                        $("#ChangePasswordForm .form-error.password_confirmation").html( data.error['password_confirmation'] );

                    }      
                    
                },
                error: function (data) {
                    alert(data.status);
                    }
                 });

     
     });






    $(document).on('click','.showCropboxModal', {} ,function(e){
       

       $("#CropboxModal .modal-body").attr("id",$(this).attr('id'));
       $("#CropboxModal").modal('show');

    });








    $(document).on('click','table tr.data', {} ,function(e){

        $(this).closest('table').find("tr.data").removeClass('active');
        $(this).addClass('active');

    });











    $(document).on('click','.actionViewSalesInfo', {} ,function(e){
         e.preventDefault();

        var id = $(this).attr('id');

        $.ajax({
        url: "/mysales/info",
        type:"GET",
        data: { 'id' : id } ,  
        success: function(data){

            $(".overlay-fullscreen .view-overlay-content").html(data.content);
            $(".overlay-fullscreen").addClass("overlay-fullscreen-active");


                $('.project-description-con').slimScroll({
                    height: '299px',
                    wheelStep: 2,
                });
            
            },
        error: function (data) {
            alert(data.status);
            }
         });

    });





    $(document).on('click','.actionViewEventDetails', {} ,function(e){
         e.preventDefault();

        var id = $(this).attr('id');

        $.ajax({
        url: "/agent/event",
        type:"GET",
        data: { 'id' : id } ,  
        success: function(data){

            $(".overlay-fullscreen .view-overlay-content").html(data.content);
            $(".overlay-fullscreen").addClass("overlay-fullscreen-active");

            $('.project-description-con').slimScroll({
                height: '350px',
                wheelStep: 2,
            });
            
            },
        error: function (data) {
            alert(data.status);
            }
         });

    });




 	
  }); // end of ready function







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


            $('.agent-update-picture-con img').attr('src', img);
            $(".agent-update-picture-con input[name='avatar']").val(img);
            $(".change-profile-picture-con .btn").show();

            $('#CropboxModal').modal('hide');
            
        })



        $('#btnZoomIn').on('click', function(){
            cropper.zoomIn();
        })


        $('#btnZoomOut').on('click', function(){
            cropper.zoomOut();
        })
    });