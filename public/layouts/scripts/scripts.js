



function readURL1(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#profile-picture').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}



function reloadDataTable() {

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


	if( $('.dataTables_scrollBody').length > 0) {
		$('.dataTables_scrollBody').slimScroll({
			height: '320px',
			wheelStep: 2,
		});
	}

    $('.dev-list_scrolling').slimScroll({
        height: '435px',
        wheelStep: 2,
    });



}


function reloadDataTable_WithPrint( title_header ) {

    $(".data-table-report").DataTable({
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
        fixedColumns: true,
        dom: 'Bfrtip',
          buttons: {
            buttons: [{
              extend: 'print',
              text: '<i class="fa fa-print"></i> Print',
              title: "",
              exportOptions: {
                columns: ':not(.no-print)'
              },
              footer: true,
              header: true,
              autoPrint: true,
              customize: function ( win ) {

                  // Style the body..
                  $( win.document.body ).addClass('asset-print-body');
                  $( win.document.body ).prepend('<div class="header-title">' + title_header + '</div>');
   
                  /* Style for the table */
                  $( win.document.body ).find( 'table' ).addClass( 'asset-print-table' );
             
              }
            } , {

              extend: 'pdf',
              text: '<i class="fa fa-file-pdf-o"></i> PDF',
              title: title_header,
              exportOptions: {
                columns: ':not(.no-print)'
              },
              footer: true,
              header: true,
              filename: function(){
                var d = new Date();
                var n = d.getTime();
                return 'sales' + n;
              },
              pageSize: 'LEGAL'

            },{

              extend: 'excel',
              text: '<i class="fa fa-file-excel-o"></i> EXCEL',
              title: title_header,
              exportOptions: {
                columns: ':not(.no-print)'
              },
              footer: true,
              header: true,
              filename: function(){
                var d = new Date();
                var n = d.getTime();
                return 'sales' + n;
              },
              pageSize: 'LEGAL'

            }],
            dom: {
              container: {
                className: 'dt-buttons'
              },
              button: {
                className: 'btn btn-default'
              }
            }
          }
    });


    if( $('.dataTables_scrollBody').length > 0) {
        $('.dataTables_scrollBody').slimScroll({
            height: '320px',
            wheelStep: 2,
        });
    }

    $('.dev-list_scrolling').slimScroll({
        height: '435px',
        wheelStep: 2,
    });



}




function MakeSalesDetailsPrintable() {

    $(".data-table-sales-info-print").DataTable({
        "scrollY":        "480px",
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
        fixedColumns: true,
        dom: 'Bfrtip',
          buttons: {
            buttons: [{
              extend: 'print',
              text: '<i class="fa fa-print"></i> Print',
              title: "",
              exportOptions: {
                columns: ':not(.no-print)'
              },
              footer: true,
              header: true,
              autoPrint: true,
              customize: function ( win ) {

                  // Style the body..
                  $( win.document.body ).addClass('asset-print-body');
                  $( win.document.body ).prepend('<div class="header-title">' + "SALES TALLY DETAILS" + '</div>');
   
                  /* Style for the table */
                  $( win.document.body ).find( 'table' ).addClass( 'asset-print-table' );
             
              }
            }],
            dom: {
              container: {
                className: 'dt-buttons'
              },
              button: {
                className: 'btn btn-default'
              }
            }
          }
    });


    if( $('.dataTables_scrollBody').length > 0) {
        $('.dataTables_scrollBody').slimScroll({
            height: '480px',
            wheelStep: 2,
        });
    }




}



function activateSlimScrollSelection(){
    $('.Selection-Container').slimScroll({
        height: '300px',
        wheelStep: 2,
    });

    $('.AdditionalPhoto-Container').slimScroll({
        height: '300px',
        wheelStep: 2,
    });
}

function activateSummerNote(){
    $('.summernote').summernote({
        height: 270,
        maxHeight: 270  
    });
}


function showLoadingGif(){

	$(".overlay-fullscreen-content").show();
}

function hideLoadingGif(){
	$('.overlay-fullscreen-content').delay(500).fadeOut("slow"); 
}


function fullcalendar(){
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
        select: function(start, end, allDay) {
          var check = start.format("YYYY-MM-DD");
          var today = moment().format("YYYY-MM-DD");
          if(check < today)
                   {
              $("#ErrorModal .feedback-message").html( "Cannot add event in past days." );
              $("#ErrorModal").modal("show");
          }
          else
          {
             $("#AddEventModal").modal("show");
          }
        },
        dayClick: function( date, jsEvent, view ) {


            $("#AddEventModal input[name='start']").val( moment( date ).format('MM/DD/YYYY hh:mm A') );
            $("#AddEventModal input[name='end']").val( moment( date ).format('MM/DD/YYYY hh:mm A') );


        },
        eventClick: function( calEvent, JsEvent, view){


            $.ajax({
                url: '/event',
                type:"GET", 
                data: { "id": calEvent.id },
                success: function(data){    
                    
                    $(".form-error").html("");


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

                    if( ( data.status == "finished" ) || ( data.status == "ongoing" ) ){
                        $("#EventActionModal .cancelEventBtn").hide(); 
                        $("#EventActionModal .resumeEventBtn").hide(); 
                    }

                    $("#EventActionModal .note-editable").html( data.description );
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



    $('.eventdatepicker').datetimepicker({
        viewMode: 'months',
        showTodayButton: true,
        sideBySide: true,
        minDate: moment().subtract(0, 'years').startOf('year')
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


}

function activateChart( year ) {



    $.ajax({
        url: "/sales/getSalesByYear",
        type:"GET", 
        data: { "year": year }, 
        success: function(data){

        $("#canvasContainer canvas").remove();
        $("#canvasContainer").append("<canvas id='ChartCanvas'></canvas>");

        var ctx = document.getElementById("ChartCanvas").getContext("2d");
        window.myBar = new Chart(ctx, {
            type: 'bar',
            data:{
                labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
                datasets: [{
                    label: year + ' Sales Overview',
                    data: data.yearData,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
                
            },
            options: {
                scales: {
                    
                    yAxes: [{
                    ticks: {
                    
                           //min: 0,
                           //max: 100,
                           //callback: function(value){return value+ "%"}
                        },  
                        scaleLabel: {
                           display: true,
                           labelString: "Total Sales"
                        }
                    }]
                }
            }
        });


        $('.canvasOuterContainer').slimScroll({
            height: '450px',
            wheelStep: 2,
        });


    },
    error: function (data) {
        alert(data.status);
        }
     });




}






  $(function() {



  	// activate DataTable to all .data-table class
  	reloadDataTable();
  	activateAgentSteps();
  	activateStaffSteps();
  	activateAdminSteps();
  	activateDeveloperSteps();
    activateProjectSteps();
    activateSalesSteps();
   


    if (window.location.pathname == "/events/calendar"){
        fullcalendar();
    }

    if (window.location.pathname == "/dashboard"){
        activateChart( moment().format("YYYY") );
    }






    $('.fancybox').fancybox();


    $(document).on('change','#imgUpload', {} ,function(e){
        readURL1(this);
    });






	$(document).on('click','.showCropboxModal', {} ,function(e){
	   

	   $("#CropboxModal .modal-body").attr("id",$(this).attr('id'));
	   $("#CropboxModal").modal('show');

	});




     $(document).on('change','#UserExcelFile', {} ,function(e){
        $("#UserExcelFileBtn").html( "Browse Excel - ( " + this.files.length + " ) file selected." );
     });





	$(document).on('click','.sub-menu .btn', {} ,function(e){

		$(".sub-menu .btn").removeClass('active');
		$(this).addClass('active');

	});


	$(document).on('click','table tr.data', {} ,function(e){

		$(this).closest('table').find("tr.data").removeClass('active');
		$(this).addClass('active');

	});



$(document).on('click','.notification-item-con', {} ,function(e){

    $('.notification-item-con').removeClass('active');
    $(this).addClass('active');

  });


 

	$(document).on('click','#sidebar-nav .nav > li > a', {} ,function(e){

		$(".sidebar .nav > li > a").removeClass('active');
		$(this).addClass('active');

	});


	
	$(document).on('click','#agent-ranks-table tr.data', {} ,function(e){

        var rankId = $(this).attr('id');

            $.ajax({
            url: "/users/agent/rank",
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




	$(document).on('click','table#SelectAgentRankTable tr.data, table#SelectRecruiterTable tr.data, .Selection-Container table tr.data', {} ,function(e){

		$(this).find('input:radio').prop('checked', true);

	});




	$(document).on('click','table#SelectAgentRankTable tr.data, table#SelectRecruiterTable tr.data', {} ,function(e){

		$(this).find('input:radio').prop('checked', true);

	});

	


    $(document).on('click','.SeletedMenuHeader .menu-custom', {} ,function(e){

        //$(".SeletedMenuHeader .menu-custom").removeClass('active');
        //$(this).addClass('active');

    });



 	//////////////// USERS MENU SCRIPTS //





  $(document).on('click','.notification-menu', {} ,function(e){

      window.history.pushState( {}, '', '/notifications');
      showLoadingGif();

          $.ajax({
          url: "/notifications",
          type:"GET", 
          success: function(data){

            $("body #wrapper #content").html(data.content);
            $('body #wrapper #content').slideDown('slow');

            hideLoadingGif();

          },
          error: function (data) {
              alert(data.status);
              }
           });


  });


  $(document).on('click','.reports-menu', {} ,function(e){

      window.history.pushState( {}, '', '/reports');
      showLoadingGif();

          $.ajax({
          url: "/reports",
          type:"GET", 
          success: function(data){

            $("body #wrapper #content").html(data.content);
            $('body #wrapper #content').slideDown('slow');


            hideLoadingGif();

          },
          error: function (data) {
              alert(data.status);
              }
           });


  });




    if (window.location.pathname == "/reports/agents"){

       //$("#printBtn").show();
       //$("#pdfBtn").show();
        //$("#excelBtn").show();


        reloadDataTable_WithPrint( "AGENT LIST" );

    }

    if (window.location.pathname == "/reports/developers"){

       $("#printBtn").show();
        $("#pdfBtn").show();
        $("#excelBtn").show();


        reloadDataTable_WithPrint( "DEVELOPER LIST" );

    }

    if (window.location.pathname == "/reports/projects"){

       $("#printBtn").show();
        $("#pdfBtn").show();
        $("#excelBtn").show();


        reloadDataTable_WithPrint( "PROJECT LIST" );

    }





  $(document).on('click','.report-agents', {} ,function(e){

      window.history.pushState( {}, '', '/reports/agents');
      showLoadingGif();

          $.ajax({
          url: "/reports/agents",
          type:"GET", 
          success: function(data){

            $("body #wrapper #content").html(data.content);
            $('body #wrapper #content').slideDown('slow');

            //$("#printBtn").show();
            //$("#pdfBtn").show();
            //$("#excelBtn").show();

             reloadDataTable_WithPrint( "AGENT LIST" );


            hideLoadingGif();

          },
          error: function (data) {
              alert(data.status);
              }
           });


  });






  $(document).on('submit','#Filter_Reports_Agent_Form', {} ,function(e){
      e.preventDefault();
      showLoadingGif();

        var formdata = $(this).serializeArray();

          $.ajax({
          url: "/reports/agents/filters",
          type:"GET", 
          data: formdata, 
          success: function(data){


            $("body #wrapper #Reports-Table-con").html(data.content);
            $('body #wrapper #Reports-Table-con').slideDown('slow');

            if( data.count > 0 ){
              $("#printBtn").show();
              $("#pdfBtn").show();
              $("#excelBtn").show();
            }

            reloadDataTable_WithPrint(data.title);


            hideLoadingGif();

          },
          error: function (data) {
              alert(data.status);
              }
           });


  });











  $(document).on('click','.report-developers', {} ,function(e){

      window.history.pushState( {}, '', '/reports/developers');
      showLoadingGif();

          $.ajax({
          url: "/reports/developers",
          type:"GET", 
          success: function(data){

            $("body #wrapper #content").html(data.content);
            $('body #wrapper #content').slideDown('slow');

            $("#printBtn").show();
            $("#pdfBtn").show();
            $("#excelBtn").show();

             reloadDataTable_WithPrint( "DEVELOPER LIST" );
             

            hideLoadingGif();

          },
          error: function (data) {
              alert(data.status);
              }
           });


  });




  $(document).on('click','.report-projects', {} ,function(e){

      window.history.pushState( {}, '', '/reports/projects');
      showLoadingGif();

          $.ajax({
          url: "/reports/projects",
          type:"GET", 
          success: function(data){

            $("body #wrapper #content").html(data.content);
            $('body #wrapper #content').slideDown('slow');

            $("#printBtn").show();
            $("#pdfBtn").show();
            $("#excelBtn").show();

             reloadDataTable_WithPrint( "PROJECT LIST" );
             

            hideLoadingGif();

          },
          error: function (data) {
              alert(data.status);
              }
           });


  });






	$(document).on('click','.users-menu', {} ,function(e){

			window.history.pushState( {}, '', '/users');
			showLoadingGif();

	        $.ajax({
	        url: "/users",
	        type:"GET", 
	        success: function(data){

            	$("body #wrapper #content").html(data.content);
            	$('body #wrapper #content').slideDown('slow');

            	reloadDataTable();
            	hideLoadingGif();

	        },
	        error: function (data) {
	            alert(data.status);
	            }
	         });


	});




	$(document).on('click','.agent-submenu', {} ,function(e){

			window.history.pushState( {}, '', '/users/agent');
			showLoadingGif();

	        $.ajax({
	        url: "/users/agent",
	        type:"GET", 
	        success: function(data){

	        	$("body #wrapper #content").html(data.content);
            	$('body #wrapper #content').slideDown('slow');
	        	reloadDataTable();

	        	hideLoadingGif();

	        },
	        error: function (data) {
	            alert(data.status);
	            }
	         });


	});








	$(document).on('click','.staff-submenu', {} ,function(e){

			window.history.pushState( {}, '', '/users/staff');

			showLoadingGif();

	        $.ajax({
	        url: "/users/staff",
	        type:"GET", 
	        success: function(data){

	        	$("body #wrapper #content").html(data.content);
            	$('body #wrapper #content').slideDown('slow');
	        	reloadDataTable();

	        	hideLoadingGif();
	        },
	        error: function (data) {
	            alert(data.status);
	            }
	         });


	});







	$(document).on('click','.admin-submenu', {} ,function(e){

			window.history.pushState( {}, '', '/users/admin');
			showLoadingGif();

	        $.ajax({
	        url: "/users/admin",
	        type:"GET", 
	        success: function(data){
	        	$("body #wrapper #content").html(data.content);
            	$('body #wrapper #content').slideDown('slow');
	        	reloadDataTable();
	        	hideLoadingGif();
	        },
	        error: function (data) {
	            alert(data.status);
	            }
	         });


	});




	$(document).on('click','#AddAgentBtn', {} ,function(e){

			window.history.pushState( {}, '', '/users/agent/add');
			showLoadingGif();

	        $.ajax({
	        url: "/users/agent/add",
	        type:"GET", 
	        success: function(data){
	        	$("body #wrapper #content").html(data.content);
            	$('body #wrapper #content').slideDown('slow');
	        	reloadDataTable();
	        	activateAgentSteps();
	        	hideLoadingGif();

	        },
	        error: function (data) {
	            alert(data.status);
	            }
	         });


	});





	$(document).on('click','#AddStaffBtn', {} ,function(e){

			window.history.pushState( {}, '', '/users/staff/add');
			showLoadingGif();

	        $.ajax({
	        url: "/users/staff/add",
	        type:"GET", 
	        success: function(data){
	        	$("body #wrapper #content").html(data.content);
            	$('body #wrapper #content').slideDown('slow');
	        	reloadDataTable();
	        	activateStaffSteps();
	        	hideLoadingGif();
	        },
	        error: function (data) {
	            alert(data.status);
	            }
	         });


	});




	$(document).on('click','#AddAdminBtn', {} ,function(e){

			window.history.pushState( {}, '', '/users/admin/add');
			showLoadingGif();

	        $.ajax({
	        url: "/users/admin/add",
	        type:"GET", 
	        success: function(data){
	        	$("body #wrapper #content").html(data.content);
            	$('body #wrapper #content').slideDown('slow');
	        	reloadDataTable();
	        	activateAdminSteps();
	        	hideLoadingGif();
	        },
	        error: function (data) {
	            alert(data.status);
	            }
	         });


	});







	$(document).on('click','#AddDeveloperBtn', {} ,function(e){

			window.history.pushState( {}, '', '/developers/add');
			showLoadingGif();

	        $.ajax({
	        url: "/developers/add",
	        type:"GET", 
	        success: function(data){

	        	$("body #wrapper #content").html(data.content);
            	$('body #wrapper #content').slideDown('slow');
	        	activateDeveloperSteps();
	        	hideLoadingGif();


	        },
	        error: function (data) {
	            alert(data.status);
	            }
	         });


	});





    $(document).on('click','#AddProjectBtn', {} ,function(e){

            window.history.pushState( {}, '', '/projects/add');
            showLoadingGif();

            $.ajax({
            url: "/projects/add",
            type:"GET", 
            success: function(data){

                $("body #wrapper #content").html(data.content);
                $('body #wrapper #content').slideDown('slow');
                activateProjectSteps();
                hideLoadingGif();

            },
            error: function (data) {
                alert(data.status);
                }
             });


    });




    $(document).on('click','#AddSalesBtn', {} ,function(e){

            window.history.pushState( {}, '', '/sales/add');
            showLoadingGif();

            $.ajax({
            url: "/sales/add",
            type:"GET", 
            success: function(data){
                $("body #wrapper #content").html(data.content);
                $('body #wrapper #content').slideDown('slow');
                reloadDataTable();
                activateSalesSteps();
                hideLoadingGif();
            },
            error: function (data) {
                alert(data.status);
                }
             });


    });




    $(document).on('click','.dashboard-submenu', {} ,function(e){

            e.preventDefault();
            window.history.pushState( {}, '', '/dashboard');

            showLoadingGif();

            $.ajax({
            url: "/dashboard",
            type:"GET", 
            success: function(data){

                $("body #wrapper #content").html(data.content);
                $('body #wrapper #content').slideDown('slow');
                reloadDataTable();

                activateChart( moment().format("YYYY") );

                hideLoadingGif();
            },
            error: function (data) {
                alert(data.status);
                }
             });


    });






	$('.RecruitersTable-con').slimScroll({
		height: '223px',
		wheelStep: 2,
	});




	$(document).on('click','#searchAgent', {} ,function(e){
		e.preventDefault()

		var key = $("#search_recuiter").val();

        $.ajax({
        url: "/users/agent/search",
        type:"GET",
        data: { 'key' : key }, 
        success: function(data){

        	$("#SelectRecruiterTable").html(data.content);
        	

        	$('.RecruitersTable-con').slimScroll({
				height: '223px',
				wheelStep: 2,
			});

        },
        error: function (data) {
            alert(data.status);
            }
         });


	});



	
	$(document).on('submit','form#AddAgentForm', {} ,function(e){
		e.preventDefault()

		var formdata = $(this).serializeArray();

        $.ajax({
        url: "/users/agent/add",
        type:"POST",
        data: formdata, 
        async: false,
        success: function(data){

        	window.history.pushState( {}, '', '/users/agent');

        	$("#SuccessModal .feedback-message").html( data.success );
            $("#SuccessModal").modal("show");
            
        	$("body #wrapper #content").html(data.content);
            $('body #wrapper #content').slideDown('slow');

        	reloadDataTable();

        },
        error: function (data) {
            alert(data.status);
            }
         });


	});





	$(document).on('click','#AgentSettings', {} ,function(e){
		e.preventDefault()

		var formdata = $(this).serializeArray();

		showLoadingGif();

        $.ajax({
        url: "/users/agent/ranks",
        type:"GET",
        data: formdata, 
        success: function(data){

        	window.history.pushState( {}, '', '/users/agent/ranks');

        	$("body #wrapper #content").html(data.content);
            $('body #wrapper #content').slideDown('slow');

        	reloadDataTable();

        	hideLoadingGif();

        },
        error: function (data) {
            alert(data.status);
            }
         });


	});




	$(document).on('submit','form#AddStaffForm', {} ,function(e){
		e.preventDefault()

		var formdata = $(this).serializeArray();

        $.ajax({
        url: "/users/staff/add",
        type:"POST",
        data: formdata, 
        async: false,
        success: function(data){

        	window.history.pushState( {}, '', '/users/staff');

        	$("#SuccessModal .feedback-message").html( data.success );
            $("#SuccessModal").modal("show");
            
        	$("body #wrapper #content").html(data.content);
            $('body #wrapper #content').slideDown('slow');
        	reloadDataTable();

        },
        error: function (data) {
            alert(data.status);
            }
         });


	});


	$(document).on('submit','form#AddAdminForm', {} ,function(e){
		e.preventDefault()

		var formdata = $(this).serializeArray();

        $.ajax({
        url: "/users/admin/add",
        type:"POST",
        data: formdata, 
        async: false,
        success: function(data){

        	window.history.pushState( {}, '', '/users/admin');

        	$("#SuccessModal .feedback-message").html( data.success );
            $("#SuccessModal").modal("show");
            
        	$("body #wrapper #content").html(data.content);
            $('body #wrapper #content').slideDown('slow');
        	reloadDataTable();

        },
        error: function (data) {
            alert(data.status);
            }
         });


	});




    $("#verifypasswordbtn").on('click',function(e){

    	$(".error_verify").hide();
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

					var title = "SET USER TO NOT ACTIVE";
					var message = "Are you sure you want to set this user to not active ?";

					var reloadList = "#content";

					$("#ConfirmModal .modal-title").html( title );
					$("#ConfirmModal .modal-message").html( message );

					$("#ConfirmModal .modal-header").addClass("modal-danger");
					$("#ConfirmModal .action-confirm").addClass("btn-danger");
					$("#ConfirmModal .reloadList").val(reloadList);

					$("#ConfirmModal #ConfirmForm").attr("action", "/users/setToNotActive");
					$("#ConfirmModal #ConfirmForm").attr("method", "POST");

					$("#ConfirmModal .SelectedId").val( userid );
					$("#ConfirmModal").modal("show");


                    $('#verifypassword').val("");
                    $("#VerifyUserModal").modal("hide");

                       
                }
                else if( $("#VerifyUserModal #targetAction").val() == ".actionSetActiveUserBtnShowModal" )
                {
                       
                    var title = "SET USER TO ACTIVE";
					var message = "Are you sure you want to set this user to active ?";

					var reloadList = "#content";

					$("#ConfirmModal .modal-title").html( title );
					$("#ConfirmModal .modal-message").html( message );

					$("#ConfirmModal .modal-header").addClass("modal-success");
					$("#ConfirmModal .action-confirm").addClass("btn-success");
					$("#ConfirmModal .reloadList").val(reloadList);

					$("#ConfirmModal #ConfirmForm").attr("action", "/users/setToActive");
					$("#ConfirmModal #ConfirmForm").attr("method", "POST");

					$("#ConfirmModal .SelectedId").val( userid );
					$("#ConfirmModal").modal("show");


                    $('#verifypassword').val("");
                    $("#VerifyUserModal").modal("hide");

                }else if( $("#VerifyUserModal #targetAction").val() == ".actionDisApproveAgentBtnShowModal" ){

                	var title = "DISAPPROVE AGENT";
					var message = "Are you sure you want to disapprove this agent ?";

					var reloadList = "#content";

					$("#ConfirmModal .modal-title").html( title );
					$("#ConfirmModal .modal-message").html( message );

					$("#ConfirmModal .modal-header").addClass("modal-danger");
					$("#ConfirmModal .action-confirm").addClass("btn-danger");
					$("#ConfirmModal .reloadList").val(reloadList);

					$("#ConfirmModal #ConfirmForm").attr("action", "/users/agent/disapprove");
					$("#ConfirmModal #ConfirmForm").attr("method", "POST");

					$("#ConfirmModal .SelectedId").val( userid );
					$("#ConfirmModal").modal("show");


			        $('#verifypassword').val("");
			        $("#VerifyUserModal").modal("hide");


                }else if( $("#VerifyUserModal #targetAction").val() == ".actionApproveAgentBtnShowModal" ){


                	var title = "APPROVE AGENT";
					var message = "Are you sure you want to approve this agent ?";

					var reloadList = "#content";

					$("#ConfirmModal .modal-title").html( title );
					$("#ConfirmModal .modal-message").html( message );

					$("#ConfirmModal .modal-header").addClass("modal-success");
					$("#ConfirmModal .action-confirm").addClass("btn-success");
					$("#ConfirmModal .reloadList").val(reloadList);

					$("#ConfirmModal #ConfirmForm").attr("action", "/users/agent/approve");
					$("#ConfirmModal #ConfirmForm").attr("method", "POST");

					$("#ConfirmModal .SelectedId").val( userid );
					$("#ConfirmModal").modal("show");


			        $('#verifypassword').val("");
			        $("#VerifyUserModal").modal("hide");


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






 	$(document).on('click','.actionDisApproveAgentBtnShowModal', {} ,function(e){
 		
 		$("#VerifyUserModal #targetAction").val( ".actionDisApproveAgentBtnShowModal" );
        $("#VerifyUserModal #targetId").val( $(this).attr('id') );
        $("#VerifyUserModal").modal("show");

    });



 	$(document).on('click','.actionApproveAgentBtnShowModal', {} ,function(e){
 		
 		$("#VerifyUserModal #targetAction").val( ".actionApproveAgentBtnShowModal" );
        $("#VerifyUserModal #targetId").val( $(this).attr('id') );
        $("#VerifyUserModal").modal("show");

 		
    });






 	$(document).on('submit','form#updateEmailForm', {} ,function(e){
 		e.preventDefault();

 		    var formdata = $(this).serializeArray();

            $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'), 
            data: formdata ,
            success: function(data){    
                
               if($.isEmptyObject(data.error)){

                    if( data.self != null ){

                    	$("#SuccessModal .feedback-message").html( data.success );
	                    $("#SuccessModal").modal("show");

			    		$(".overlay-fullscreen .view-overlay-content").html(data.self);

			    	}else{

			    		$("#SuccessModal .feedback-message").html( data.success );
	                    $("#SuccessModal").modal("show");

	                    $("body #wrapper #content").html(data.content);
            			$('body #wrapper #content').slideDown('slow');
				    	reloadDataTable();


			    		$("#updateEmailForm .form-error").html("");
		    			$(".overlay-fullscreen .view-overlay-content").html(data.overlay);

                        $(".User_Email_Tab").trigger('click');


			    	}

			                    

                }else{

                	$("#updateEmailForm .form-error.email").html(data.error['email']);
                }
                
                },
            error: function (data) {
                alert(data.status);
                }

            });

            return false;

 		
    });




 	$(document).on('submit','form#changePasswordForm', {} ,function(e){
 		e.preventDefault();

 		    var formdata = $(this).serializeArray();

            $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'), 
            data: formdata ,
            success: function(data){    
                
               if($.isEmptyObject(data.error)){

                    $("#SuccessModal .feedback-message").html( data.success );
                    $("#SuccessModal").modal("show");
			    	$("#changePasswordForm .form-error").html("");


                    $(".User_Change_Password_Tab").trigger('click');
			                    

                }else{

                	$("#changePasswordForm .form-error.password").html(data.error['password']);
                	$("#changePasswordForm .form-error.password_confirmation").html(data.error['password_confirmation']);
                }
                
                },
            error: function (data) {
                alert(data.status);
                }

            });

            return false;

 		
    });









 	$(document).on('submit','form#updateAgentRankForm', {} ,function(e){
 		e.preventDefault();

 		    var formdata = $(this).serializeArray();

            $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'), 
            data: formdata ,
            success: function(data){    
                
               if($.isEmptyObject(data.error)){

                    $("#SuccessModal .feedback-message").html( data.success );
                    $("#SuccessModal").modal("show");

                    $("body #wrapper #content").html(data.content);
       			 	$('body #wrapper #content').slideDown('slow');
			    	reloadDataTable();

	    			$(".overlay-fullscreen .view-overlay-content").html(data.overlay);

                    $(".Agent_Rank_Tab").trigger('click');
			                    

                }
                
                },
            error: function (data) {
                alert(data.status);
                }

            });

            return false;

 		
    });







 	$(document).on('submit','form#updateAgentRecruiterForm', {} ,function(e){
 		e.preventDefault();

 		    var formdata = $(this).serializeArray();

            $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'), 
            data: formdata ,
            success: function(data){    
                
               if($.isEmptyObject(data.error)){

                    $("#SuccessModal .feedback-message").html( data.success );
                    $("#SuccessModal").modal("show");

                    $("body #wrapper #content").html(data.content);
       			 	$('body #wrapper #content').slideDown('slow');
			    	reloadDataTable();

	    			$(".overlay-fullscreen .view-overlay-content").html(data.overlay);

                    $(".Agent_Recruiter_Tab").trigger('click');
			                    

                }else{

                	$("#ErrorModal .feedback-message").html( data.error );
                    $("#ErrorModal").modal("show");

                    $("body #wrapper #content").html(data.content);
       			 	$('body #wrapper #content').slideDown('slow');
			    	reloadDataTable();

	    			$(".overlay-fullscreen .view-overlay-content").html(data.overlay);
                }
                
                },
            error: function (data) {
                alert(data.status);
                }

            });

            return false;

 		
    });





 	$(document).on('submit','form#updateAgentRankTypeForm', {} ,function(e){
 		e.preventDefault();

 		    var formdata = $(this).serializeArray();

            $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'), 
            data: formdata ,
            success: function(data){    
                
               if($.isEmptyObject(data.error)){

                    $("#SuccessModal .feedback-message").html( data.success );
                    $("#SuccessModal").modal("show");

                    $("body #wrapper #content").html(data.content);
       			 	$('body #wrapper #content').slideDown('slow');	
       			 	reloadDataTable();		                    

                }
                
                },
            error: function (data) {
                alert(data.status);
                }

            });

            return false;

 		
    });



 	$(document).on('submit','form#updateBasicInfoForm', {} ,function(e){
 		e.preventDefault();

 		    var formdata = $(this).serializeArray();

            $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'), 
            data: formdata ,
            success: function(data){    
                
               if($.isEmptyObject(data.error)){


			    	if( data.self != null ){

			    		$("#SuccessModal .feedback-message").html( data.success );
	                    $("#SuccessModal").modal("show");

			    		$(".overlay-fullscreen .view-overlay-content").html(data.self);

                         $(".User_Basic_Info_Tab").trigger('click');

			    	}else{

			    		$("#SuccessModal .feedback-message").html( data.success );
	                    $("#SuccessModal").modal("show");

	                    $("body #wrapper #content").html(data.content);
           			 	$('body #wrapper #content').slideDown('slow');
				    	reloadDataTable();

		    			$(".overlay-fullscreen .view-overlay-content").html(data.overlay);

                         $(".User_Basic_Info_Tab").trigger('click');



			    	}
			                    

                }else{

                	$("#updateBasicInfoForm .form-error.firstname").html(data.error['firstname']);
                	$("#updateBasicInfoForm .form-error.lastname").html(data.error['lastname']);
                	$("#updateBasicInfoForm .form-error.middlename").html(data.error['middlename']);
                }
                
                },
            error: function (data) {
                alert(data.status);
                }

            });

            return false;

 		
    });






    $(document).on('submit','form#changeProfiePictureForm', {} ,function(e){
 		e.preventDefault();

 		    var data = new FormData(this);

            $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'), 
            data: data ,
            async: false, 
            cache: false,
            contentType: false,
            processData: false, 
            success: function(data){    
                
               if($.isEmptyObject(data.error)){

               		if( data.self != null ){
	                    $("#SuccessModal .feedback-message").html( data.success );
	                    $("#SuccessModal").modal("show");
				        $(".overlay-fullscreen .view-overlay-content").html(data.self);
                        $(".User_Profile_Picture_Tab").trigger('click');
			   		}else{
			   			$("#SuccessModal .feedback-message").html( data.success );
	                    $("#SuccessModal").modal("show");
				        $(".overlay-fullscreen .view-overlay-content").html(data.overlay);
                        $(".User_Profile_Picture_Tab").trigger('click');
			   		}


                }else{

                	$("#ErrorModal .feedback-message").html( data.error );
                	$("#ErrorModal").modal("show");
                }
                
                },
            error: function (data) {
                alert(data.status);
                }

            });

            return false;

 		
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
                            //$('#ImportUserExcelModal #progress span').html(ratio);

                          }
                        }, false);
                        //Download progress
                        xhr.addEventListener("progress", function(evt){
                          if (evt.lengthComputable) {
                            var ratio = Math.floor((evt.loaded / evt.total) * 100) + '%';
                            $('#ImportUserExcelModal #progress').css('width', ratio);
                            //$('#ImportUserExcelModal #progress span').html(ratio);
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

                        $("#SuccessModal .feedback-message").html( data.success );
			            $("#SuccessModal").modal("show");
			            
			        	$("body #wrapper #content").html(data.content);
           				$('body #wrapper #content').slideDown('slow');
			        	reloadDataTable();

			        	 $("#ImportUserExcelModal").modal("hide");
			        	 $('#ImportUserExcelModal #progress').css('width', 0);

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
        





    $(document).on('submit','form#ConfirmForm', {} ,function(e){
            e.preventDefault();

            var formdata = $(this).serializeArray();

            $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'), 
            data: formdata ,
            success: function(data){    
                
                   if($.isEmptyObject(data.error)){


                   	if( data.self != null ){

                   		$("#ConfirmModal").modal("hide");
			    		$("#SuccessModal .feedback-message").html( data.success );
	                    $("#SuccessModal").modal("show");

			    		$(".overlay-fullscreen .view-overlay-content").html(data.self);
                        $(".Status_Tab").trigger('click');

			    	}else{

                        $("body #wrapper #content").html(data.content);
           			 	$('body #wrapper #content').slideDown('slow');

                        $("#ConfirmModal").modal("hide");
                        $("#SuccessModal .feedback-message").html( data.success );
                        $("#SuccessModal").modal("show");


                        if( $("#ConfirmModal .reloadList").val() == "fullcalendar" ){
                            fullcalendar();
                        }


                        reloadDataTable();

                        $(".overlay-fullscreen .view-overlay-content").html(data.overlay);

                        activateSummerNote();
                        activateSlimScrollSelection();

                        $(".Status_Tab").trigger('click');
                        
                        if( $("#ConfirmModal .reloadList").val() == "DeletePhoto" ){
                            $(".Project_Photos_Tab").trigger('click');

                        }


			    	}



                       
                        

                    }
                
                },
            error: function (data) {
                alert(data.status);
                }

            });

            return false;

    });








    $(document).on('click','.actionViewUserBtnShowModal', {} ,function(e){
         e.preventDefault();

        var id = $(this).attr('id');

        $.ajax({
        url: "/users/profile",
        type:"GET",
        data: { 'id' : id } ,  
        success: function(data){

            $(".overlay-fullscreen .view-overlay-content").html(data.content);
            $(".overlay-fullscreen").addClass("overlay-fullscreen-active");

            $('.tab-content').slimScroll({
				height: '450px',
				wheelStep: 2,
			});
            
            },
        error: function (data) {
            alert(data.status);
            }
         });

    });






    $(document).on('click','.actionUpdateUserBtnShowModal', {} ,function(e){
         e.preventDefault();

        var id = $(this).attr('id');


        $.ajax({
        url: "/users/update",
        type:"GET",
        data: { 'id' : id } ,  
        success: function(data){

       		$(".overlay-fullscreen").removeClass("overlay-fullscreen-active");
            $(".overlay-fullscreen .view-overlay-content").html(data.content);
            $(".overlay-fullscreen").addClass("overlay-fullscreen-active");
            
            $('.RecruitersTable-con').slimScroll({
				height: '223px',
				wheelStep: 2,
			});


            
            },
        error: function (data) {
            alert(data.status);
            }
         });

    });





 	// END USERS MENU SCRIPTS //////////////// 














	$(document).on('click','.sales-menu-approved', {} ,function(e){

			window.history.pushState( {}, '', '/sales/approved');
	        showLoadingGif();

	        $.ajax({
	        url: "/sales/approved",
	        type:"GET", 
	        success: function(data){

	            $("body #wrapper #content").html(data.content);
            	$('body #wrapper #content').slideDown('slow');
	        	reloadDataTable();
	        	hideLoadingGif();
	        	
	        },
	        error: function (data) {
	            alert(data.status);
	            }
	         });


	});



    $(document).on('click','.sales-menu-cancelled', {} ,function(e){

            window.history.pushState( {}, '', '/sales/cancelled');
            showLoadingGif();

            $.ajax({
            url: "/sales/cancelled",
            type:"GET", 
            success: function(data){

                $("body #wrapper #content").html(data.content);
                $('body #wrapper #content').slideDown('slow');
                reloadDataTable();
                hideLoadingGif();
                
            },
            error: function (data) {
                alert(data.status);
                }
             });


    });



    $(document).on('click','.sales-menu-pending', {} ,function(e){

            window.history.pushState( {}, '', '/sales/pending');
            showLoadingGif();

            $.ajax({
            url: "/sales/pending",
            type:"GET", 
            success: function(data){

                $("body #wrapper #content").html(data.content);
                $('body #wrapper #content').slideDown('slow');
                reloadDataTable();
                hideLoadingGif();
                
            },
            error: function (data) {
                alert(data.status);
                }
             });


    });






	$(document).on('click','.developers-menu', {} ,function(e){

			window.history.pushState( {}, '', '/developers');
	        showLoadingGif();

	        $.ajax({
	        url: "/developers",
	        type:"GET", 
	        success: function(data){

	            $("body #wrapper #content").html(data.content);
            	$('body #wrapper #content').slideDown('slow');
	        	reloadDataTable();
	        	hideLoadingGif();
	        	
	        },
	        error: function (data) {
	            alert(data.status);
	            }
	         });


	});







	$(document).on('click','.events-menu, .calendar-view', {} ,function(e){

			window.history.pushState( {}, '', '/events/calendar');
	        showLoadingGif();

	        $.ajax({
	        url: "/events/calendar",
	        type:"GET", 
	        success: function(data){

	            $("body #wrapper #content").html(data.content);
            	$('body #wrapper #content').slideDown('slow');
	        	reloadDataTable();
	        	fullcalendar();


            hideLoadingGif();
	        	
	        },
	        error: function (data) {
	            alert(data.status);
	            }
	         });


	});

		$(document).on('click','.events-list', {} ,function(e){

			window.history.pushState( {}, '', '/events');

            showLoadingGif();
	        $.ajax({
	        url: "/events",
	        type:"GET", 
	        success: function(data){

	            $("body #wrapper #content").html(data.content);
            	$('body #wrapper #content').slideDown('slow');
	        	reloadDataTable();
	        	fullcalendar();


           hideLoadingGif();
	        	
	        },
	        error: function (data) {
	            alert(data.status);
	            }
	         });


	});


	$(document).on('click','.reports-menu,#reports-menu', {} ,function(e){

			window.history.pushState( {}, '', '/reports');
	        
	        $.ajax({
	        url: "/reports",
	        type:"GET", 
	        success: function(data){

	            $("body #wrapper #content").html(data.content);
            	$('body #wrapper #content').slideDown('slow');

	        	reloadDataTable();

            $( "#Filter_By_Date_From, #Filter_By_Date_To" ).datepicker({  
            changeMonth: true,
            changeYear: true,
            showButtonPanel: false,
            dateFormat: 'MM dd yy',

            minDate: "-20Y",
            maxDate: new Date,
            yearRange: 'c-100:c+10', 

            onClose: function(dateText, inst) { 
                var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
                var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                var day = $("#ui-datepicker-div .ui-datepicker-day :selected").val();
                //alert( day );
                //$(this).datepicker('setDate', new Date(year, month, day));
            }

        });

	        	
	        },
	        error: function (data) {
	            alert(data.status);
	            }
	         });


	});














     $(document).on('click','.overlay-close', {} ,function(e){

        $(".overlay-fullscreen").removeClass("overlay-fullscreen-active");

    });













      $(document).on('click','.addEventShowModal', {} ,function(e){
            e.preventDefault();

            $("#AddEventModal input[name='start']").val( moment().format("MM/DD/YYYY hh:mm A") ) ;
            $("#AddEventModal input[name='end']").val( moment().format("MM/DD/YYYY hh:mm A") ) ;
            $("#AddEventModal").modal("show");

                $('.eventdatepicker').datetimepicker({
                    viewMode: 'months',
                    showTodayButton: true,
                    sideBySide: true,
                    minDate: moment().subtract(0, 'years').startOf('year')
                });

      });






      $(document).on('submit','form#addEventForm', {} ,function(e){
            e.preventDefault();


            var formdata = $(this).serializeArray();


            $.ajax({
            url: "/events/add",
            type:"POST", 
            data: formdata,
            async: true,
            dataType: "json",
            headers : { 'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content') },
            success: function(data){  

                  if($.isEmptyObject(data.error)){

                        $("#SuccessModal .feedback-message").html( data.success );
                        $("#SuccessModal").modal("show");

                        $("body #wrapper #content").html(data.content);
    		            	  $('body #wrapper #content').slideDown('slow');

      			        	reloadDataTable();

      			        	fullcalendar();

                              $("#AddEventModal").modal("hide");

                              $("#AddEventModal input").val("");
                              $("#AddEventModal .form-error").html("");

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

	                        $("#SuccessModal .feedback-message").html( data.success );
	                        $("#SuccessModal").modal("show");

	                        $("body #wrapper #content").html(data.content);
			            	$('body #wrapper #content').slideDown('slow');
				        	reloadDataTable();
				        	fullcalendar();

	                        $("#EventActionModal").modal("hide");

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

            var reloadList = "fullcalendar";

            $("#ConfirmModal .modal-title").html( title );
            $("#ConfirmModal .modal-message").html( message );

            $("#ConfirmModal .modal-header").removeClass("modal-success");
            $("#ConfirmModal .action-confirm").removeClass("btn-success");
            $("#ConfirmModal .modal-header").addClass("modal-danger");
            $("#ConfirmModal .action-confirm").addClass("btn-danger");
            $("#ConfirmModal .reloadList").val(reloadList);

            $("#ConfirmModal #ConfirmForm").attr("action", "/event/cancel");
            $("#ConfirmModal #ConfirmForm").attr("method", "POST");

            $("#ConfirmModal .SelectedId").val( $(this).attr("id") );
            $("#ConfirmModal").modal("show");
            $("#EventActionModal").modal("hide");
             
    });








    $(document).on('click','.resumeEventBtn', {} ,function(e){
            e.preventDefault(); 

            var title = "RE OPEN EVENT";
            var message = "Are you sure you want to re open this event ?";

            var reloadList = "fullcalendar";

            $("#ConfirmModal .modal-title").html( title );
            $("#ConfirmModal .modal-message").html( message );

            $("#ConfirmModal .modal-header").removeClass("modal-danger");
            $("#ConfirmModal .action-confirm").removeClass("btn-danger");
            $("#ConfirmModal .modal-header").addClass("modal-success");
            $("#ConfirmModal .action-confirm").addClass("btn-success");
            $("#ConfirmModal .reloadList").val(reloadList);

            $("#ConfirmModal #ConfirmForm").attr("action", "/event/resume");
            $("#ConfirmModal #ConfirmForm").attr("method", "POST");

            $("#ConfirmModal .SelectedId").val( $(this).attr("id") );
            $("#ConfirmModal").modal("show");
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

                    if( ( data.status == "finished" ) || ( data.status == "ongoing" ) ){
                        $("#EventActionModal .cancelEventBtn").hide(); 
                        $("#EventActionModal .resumeEventBtn").hide(); 
                    }

                     $("#EventActionModal #SeletedID").attr( 'id', data.id );
                    $("#EventActionModal .resumeEventBtn").attr( 'id', data.id );
                    $("#EventActionModal .cancelEventBtn").attr( 'id', data.id );
                    $("#EventActionModal input[name='id']").val( data.id );
                    $("#EventActionModal input[name='speaker']").val( data.speaker );
                    $("#EventActionModal input[name='venue']").val( data.venue );
                    $("#EventActionModal input[name='start']").val( moment( data.start ).format('MM/DD/YYYY hh:mm A') );
                    $("#EventActionModal input[name='end']").val( moment( data.end ).format('MM/DD/YYYY hh:mm A') );
                    $("#EventActionModal input[name='title']").val( data.title ); 
                    $("#EventActionModal textarea[name='description']").html( data.description );
                   

                    $("#EventActionModal").modal("show");
                },
                error: function (data) {
                    alert(data.status);
                    }

            });
        

      });



















     $(document).on('submit','form#AddDeveloperForm', {} ,function(e){
            e.preventDefault();

            var data = new FormData(this);
            showLoadingGif();

            $.ajax({
            url: "/developers/add",
            type:"POST",
            async: false, 
            data: data, 
            success: function(data){

                    if($.isEmptyObject(data.error)){

                        $("body #wrapper #content").html(data.content);
                        $('body #wrapper #content').slideDown('slow');
                        reloadDataTable();

                        hideLoadingGif();


                        $("#SuccessModal .feedback-message").html( data.success );
                        $("#SuccessModal").modal("show");


                    }else{

                        $("#AddDeveloperForm .form-error.name").html(data.error['name']);
                        $("#AddDeveloperForm .form-error.contact").html(data.error['contact']);
                        $("#AddDeveloperForm .form-error.fax").html(data.error['fax']);
                        $("#AddDeveloperForm .form-error.address").html(data.error['address']);
                        $("#AddDeveloperForm .form-error.profile").html(data.error['profile']);



                    }                          

                
                },
                cache: false,
                contentType: false,
                processData: false,
                error: function (data) {
                    alert(data.status);
                    }

            });

            return false;
      });











      $(document).on('click','.actionUpdateDeveloper', {} ,function(e){

            var id = $(this).attr('id');

            $.ajax({
            url: "/developer/update",
            type:"GET", 
            data: {"id":id},
            success: function(data){   

                $(".overlay-fullscreen").removeClass("overlay-fullscreen-active");
                $(".overlay-fullscreen .view-overlay-content").html(data.content);
                $(".overlay-fullscreen").addClass("overlay-fullscreen-active");
                activateSummerNote();

                },
            error: function (data) {
                 alert(data.status);
                }

            });

            return false;
      });








      $(document).on('click','.actionSetActiveDeveloperShowModal', {} ,function(e){

            var title = "SET DEVELOPER TO ACTIVE";
            var message = "Are you sure you want to set this developer to active?";

            var reloadList = "";

            $("#ConfirmModal .modal-title").html( title );
            $("#ConfirmModal .modal-message").html( message );

            $("#ConfirmModal .modal-header").removeClass("modal-danger");
            $("#ConfirmModal .action-confirm").removeClass("btn-danger");
            $("#ConfirmModal .modal-header").addClass("modal-success");
            $("#ConfirmModal .action-confirm").addClass("btn-success");
            $("#ConfirmModal .reloadList").val(reloadList);

            $("#ConfirmModal #ConfirmForm").attr("action", "/developer/SetToActive");
            $("#ConfirmModal #ConfirmForm").attr("method", "POST");

            $("#ConfirmModal .SelectedId").val( $(this).attr("id") );
            $("#ConfirmModal").modal("show");

      });






      $(document).on('click','.actionSetNotActiveDeveloperShowModal', {} ,function(e){

            
            var title = "SET DEVELOPER TO NOT ACTIVE";
            var message = "Are you sure you want to set this developer to not active?";

            var reloadList = "";

            $("#ConfirmModal .modal-title").html( title );
            $("#ConfirmModal .modal-message").html( message );

            $("#ConfirmModal .modal-header").removeClass("modal-success");
            $("#ConfirmModal .action-confirm").removeClass("btn-success");
            $("#ConfirmModal .modal-header").addClass("modal-danger");
            $("#ConfirmModal .action-confirm").addClass("btn-danger");
            $("#ConfirmModal .reloadList").val(reloadList);

            $("#ConfirmModal #ConfirmForm").attr("action", "/developer/SetToNotActive");
            $("#ConfirmModal #ConfirmForm").attr("method", "POST");

            $("#ConfirmModal .SelectedId").val( $(this).attr("id") );
            $("#ConfirmModal").modal("show");


      });






        $(document).on('click','.actionViewDeveloper', {} ,function(e){


            var id = $(this).attr('id');

            $.ajax({
            url: "/developer/profile",
            type:"GET", 
            data: {"id":id},
            success: function(data){


                $(".overlay-fullscreen").removeClass("overlay-fullscreen-active");
                $(".overlay-fullscreen .view-overlay-content").html(data.content);
                $(".overlay-fullscreen").addClass("overlay-fullscreen-active");

                $('.tab-content').slimScroll({
                    height: '450px',
                    wheelStep: 2,
                });
                
                },
            error: function (data) {
                alert(data.status);
                }

            });

            return false;
      });




      $(document).on('submit','form#updateDeveloperInformationForm', {} ,function(e){
            e.preventDefault();

            var formdata = $(this).serializeArray();

            $.ajax({
            url: "/developers/updateDeveloperInformation",
            type:"POST", 
            data: formdata,
            success: function(data){   


                if($.isEmptyObject(data.error)){

                    $("#SuccessModal .feedback-message").html( data.success );
                    $("#SuccessModal").modal("show");

                    $("body #wrapper #content").html(data.content);
                    $('body #wrapper #content').slideDown('slow');
                    reloadDataTable();

                    $(".overlay-fullscreen").removeClass("overlay-fullscreen-active");
                    $(".overlay-fullscreen .view-overlay-content").html(data.overlay);
                    $(".overlay-fullscreen").addClass("overlay-fullscreen-active");

                    activateSummerNote();

                    $(".Developer_Information_Tab").trigger('click');

                }else{


                    $(".form-error").html("");
                    $(".form-error.name").html(data.error['name']);
                    $(".form-error.contact").html(data.error['contact']);
                    $(".form-error.address").html(data.error['address']);
                    $(".form-error.fax").html(data.error['fax']);


                }



                },
            error: function (data) {
                 alert(data.status);
                }

            });

            return false;
      });








      $(document).on('submit','form#updateDeveloperProfileForm', {} ,function(e){
            e.preventDefault();

            var formdata = $(this).serializeArray();

            $.ajax({
            url: "/developers/updateDeveloperProfile",
            type:"POST", 
            data: formdata,
            success: function(data){   


                if($.isEmptyObject(data.error)){

                    $("#SuccessModal .feedback-message").html( data.success );
                    $("#SuccessModal").modal("show");

                    $(".overlay-fullscreen").removeClass("overlay-fullscreen-active");
                    $(".overlay-fullscreen .view-overlay-content").html(data.overlay);
                    $(".overlay-fullscreen").addClass("overlay-fullscreen-active");

                    activateSummerNote();

                    $(".Developer_Profile_Tab").trigger('click');

                }



                },
            error: function (data) {
                 alert(data.status);
                }

            });

            return false;
      });





      $(document).on('submit','form#updateDeveloperLogo', {} ,function(e){
            e.preventDefault();

            var data = new FormData(this);

            $.ajax({
            url: "/developers/updateDeveloperLogo",
            type:"POST", 
            data: data,
            async: false, 
            success: function(data){   


                if($.isEmptyObject(data.error)){

                    $("#SuccessModal .feedback-message").html( data.success );
                    $("#SuccessModal").modal("show");

                    $(".overlay-fullscreen").removeClass("overlay-fullscreen-active");
                    $(".overlay-fullscreen .view-overlay-content").html(data.overlay);
                    $(".overlay-fullscreen").addClass("overlay-fullscreen-active");

                    activateSummerNote();

                     $(".Developer_Logo_Tab").trigger('click');

                }



                },
            error: function (data) {
                 alert(data.status);
                },
                cache: false,
                contentType: false,
                processData: false

            });

            return false;
      });







    $(document).on('click','.projects-menu', {} ,function(e){

            window.history.pushState( {}, '', '/projects');
            showLoadingGif();

            $.ajax({
            url: "/projects",
            type:"GET", 
            success: function(data){

                $("body #wrapper #content").html(data.content);
                $('body #wrapper #content').slideDown('slow');
                reloadDataTable();
                hideLoadingGif();
                
            },
            error: function (data) {
                alert(data.status);
                }
             });


    });


    $(document).on('click','.projects-menu-grid', {} ,function(e){

            window.history.pushState( {}, '', '/projects/grid');
            showLoadingGif();

            $.ajax({
            url: "/projects/grid",
            type:"GET", 
            success: function(data){

                $("body #wrapper #content").html(data.content);
                $('body #wrapper #content').slideDown('slow');
                reloadDataTable();
                hideLoadingGif();
                
            },
            error: function (data) {
                alert(data.status);
                }
             });


    });


    $(document).on('submit','form#searchProjectForm', {} ,function(e){
            e.preventDefault();

            showLoadingGif();

            var formdata = $(this).serializeArray();

            $.ajax({
            url: "/projects/search",
            type:"GET", 
            data: formdata,
            success: function(data){

                $("body #wrapper #content").html(data.content);
                $('body #wrapper #content').slideDown('slow');
                reloadDataTable();
                hideLoadingGif();
                
            },
            error: function (data) {
                alert(data.status);
                }
             });


    });




    $(document).on({

         mouseenter: function(){

            $(this).find(".project-address").show();
        },

         mouseleave: function(){
             $(this).find(".project-address").hide();

        }
    },'.product-container .item-lower-con');







     $(document).on('submit','form#AddProjectForm', {} ,function(e){
            e.preventDefault();

            var data = new FormData(this);
            showLoadingGif();

            $.ajax({
            url: "/projects/add",
            type:"POST",
            async: false, 
            data: data, 
            success: function(data){

                    if($.isEmptyObject(data.error)){

                        $("body #wrapper #content").html(data.content);
                        $('body #wrapper #content').slideDown('slow');
                        reloadDataTable();

                        hideLoadingGif();

                        $("#SuccessModal .feedback-message").html( data.success );
                        $("#SuccessModal").modal("show");


                    }else{

                        $("#AddDeveloperForm .form-error.project_name").html(data.error['project_name']);
                        $("#AddDeveloperForm .form-error.project_location").html(data.error['project_location']);



                    }                          

                
                },
                cache: false,
                contentType: false,
                processData: false,
                error: function (data) {
                    alert(data.status);
                    }

            });

            return false;
      });






        $(document).on('click','.actionViewProject', {} ,function(e){

            var id = $(this).attr('id');

            $.ajax({
            url: "/project/info",
            type:"GET", 
            data: {"id":id},
            success: function(data){


                $(".overlay-fullscreen").removeClass("overlay-fullscreen-active");
                $(".overlay-fullscreen .view-overlay-content").html(data.content);
                $(".overlay-fullscreen").addClass("overlay-fullscreen-active");

                $('.tab-content').slimScroll({
                    height: '450px',
                    wheelStep: 2,
                });
                
                },
            error: function (data) {
                alert(data.status);
                }

            });

            return false;
      });








      $(document).on('click','.actionSetActiveProjectShowModal', {} ,function(e){

            var title = "SET PROJECT TO ACTIVE";
            var message = "Are you sure you want to set this project to active?";

            var reloadList = "";

            $("#ConfirmModal .modal-title").html( title );
            $("#ConfirmModal .modal-message").html( message );

            $("#ConfirmModal .modal-header").removeClass("modal-danger");
            $("#ConfirmModal .action-confirm").removeClass("btn-danger");
            $("#ConfirmModal .modal-header").addClass("modal-success");
            $("#ConfirmModal .action-confirm").addClass("btn-success");
            $("#ConfirmModal .reloadList").val(reloadList);

            $("#ConfirmModal #ConfirmForm").attr("action", "/projects/SetToActive");
            $("#ConfirmModal #ConfirmForm").attr("method", "POST");

            $("#ConfirmModal .SelectedId").val( $(this).attr("id") );
            $("#ConfirmModal").modal("show");

      });






      $(document).on('click','.actionSetNotActiveProjectShowModal', {} ,function(e){

            
            var title = "SET PROJECT TO NOT ACTIVE";
            var message = "Are you sure you want to set this project to not active?";

            var reloadList = "";

            $("#ConfirmModal .modal-title").html( title );
            $("#ConfirmModal .modal-message").html( message );

            $("#ConfirmModal .modal-header").removeClass("modal-success");
            $("#ConfirmModal .action-confirm").removeClass("btn-success");
            $("#ConfirmModal .modal-header").addClass("modal-danger");
            $("#ConfirmModal .action-confirm").addClass("btn-danger");
            $("#ConfirmModal .reloadList").val(reloadList);

            $("#ConfirmModal #ConfirmForm").attr("action", "/projects/SetToNotActive");
            $("#ConfirmModal #ConfirmForm").attr("method", "POST");

            $("#ConfirmModal .SelectedId").val( $(this).attr("id") );
            $("#ConfirmModal").modal("show");


      });




      $(document).on('click','.actionUpdateProject', {} ,function(e){

            var id = $(this).attr('id');

            $.ajax({
            url: "/project/update",
            type:"GET", 
            data: {"id":id},
            success: function(data){   

                $(".overlay-fullscreen").removeClass("overlay-fullscreen-active");
                $(".overlay-fullscreen .view-overlay-content").html(data.content);
                $(".overlay-fullscreen").addClass("overlay-fullscreen-active");
                activateSummerNote();
                activateSlimScrollSelection();



                },
            error: function (data) {
                 alert(data.status);
                }

            });

            return false;
      });







      $(document).on('submit','form#updateProjectInformationForm', {} ,function(e){
            e.preventDefault();

            var formdata = $(this).serializeArray();

            $.ajax({
            url: "/project/updateProjectInformation",
            type:"POST", 
            data: formdata,
            success: function(data){   


                if($.isEmptyObject(data.error)){

                    $("#SuccessModal .feedback-message").html( data.success );
                    $("#SuccessModal").modal("show");

                    $("body #wrapper #content").html(data.content);
                    $('body #wrapper #content').slideDown('slow');
                    reloadDataTable();

                    $(".overlay-fullscreen").removeClass("overlay-fullscreen-active");
                    $(".overlay-fullscreen .view-overlay-content").html(data.overlay);
                    $(".overlay-fullscreen").addClass("overlay-fullscreen-active");

                    activateSummerNote();
                    activateSlimScrollSelection();

                    $(".Project_Information_Tab").trigger('click');

                }else{


                    $(".form-error").html("");
                    $(".form-error.project_name").html(data.error['project_name']);
                    $(".form-error.project_location").html(data.error['project_location']);


                }



                },
            error: function (data) {
                 alert(data.status);
                }

            });

            return false;
      });







      $(document).on('submit','form#updateProjectDeveloperForm', {} ,function(e){
            e.preventDefault();

            var formdata = $(this).serializeArray();

            $.ajax({
            url: "/project/updateProjectDeveloper",
            type:"POST", 
            data: formdata,
            success: function(data){   


                if($.isEmptyObject(data.error)){

                    $("#SuccessModal .feedback-message").html( data.success );
                    $("#SuccessModal").modal("show");

                    $("body #wrapper #content").html(data.content);
                    $('body #wrapper #content').slideDown('slow');
                    reloadDataTable();

                    $(".overlay-fullscreen").removeClass("overlay-fullscreen-active");
                    $(".overlay-fullscreen .view-overlay-content").html(data.overlay);
                    $(".overlay-fullscreen").addClass("overlay-fullscreen-active");

                    activateSummerNote();
                    activateSlimScrollSelection();

                    $(".Project_Developer_Tab").trigger('click');

                }else{


                    $("#ErrorModal .feedback-message").html( "Something went wrong!" );
                    $("#ErrorModal").modal("show");


                }



                },
            error: function (data) {
                 alert(data.status);
                }

            });

            return false;
      });




      $(document).on('submit','form#updateProjectCategoryForm', {} ,function(e){
            e.preventDefault();

            var formdata = $(this).serializeArray();

            $.ajax({
            url: "/project/updateProjectCategory",
            type:"POST", 
            data: formdata,
            success: function(data){   


                if($.isEmptyObject(data.error)){

                    $("#SuccessModal .feedback-message").html( data.success );
                    $("#SuccessModal").modal("show");

                    $("body #wrapper #content").html(data.content);
                    $('body #wrapper #content').slideDown('slow');
                    reloadDataTable();

                    $(".overlay-fullscreen").removeClass("overlay-fullscreen-active");
                    $(".overlay-fullscreen .view-overlay-content").html(data.overlay);
                    $(".overlay-fullscreen").addClass("overlay-fullscreen-active");

                    activateSummerNote();
                    activateSlimScrollSelection();

                    $(".Project_Category_Tab").trigger('click');

                }else{


                    $("#ErrorModal .feedback-message").html( "Something went wrong!" );
                    $("#ErrorModal").modal("show");


                }



                },
            error: function (data) {
                 alert(data.status);
                }

            });

            return false;
      });




      $(document).on('submit','form#updateProjectDescriptionForm', {} ,function(e){
            e.preventDefault();

            var formdata = $(this).serializeArray();

            $.ajax({
            url: "/project/updateProjectDescription",
            type:"POST", 
            data: formdata,
            success: function(data){   


                if($.isEmptyObject(data.error)){

                    $("#SuccessModal .feedback-message").html( data.success );
                    $("#SuccessModal").modal("show");

                    $("body #wrapper #content").html(data.content);
                    $('body #wrapper #content').slideDown('slow');
                    reloadDataTable();

                    $(".overlay-fullscreen").removeClass("overlay-fullscreen-active");
                    $(".overlay-fullscreen .view-overlay-content").html(data.overlay);
                    $(".overlay-fullscreen").addClass("overlay-fullscreen-active");

                    activateSummerNote();
                    activateSlimScrollSelection();


                    $(".Project_Description_Tab").trigger('click');

                }else{


                    $("#ErrorModal .feedback-message").html( "Something went wrong!" );
                    $("#ErrorModal").modal("show");


                }



                },
            error: function (data) {
                 alert(data.status);
                }

            });

            return false;
      });






      $(document).on('submit','form#updateProjectFeaturedPhotoForm', {} ,function(e){
            e.preventDefault();

            var formdata = new FormData(this);

            $.ajax({
            url: "/project/updateProjectFeaturedPhoto",
            type:"POST", 
            data: formdata,
            async: false, 
            cache: false,
            contentType: false,
            processData: false, 
            success: function(data){   


                if($.isEmptyObject(data.error)){

                    $("#SuccessModal .feedback-message").html( data.success );
                    $("#SuccessModal").modal("show");

                    $("body #wrapper #content").html(data.content);
                    $('body #wrapper #content').slideDown('slow');
                    reloadDataTable();

                    $(".overlay-fullscreen").removeClass("overlay-fullscreen-active");
                    $(".overlay-fullscreen .view-overlay-content").html(data.overlay);
                    $(".overlay-fullscreen").addClass("overlay-fullscreen-active");

                    activateSummerNote();
                    activateSlimScrollSelection();

                    $(".Project_Photos_Tab").trigger('click');

                }else{


                    $("#ErrorModal .feedback-message").html( data.error );
                    $("#ErrorModal").modal("show");


                }



                },
            error: function (data) {
                 alert(data.status);
                }

            });

            return false;
      });





      $(document).on('submit','form#updateProjectAdditionalPhotosForm', {} ,function(e){
            e.preventDefault();

            var formdata = new FormData(this);

            $.ajax({
            url: "/project/updateProjectAdditionalPhotos",
            type:"POST", 
            data: formdata,
            async: false, 
            cache: false,
            contentType: false,
            processData: false, 
            success: function(data){   


                if($.isEmptyObject(data.error)){

                    $("#SuccessModal .feedback-message").html( data.success );
                    $("#SuccessModal").modal("show");

                    $("body #wrapper #content").html(data.content);
                    $('body #wrapper #content').slideDown('slow');
                    reloadDataTable();

                    $(".overlay-fullscreen").removeClass("overlay-fullscreen-active");
                    $(".overlay-fullscreen .view-overlay-content").html(data.overlay);
                    $(".overlay-fullscreen").addClass("overlay-fullscreen-active");

                    activateSummerNote();
                    activateSlimScrollSelection();

                     $(".Project_Photos_Tab").trigger('click');

                }else{


                    $("#ErrorModal .feedback-message").html( data.error );
                    $("#ErrorModal").modal("show");


                }



                },
            error: function (data) {
                 alert(data.status);
                }

            });

            return false;
      });




      $(document).on('click','form#deleteProjectAdditionalPhotoForm22', {} ,function(e){
            e.preventDefault();

            var formdata = $(this).serializeArray();

            $.ajax({
            url: "/project/deleteProjectAdditionalPhoto",
            type:"POST", 
            data: formdata,
            success: function(data){   


                if($.isEmptyObject(data.error)){

                    $("#SuccessModal .feedback-message").html( data.success );
                    $("#SuccessModal").modal("show");

                    $("body #wrapper #content").html(data.content);
                    $('body #wrapper #content').slideDown('slow');
                    reloadDataTable();

                    $(".overlay-fullscreen").removeClass("overlay-fullscreen-active");
                    $(".overlay-fullscreen .view-overlay-content").html(data.overlay);
                    $(".overlay-fullscreen").addClass("overlay-fullscreen-active");

                    activateSummerNote();
                    activateSlimScrollSelection();

                    $(".Project_Photos_Tab").trigger('click');

                }else{


                    $("#ErrorModal .feedback-message").html( "Something went wrong!" );
                    $("#ErrorModal").modal("show");


                }



                },
            error: function (data) {
                 alert(data.status);
                }

            });

            return false;
      });





      $(document).on('click','.actionDeleteAdditionalPhoto', {} ,function(e){

            
            var title = "DELETE PHOTO!";
            var message = "Are you sure you want to delete this photo? <br> Note : This action cannot be undo.";

            var reloadList = "DeletePhoto";

            $("#ConfirmModal .modal-title").html( title );
            $("#ConfirmModal .modal-message").html( message );

            $("#ConfirmModal .modal-header").removeClass("modal-success");
            $("#ConfirmModal .action-confirm").removeClass("btn-success");
            $("#ConfirmModal .modal-header").addClass("modal-danger");
            $("#ConfirmModal .action-confirm").addClass("btn-danger");
            $("#ConfirmModal .reloadList").val(reloadList);

            $("#ConfirmModal #ConfirmForm").attr("action", "/project/deleteProjectAdditionalPhoto");
            $("#ConfirmModal #ConfirmForm").attr("method", "POST");

            $("#ConfirmModal .SelectedId").val( $(this).attr("id") );
            $("#ConfirmModal").modal("show");


      });






      $(document).on('click','.actionViewAdditionalPhoto', {} ,function(e){
            e.preventDefault();

            
            var id = $(this).attr('id');

            $.ajax({
            url: "/project/viewProjectPhoto",
            type:"GET", 
            data: { 'id' : id }, 
            success: function(data){   


                if($.isEmptyObject(data.error)){

                    $("#ViewPhotoModal #projectPhotoView").attr('src', data.photo );
                    $("#ViewPhotoModal").modal("show");

                }else{


                    $("#ErrorModal .feedback-message").html( "Something went wrong!" );
                    $("#ErrorModal").modal("show");


                }



                },
            error: function (data) {
                 alert(data.status);
                }

            });

            return false;
      });





     $(document).on('change','#project_photos', {} ,function(e){
        $(".btn-file-project-photos span").html( "Add Photos - ( " + this.files.length + " ) photos selected." );
        
            if(this.files.length>15){
                $('#AlertModal .modal-message').html( 'Too many files selected. Maximum files to upload is 15.' );
                $('#AlertModal').modal("show");
                $(".addAdditionalPhotoBtn").hide();
            }else{
                $(".addAdditionalPhotoBtn").show();
            }
        });





     $(document).on('submit','form#AddSalesForm', {} ,function(e){
            e.preventDefault();

            var formdata = $(this).serializeArray();
            showLoadingGif();

            $.ajax({
            url: "/sales/add",
            type:"POST", 
            data: formdata, 
            success: function(data){

                    if($.isEmptyObject(data.error)){

                        $("body #wrapper #content").html(data.content);
                        $('body #wrapper #content').slideDown('slow');
                        reloadDataTable();

                        hideLoadingGif();

                        $("#SuccessModal .feedback-message").html( data.success );
                        $("#SuccessModal").modal("show");


                    }else{

                        $("#ErrorModal .feedback-message").html( "Something went wrong." );
                        $("#ErrorModal").modal("show");

                    }                          

                
                },
                error: function (data) {
                    alert(data.status);
                    }

            });

            return false;
      });





      $(document).on('click','.cancelSalesBtn', {} ,function(e){

            
            var title = "CANCEL SALES!";
            var message = "Are you sure you want to cancel this sales?";

            var reloadList = "";

            $("#ConfirmModal .modal-title").html( title );
            $("#ConfirmModal .modal-message").html( message );

            $("#ConfirmModal .modal-header").removeClass("modal-success");
            $("#ConfirmModal .action-confirm").removeClass("btn-success");
            $("#ConfirmModal .modal-header").addClass("modal-danger");
            $("#ConfirmModal .action-confirm").addClass("btn-danger");
            $("#ConfirmModal .reloadList").val(reloadList);

            $("#ConfirmModal #ConfirmForm").attr("action", "/sales/cancel");
            $("#ConfirmModal #ConfirmForm").attr("method", "POST");

            $("#ConfirmModal .SelectedId").val( $(this).attr("id") );
            $("#ConfirmModal").modal("show");


      });






      $(document).on('click','.unCancelSalesBtn', {} ,function(e){

            
            var title = "UNCANCEL SALES!";
            var message = "Are you sure you want to uncancel this sales?";

            var reloadList = "";

            $("#ConfirmModal .modal-title").html( title );
            $("#ConfirmModal .modal-message").html( message );

            $("#ConfirmModal .modal-header").removeClass("modal-danger");
            $("#ConfirmModal .action-confirm").removeClass("btn-danger");
            $("#ConfirmModal .modal-header").addClass("modal-success");
            $("#ConfirmModal .action-confirm").addClass("btn-success");
            $("#ConfirmModal .reloadList").val(reloadList);

            $("#ConfirmModal #ConfirmForm").attr("action", "/sales/uncancel");
            $("#ConfirmModal #ConfirmForm").attr("method", "POST");

            $("#ConfirmModal .SelectedId").val( $(this).attr("id") );
            $("#ConfirmModal").modal("show");


      });



      $(document).on('click','.approveSalesBtn', {} ,function(e){

            
            var title = "APPROVE SALES!";
            var message = "Are you sure you want to approve this sales?";

            var reloadList = "";

            $("#ConfirmModal .modal-title").html( title );
            $("#ConfirmModal .modal-message").html( message );

            $("#ConfirmModal .modal-header").removeClass("modal-danger");
            $("#ConfirmModal .action-confirm").removeClass("btn-danger");
            $("#ConfirmModal .modal-header").addClass("modal-success");
            $("#ConfirmModal .action-confirm").addClass("btn-success");
            $("#ConfirmModal .reloadList").val(reloadList);

            $("#ConfirmModal #ConfirmForm").attr("action", "/sales/approve");
            $("#ConfirmModal #ConfirmForm").attr("method", "POST");

            $("#ConfirmModal .SelectedId").val( $(this).attr("id") );
            $("#ConfirmModal").modal("show");


      });




        $(document).on('click','.viewSalesDetails', {} ,function(e){


            var id = $(this).attr('id');

            $.ajax({
            url: "/sales/details",
            type:"GET", 
            data: {"id":id},
            success: function(data){


                $(".overlay-fullscreen").removeClass("overlay-fullscreen-active");
                $(".overlay-fullscreen .view-overlay-content").html(data.content);
                $(".overlay-fullscreen").addClass("overlay-fullscreen-active");

                $('.project-description-con').slimScroll({
                    height: '299px',
                    wheelStep: 2,
                });

                MakeSalesDetailsPrintable();


                
                },
            error: function (data) {
                alert(data.status);
                }

            });

            return false;
      });






    $(document).on('click',"#printSalesDetailsBtn", {} ,function(e){
        $(".panel-sales .buttons-print").trigger("click"); //trigger the click event
    });



        $(document).on('click','.viewSalesDetails111', {} ,function(e){


            var id = $(this).attr('id');

            $.ajax({
            url: "/sales/details",
            type:"GET", 
            data: {"id":id},
            success: function(data){


                $(".overlay-fullscreen").removeClass("overlay-fullscreen-active");
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

            return false;
      });








     $(document).on('submit','form#updateSalesForm', {} ,function(e){
            e.preventDefault();

            var formdata = $(this).serializeArray();


            $.ajax({
            url: "/sales/updateSales",
            type:"POST", 
            data: formdata, 
            success: function(data){



                    if($.isEmptyObject(data.error)){

                        $("body #wrapper #content").html(data.content);
                        $('body #wrapper #content').slideDown('slow');
                        reloadDataTable();

                        $(".overlay-fullscreen").removeClass("overlay-fullscreen-active");

                        $("#SuccessModal .feedback-message").html( data.success );
                        $("#SuccessModal").modal("show");


                    }else{

                        $(".form-error").html();
                        $(".form-error.date_reserve").html(data.error['date_reserve']);
                        $(".form-error.contract_price").html(data.error['contract_price']);
                        $(".form-error.lastname").html(data.error['lastname']);
                        $(".form-error.firstname").html(data.error['firstname']);
                        $(".form-error.middlename").html(data.error['middlename']);


                    }                          

                
                },
                error: function (data) {
                    alert(data.status);
                    }

            });

            return false;
      });








































        $(document).on('click','.updateSalesShowForm', {} ,function(e){


            var id = $(this).attr('id');

            $.ajax({
            url: "/sales/update",
            type:"GET", 
            data: {"id":id},
            success: function(data){


                $(".overlay-fullscreen").removeClass("overlay-fullscreen-active");
                $(".overlay-fullscreen .view-overlay-content").html(data.content);
                $(".overlay-fullscreen").addClass("overlay-fullscreen-active");

                $('.project-description-con').slimScroll({
                    height: '299px',
                    wheelStep: 2,
                });
                
                $('.datepicker').datetimepicker({
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

            return false;
      });








     $(document).on('submit','form#updateSalesProjectForm', {} ,function(e){
            e.preventDefault();

            var formdata = $(this).serializeArray();
            

            $.ajax({
            url: "/sales/updateSalesProject",
            type:"POST", 
            data: formdata, 
            success: function(data){

                    if($.isEmptyObject(data.error)){

                        $("body #wrapper #content").html(data.content);
                        $('body #wrapper #content').slideDown('slow');
                        reloadDataTable();

                        $(".overlay-fullscreen").removeClass("overlay-fullscreen-active");
                        $(".overlay-fullscreen .view-overlay-content").html(data.overlay);
                        $(".overlay-fullscreen").addClass("overlay-fullscreen-active");

                        $('.project-description-con').slimScroll({
                            height: '299px',
                            wheelStep: 2,
                        });
                        
                        $('.datepicker').datetimepicker({
                            viewMode: 'months',
                            format: 'YYYY/MM/DD',
                            maxDate: moment(),
                            minDate: moment().subtract(60, 'years').startOf('year')
                        });

                        $(".Project_Tab").trigger('click');


                        $("#SuccessModal .feedback-message").html( data.success );
                        $("#SuccessModal").modal("show");


                    }else{

                        $("#ErrorModal .feedback-message").html( "Something went wrong." );
                        $("#ErrorModal").modal("show");

                    }                          

                
                },
                error: function (data) {
                    alert(data.status);
                    }

            });

            return false;
      });





     $(document).on('submit','form#updateSalesContractForm', {} ,function(e){
            e.preventDefault();

            var formdata = $(this).serializeArray();
            

            $.ajax({
            url: "/sales/updateSalesContract",
            type:"POST", 
            data: formdata, 
            success: function(data){

                    if($.isEmptyObject(data.error)){

                        $("body #wrapper #content").html(data.content);
                        $('body #wrapper #content').slideDown('slow');
                        reloadDataTable();

                        $(".overlay-fullscreen").removeClass("overlay-fullscreen-active");
                        $(".overlay-fullscreen .view-overlay-content").html(data.overlay);
                        $(".overlay-fullscreen").addClass("overlay-fullscreen-active");

                        $('.project-description-con').slimScroll({
                            height: '299px',
                            wheelStep: 2,
                        });
                        
                        $('.datepicker').datetimepicker({
                            viewMode: 'months',
                            format: 'YYYY/MM/DD',
                            maxDate: moment(),
                            minDate: moment().subtract(60, 'years').startOf('year')
                        });

                         $(".Contract_Tab").trigger('click');

                        $("#SuccessModal .feedback-message").html( data.success );
                        $("#SuccessModal").modal("show");


                    }else{

                        $(".form-error").html("");
                        $("#updateSalesContractForm .form-error.date_reserve").html(data.error['date_reserve']);
                        $("#updateSalesContractForm .form-error.contract_price").html(data.error['contract_price']);

                    }                          

                
                },
                error: function (data) {
                    alert(data.status);
                    }

            });

            return false;
      });





     $(document).on('submit','form#updateSalesAgeFormnt', {} ,function(e){
            e.preventDefault();

            var formdata = $(this).serializeArray();
            

            $.ajax({
            url: "/sales/updateSalesAgent",
            type:"POST", 
            data: formdata, 
            success: function(data){

                    if($.isEmptyObject(data.error)){

                        $("body #wrapper #content").html(data.content);
                        $('body #wrapper #content').slideDown('slow');
                        reloadDataTable();

                        $(".overlay-fullscreen").removeClass("overlay-fullscreen-active");
                        $(".overlay-fullscreen .view-overlay-content").html(data.overlay);
                        $(".overlay-fullscreen").addClass("overlay-fullscreen-active");

                        $('.project-description-con').slimScroll({
                            height: '299px',
                            wheelStep: 2,
                        });
                        
                        $('.datepicker').datetimepicker({
                            viewMode: 'months',
                            format: 'YYYY/MM/DD',
                            maxDate: moment(),
                            minDate: moment().subtract(60, 'years').startOf('year')
                        });

                         $(".Agent_Tab").trigger('click');

                        $("#SuccessModal .feedback-message").html( data.success );
                        $("#SuccessModal").modal("show");


                    }else{

                        $(".form-error").html("");
                        $("#updateSalesContractForm .form-error.date_reserve").html(data.error['date_reserve']);
                        $("#updateSalesContractForm .form-error.contract_price").html(data.error['contract_price']);

                    }                          

                
                },
                error: function (data) {
                    alert(data.status);
                    }

            });

            return false;
      });







     $(document).on('submit','form#updateSalesClientForm', {} ,function(e){
            e.preventDefault();

            var formdata = $(this).serializeArray();
            

            $.ajax({
            url: "/sales/updateSalesClient",
            type:"POST", 
            data: formdata, 
            success: function(data){

                    if($.isEmptyObject(data.error)){

                        $("body #wrapper #content").html(data.content);
                        $('body #wrapper #content').slideDown('slow');
                        reloadDataTable();

                        $(".overlay-fullscreen").removeClass("overlay-fullscreen-active");
                        $(".overlay-fullscreen .view-overlay-content").html(data.overlay);
                        $(".overlay-fullscreen").addClass("overlay-fullscreen-active");

                        $('.project-description-con').slimScroll({
                            height: '299px',
                            wheelStep: 2,
                        });
                        
                        $('.datepicker').datetimepicker({
                            viewMode: 'months',
                            format: 'YYYY/MM/DD',
                            maxDate: moment(),
                            minDate: moment().subtract(60, 'years').startOf('year')
                        });

                         $(".Client_Tab").trigger('click');
                         
                        $("#SuccessModal .feedback-message").html( data.success );
                        $("#SuccessModal").modal("show");


                    }else{

                        $(".form-error").html("");
                        $("#updateSalesContractForm .form-error.date_reserve").html(data.error['date_reserve']);
                        $("#updateSalesContractForm .form-error.contract_price").html(data.error['contract_price']);

                    }                          

                
                },
                error: function (data) {
                    alert(data.status);
                    }

            });

            return false;
      });






     $(document).on('change','#FilterYearChart', {} ,function(e){
         e.preventDefault();

                var year =  $(this).val();

                activateChart(year);

     
     });




     $(document).on('click','#notifications_menu', {} ,function(e){
         e.preventDefault();

             //$.get('/notifications/markAsRead');

     
     });







    $( "#Filter_By_Date_From, #Filter_By_Date_To" ).datepicker({  
            changeMonth: true,
            changeYear: true,
            showButtonPanel: false,
            dateFormat: 'MM dd yy',

            minDate: "-20Y",
            maxDate: new Date,
            yearRange: 'c-100:c+10', 

            onClose: function(dateText, inst) { 
                var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
                var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                var day = $("#ui-datepicker-div .ui-datepicker-day :selected").val();
                //alert( day );
                //$(this).datepicker('setDate', new Date(year, month, day));
            }

        });



    //$( "#Filter_By_Date_From, #Filter_By_Date_To" ).val( moment().format("MMMM YYYY"));

    //$("#btnShow").click(function(){ 
    //if ($("#Filter_By_Date_From").val().length == 0 || $("#Filter_By_Date_To").val().length == 0){
    //    alert('All fields are required');
    //}
    //else{
    //    alert('Selected Month Range :'+ $("#Filter_By_Date_From").val() + ' to ' + $("#Filter_By_Date_To").val());
    //    }
    //})


   

     $(document).on('change','#Filter_Get_Top', {} ,function(e){
         e.preventDefault();

            var val =  $(this).val();
            
            if( val == "CUSTOM"){
                $("#Filter_Get_Top_Input").show();
                $(".input-group-con").addClass('input-group');
            }else{
                $("#Filter_Get_Top_Input").hide();
                $(".input-group-con").removeClass('input-group');
            }


     
     });





     $(document).on('change','#Filter_By', {} ,function(e){
         e.preventDefault();

            var val =  $(this).val();
            
            if( val == "RANK"){

                $(".filter_by_rank").show();
                $(".filter_by_group").hide();
                $(".filter_by_personal").hide();
                $(".filter_by_developers").hide();

                $(".filter_by_top").show();
                $(".filter_by_personal_agent").hide();
                $(".filter_by_personal_developers").hide();

            }else if( val == "GROUP"){

                $(".filter_by_rank").hide();
                $(".filter_by_group").show();
                $(".filter_by_personal").hide();
                $(".filter_by_developers").hide();
                
                $(".filter_by_top").hide();
                $(".filter_by_personal_agent").hide();
                $(".filter_by_personal_developers").hide();

            }else if( val == "PERSONAL_AGENT"){

                $(".filter_by_rank").hide();
                $(".filter_by_group").hide();
                $(".filter_by_personal").show();
                $(".filter_by_developers").hide();

                $(".filter_by_top").hide();
                $(".filter_by_personal_agent").show();
                $(".filter_by_personal_developers").hide();

            }else if( val == "PERSONAL_DEVELOPER"){

                $(".filter_by_rank").hide();
                $(".filter_by_group").hide();
                $(".filter_by_personal").show();
                $(".filter_by_developers").hide();

                $(".filter_by_top").hide();
                $(".filter_by_personal_agent").hide();
                $(".filter_by_personal_developers").show();

            }else{

                $(".filter_by_rank").hide();
                $(".filter_by_group").hide();
                $(".filter_by_personal").hide();
                $(".filter_by_developers").show();

                $(".filter_by_top").show();
                $(".filter_by_personal_agent").hide();
                $(".filter_by_personal_developers").hide();
            }

     
     });





     $(document).on('submit','#Filter_Reports_Form', {} ,function(e){
         e.preventDefault();

            var formdata = $(this).serializeArray();
            showLoadingGif();

            $.ajax({
            url: "/reports/filters",
            type:"GET",
            data: formdata, 
            async: false,
            success: function(data){

                if($.isEmptyObject(data.error)){

                    $("body #wrapper #Reports-Table-con").html(data.content);


                    reloadDataTable_WithPrint( data.header_title );

                    if( data.count ){

                        $("#printBtn").show();
                        $("#pdfBtn").show();
                        $("#excelBtn").show();

                    }else{

                        $("#printBtn").hide(); 
                        $("#pdfBtn").hide();
                        $("#excelBtn").hide();                   
                    }
                          

                    hideLoadingGif();                      

                }else{

                     hideLoadingGif();

                    $("#ErrorModal .feedback-message").html( data.error['filter_by_date_from'] +"<br>"+ data.error['filter_by_date_to'] );
                    $("#ErrorModal").modal("show");
                }
                

            },
            error: function (data) {
                alert(data.status);
                }
             });


     });


    $(document).on('click',"#printBtn", {} ,function(e){
        $(".buttons-print").trigger("click"); //trigger the click event
    });

     $(document).on('click',"#excelBtn", {} ,function(e){
        $(".buttons-excel").trigger("click"); //trigger the click event
    });


     $(document).on('click',"#pdfBtn", {} ,function(e){
        $(".buttons-pdf").trigger("click"); //trigger the click event
    });




     $(document).on('click','.notification-action li', {} ,function(e){
         e.preventDefault();

          var notification_type = $(this).attr('type').split("\\")[2];
          var notification_id= $(this).attr('id');

          $.ajax({
              url: "/notification",
              type:"GET",
              data: { 'id' : notification_id , 'type' : notification_type }, 
              success: function(data){

                 $("#Notification-Content").html( data.content );
                  

              },
              error: function (data) {
                  alert(data.status);
                  }
               });



     
     });






    if (window.location.pathname == "/users/agent/add"){
      

        if( $("input[name='affiliate']").val() == "1"){

          $(".affiliated_content").show();

        }else{

          $(".affiliated_content").hide();

        }



    }



     $(document).on('change',"input[name='affiliate']", {} ,function(e){
       
       if( $(this).val() == "1"){

          $(".affiliated_content").show();

        }else{

          $(".affiliated_content").hide();

        }

     
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


            $('.user-picture-container img').attr('src', img);
            $(".user-picture-container input[name='avatar']").val(img);
            $(".user-picture-container input[name='featured_photo']").val(img);

            $('#CropboxModal').modal('hide');
            
        })



        $('#btnZoomIn').on('click', function(){
            cropper.zoomIn();
        })


        $('#btnZoomOut').on('click', function(){
            cropper.zoomOut();
        })
    });