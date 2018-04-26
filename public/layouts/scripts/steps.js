function activateAgentSteps(){


	$(".AddAgentSteps").steps({
        headerTag: "h2",
        bodyTag: "section",
        transitionEffect: "slideLeft",
        onStepChanging: function( event, currentIndex, newIndex ){

        	var next = false;

        	if( currentIndex == 0 ){

        		next = false;

        		var formdata = $("form#UserAccountForm").serializeArray();

				 $.ajax({
			        url: "/users/account/validate",
			        type:"POST", 
			        data: formdata,
			        async: false,
			        success: function(data){

			        	if($.isEmptyObject(data.error)){

			        		$(".form-error").html("");
			        		$("#AddAgentForm input[name='email']").val( $("form#UserAccountForm input[name='email']").val() );
			        		$("#AddAgentForm input[name='password']").val( $("form#UserAccountForm input[name='password']").val() );

			        		next = true;
			        		return true;

		                }else{

		                	$(".form-error").html("");
		                    $(".form-error.email").html(data.error['email']);
		                    $(".form-error.password").html(data.error['password']);
		                    $(".form-error.password_confirmation").html(data.error['password_confirmation']);

		                }    
			        }



			    });

        	}


        	if( currentIndex == 1 ){

        		next = false;

        		var formdata = $("form#UserAdditionalInfoForm").serializeArray();

				 $.ajax({
			        url: "/users/additinalinfo/validate",
			        type:"POST", 
			        data: formdata,
			        async: false,
			        success: function(data){

			        	if($.isEmptyObject(data.error)){

			        		$(".form-error").html("");
			        		$("#AddAgentForm input[name='lastname']").val( $("form#UserAdditionalInfoForm input[name='lastname']").val() );
			        		$("#AddAgentForm input[name='firstname']").val( $("form#UserAdditionalInfoForm input[name='firstname']").val() );
			        		$("#AddAgentForm input[name='middlename']").val( $("form#UserAdditionalInfoForm input[name='middlename']").val() );
			        		next = true;
			        		return true;

		                }else{

		                	$(".form-error").html("");
		                    $(".form-error.firstname").html(data.error['firstname']);
		                    $(".form-error.lastname").html(data.error['lastname']);
		                    $(".form-error.middlename").html(data.error['middlename']);

		                }    
			        }



			    });

        	}

        	if( currentIndex == 3 ){

        		
        		$("#AddAgentForm input[name='rank-name']").val( $("input[name='rank']:checked").closest('tr').find(".rank").html() );
        		$("#AddAgentForm input[name='rank']").val( $("input[name='rank']:checked").val() );

        		next = true;
			    return true;

        	}


        	if( currentIndex == 4 ){

        		if( $("input[name='recruiter']:checked").length != 0 ){

	        		$("#AddAgentForm input[name='recruiter-name']").val( $("input[name='recruiter']:checked").closest('tr').find(".recruiter").html() );
	        		$("#AddAgentForm input[name='recruiter']").val( $("input[name='recruiter']:checked").val() );

	        		next = true;
				    return true;
				}

				next = false;
				return false;
				
        	}

        	if( currentIndex == 2 ){

        		next = true;
			    return true;

        	}

        	if( currentIndex == 6 ){

        		next = true;
			    return true;

        	}


        	if( currentIndex == 5 ){

        		if( $("input[name='affiliate']:checked").val() == 1 ){


	        		if( $("input[name='developer']:checked").length != 0 ){

		        		$("#AddAgentForm input[name='developer-name']").val( $("input[name='developer']:checked").closest('tr').find(".developer-name").html() );
		        		$("#AddAgentForm input[name='developer']").val( $("input[name='developer']:checked").val() );
		        		$("#affiliated_con").show();

		        		next = true;
					    return true;


					}else{
						
						next = false;
						return false;
					}


				}

				$(".affiliated_con").hide();
				$("#AddAgentForm input[name='developer']").val('0');

				next = true;
				return true;

				
        	}



        	return next ;

        

        },
        onFinished: function (event, currentIndex){

        	var form = $("form#AddAgentForm");
            form.submit();


		}



	});


	$('.RecruitersTable-con').slimScroll({
		height: '223px',
		wheelStep: 2,
	});

}





function activateStaffSteps(){


	$(".AddStaffSteps").steps({
        headerTag: "h2",
        bodyTag: "section",
        transitionEffect: "slideLeft",
        onStepChanging: function( event, currentIndex, newIndex ){

        	var next = false;

        	if( currentIndex == 0 ){

        		next = false;

        		var formdata = $("form#UserAccountForm").serializeArray();

				 $.ajax({
			        url: "/users/account/validate",
			        type:"POST", 
			        data: formdata,
			        async: false,
			        success: function(data){

			        	if($.isEmptyObject(data.error)){

			        		$(".form-error").html("");
			        		$("#AddStaffForm input[name='email'], #AddStaffForm input[name='email']").val( $("form#UserAccountForm input[name='email']").val() );
			        		$("#AddStaffForm input[name='password'], #AddStaffForm input[name='password']").val( $("form#UserAccountForm input[name='password']").val() );

			        		next = true;
			        		return true;

		                }else{

		                	$(".form-error").html("");
		                    $(".form-error.email").html(data.error['email']);
		                    $(".form-error.password").html(data.error['password']);
		                    $(".form-error.password_confirmation").html(data.error['password_confirmation']);

		                }    
			        }



			    });

        	}


        	if( currentIndex == 1 ){

        		next = false;

        		var formdata = $("form#UserAdditionalInfoForm").serializeArray();

				 $.ajax({
			        url: "/users/additinalinfo/validate",
			        type:"POST", 
			        data: formdata,
			        async: false,
			        success: function(data){

			        	if($.isEmptyObject(data.error)){

			        		$(".form-error").html("");
			        		$("#AddStaffForm input[name='lastname'], #AddStaffForm input[name='lastname']").val( $("form#UserAdditionalInfoForm input[name='lastname']").val() );
			        		$("#AddStaffForm input[name='firstname'], #AddStaffForm input[name='firstname']").val( $("form#UserAdditionalInfoForm input[name='firstname']").val() );
			        		$("#AddStaffForm input[name='middlename'], #AddStaffForm input[name='middlename']").val( $("form#UserAdditionalInfoForm input[name='middlename']").val() );
			        		next = true;
			        		return true;

		                }else{

		                	$(".form-error").html("");
		                    $(".form-error.firstname").html(data.error['firstname']);
		                    $(".form-error.lastname").html(data.error['lastname']);
		                    $(".form-error.middlename").html(data.error['middlename']);

		                }    
			        }



			    });

        	}

     
        	if( currentIndex == 2 ){

        		next = true;
			    return true;

        	}

        	if( currentIndex == 3 ){

        		next = true;
			    return true;

        	}




        	return next ;

        

        },
        onFinished: function (event, currentIndex){

        	var form = $("form#AddStaffForm");
            form.submit();


		}



	});

}




function activateAdminSteps(){


	$(".AddAdminSteps").steps({
        headerTag: "h2",
        bodyTag: "section",
        transitionEffect: "slideLeft",
        onStepChanging: function( event, currentIndex, newIndex ){

        	var next = false;

        	if( currentIndex == 0 ){

        		next = false;

        		var formdata = $("form#UserAccountForm").serializeArray();

				 $.ajax({
			        url: "/users/account/validate",
			        type:"POST", 
			        data: formdata,
			        async: false,
			        success: function(data){

			        	if($.isEmptyObject(data.error)){

			        		$(".form-error").html("");
			        		$("#AddAdminSteps input[name='email'], #AddAdminForm input[name='email']").val( $("form#UserAccountForm input[name='email']").val() );
			        		$("#AddAdminSteps input[name='password'], #AddAdminForm input[name='password']").val( $("form#UserAccountForm input[name='password']").val() );

			        		next = true;
			        		return true;

		                }else{

		                	$(".form-error").html("");
		                    $(".form-error.email").html(data.error['email']);
		                    $(".form-error.password").html(data.error['password']);
		                    $(".form-error.password_confirmation").html(data.error['password_confirmation']);

		                }    
			        }



			    });

        	}


        	if( currentIndex == 1 ){

        		next = false;

        		var formdata = $("form#UserAdditionalInfoForm").serializeArray();

				 $.ajax({
			        url: "/users/additinalinfo/validate",
			        type:"POST", 
			        data: formdata,
			        async: false,
			        success: function(data){

			        	if($.isEmptyObject(data.error)){

			        		$(".form-error").html("");
			        		$("#AddAdminSteps input[name='lastname'], #AddAdminForm input[name='lastname']").val( $("form#UserAdditionalInfoForm input[name='lastname']").val() );
			        		$("#AddAdminSteps input[name='firstname'], #AddAdminForm input[name='firstname']").val( $("form#UserAdditionalInfoForm input[name='firstname']").val() );
			        		$("#AddAdminSteps input[name='middlename'], #AddAdminForm input[name='middlename']").val( $("form#UserAdditionalInfoForm input[name='middlename']").val() );
			        		next = true;
			        		return true;

		                }else{

		                	$(".form-error").html("");
		                    $(".form-error.firstname").html(data.error['firstname']);
		                    $(".form-error.lastname").html(data.error['lastname']);
		                    $(".form-error.middlename").html(data.error['middlename']);

		                }    
			        }



			    });

        	}

     
        	if( currentIndex == 2 ){

        		next = true;
			    return true;

        	}

        	if( currentIndex == 3 ){

        		next = true;
			    return true;

        	}




        	return next ;

        

        },
        onFinished: function (event, currentIndex){

        	var form = $("form#AddAdminForm");
            form.submit();


		}



	});

}





function activateDeveloperSteps(){


	$(".AddDevloperSteps").steps({
        headerTag: "h2",
        bodyTag: "section",
        transitionEffect: "slideLeft",
        onStepChanging: function( event, currentIndex, newIndex ){

        	var next = false;

        	if( currentIndex == 0 ){

        		next = false;

        		var formdata = $("form#DeveloperBasicInfoForm").serializeArray();

				 $.ajax({
			        url: "/developer/add/validate/basicinformation",
			        type:"POST", 
			        data: formdata,
			        async: false,
			        success: function(data){

			        	if($.isEmptyObject(data.error)){

			        		$(".form-error").html("");
			        		$("#AddDeveloperForm input[name='name']").val( $("form#DeveloperBasicInfoForm input[name='name']").val() );
			        		$("#AddDeveloperForm input[name='address']").val( $("form#DeveloperBasicInfoForm input[name='address']").val() );
			        		$("#AddDeveloperForm input[name='contact']").val( $("form#DeveloperBasicInfoForm input[name='contact']").val() );
			        		$("#AddDeveloperForm input[name='fax']").val( $("form#DeveloperBasicInfoForm input[name='fax']").val() );

			        		next = true;
			        		return true;

		                }else{

		                	$(".form-error").html("");
		                    $(".form-error.name").html(data.error['name']);
		                    $(".form-error.contact").html(data.error['contact']);
		                    $(".form-error.address").html(data.error['address']);
		                    $(".form-error.fax").html(data.error['fax']);

		                }    
			        }



			    });

        	}


        	if( currentIndex == 1 ){

        		$("#AddDeveloperForm textarea[name='profile']").html( $("#company_profile").val() );
        		$(".developer-profile-con").html( $("#company_profile").val() );
        		next = true;
			    return true;

        	}

     
        	if( currentIndex == 2 ){

        		next = true;
			    return true;

        	}

        	if( currentIndex == 3 ){

        		next = true;
			    return true;

        	}

        	if( currentIndex == 4 ){

        		next = true;
			    return true;

        	}





        	return next ;

        

        },
        onFinished: function (event, currentIndex){

        	var form = $("form#AddDeveloperForm");
            form.submit();


		}



	});


	$('.summernote').summernote({
        height: 283,
        maxHeight: 283  
    });

    $('.developer-profile-con').slimScroll({
		height: '299px',
		wheelStep: 2,
	});

}






function activateProjectSteps(){


	$(".AddProjectSteps").steps({
        headerTag: "h2",
        bodyTag: "section",
        transitionEffect: "slideLeft",
        onStepChanging: function( event, currentIndex, newIndex ){

        	var next = false;

        	if( currentIndex == 0 ){

        		$("#AddProjectForm input[name='developer_name']").val( $("input[name='developer']:checked").closest('tr').find(".developer").html() );
        		$("#AddProjectForm input[name='developer']").val( $("input[name='developer']:checked").val() );

        		next = true;
			    return true;

        	}


        	if( currentIndex == 1 ){

            	next = false;

        		var formdata = $("form#ProjectDetailsForm").serializeArray();

				 $.ajax({
			        url: "/projects/validate/projectDetails",
			        type:"POST", 
			        data: formdata,
			        async: false,
			        success: function(data){

			        	if($.isEmptyObject(data.error)){

			        		$(".form-error").html("");
			        		$("#AddProjectForm input[name='project_name']").val( $("#ProjectDetailsForm input[name='project_name']").val() );
        					$("#AddProjectForm input[name='project_location']").val( $("#ProjectDetailsForm input[name='project_location']").val() );

			        		next = true;
			        		return true;

		                }else{

		                	$(".form-error").html("");
		                    $(".form-error.project_name").html(data.error['project_name']);
		                    $(".form-error.project_location").html(data.error['project_location']);

		                }    
			        }



			    });

        	}

     
        	if( currentIndex == 2 ){

        		$("#AddProjectForm input[name='project_category_name']").val( $("input[name='project_category']:checked").closest('tr').find(".category").html() );
        		$("#AddProjectForm input[name='project_category']").val( $("input[name='project_category']:checked").val() );

        		next = true;
			    return true;

        	}

        	if( currentIndex == 3 ){

        		$("#AddProjectForm textarea[name='project_description']").html( $("#project_description_textarea").val() );

        		next = true;
			    return true;

        	}

        	if( currentIndex == 4 ){

        		next = true;
			    return true;

        	}

        	if( currentIndex == 5 ){

        		next = true;
			    return true;

        	}




        	return next ;

        

        },
        onFinished: function (event, currentIndex){

        	var form = $("form#AddProjectForm");
            form.submit();


		}



	});



	$('.Selection-Container').slimScroll({
		height: '230px',
		wheelStep: 2,
	});

	$('.summernote-project').summernote({
        height: 283,
        maxHeight: 283  
    });

}



function activateSalesSteps(){


	$(".AddSalesSteps").steps({
        headerTag: "h2",
        bodyTag: "section",
        transitionEffect: "slideLeft",
        onStepChanging: function( event, currentIndex, newIndex ){

        	var next = false;

        	if( currentIndex == 0 ){

        		 if($("input[name='project']").is(':checked')){

        			$("#AddSalesForm input[name='project_name']").val( $("input[name='project']:checked").closest('tr').find(".project_name").html() );
	        		$("#AddSalesForm input[name='project']").val( $("input[name='project']:checked").val() );
	        		$("#AddSalesForm input[name='project_developer']").val( $("input[name='project']:checked").closest('tr').find(".project_developer").html() );


					next = true;
				    return true; 

        		}
        		else{
						
					$("#ErrorModal .feedback-message").html( "No Project Seleted." );
                    $("#ErrorModal").modal("show");

					next = false;
				    return false;        			
        		}

        		
       		

        	}


        	if( currentIndex == 1 ){
				
				next = false;

        		var formdata = $("form#validateContractInfoForm").serializeArray();

				 $.ajax({
			        url: "/sales/validateContractInfo",
			        type:"POST", 
			        data: formdata,
			        async: false,
			        success: function(data){

			        	if($.isEmptyObject(data.error)){

			        		$(".form-error").html("");
			        		$("#AddSalesForm input[name='date_reserve']").val( $("#validateContractInfoForm input[name='date_reserve']").val() );
        					$("#AddSalesForm input[name='contract_price']").val( $("#validateContractInfoForm input[name='contract_price']").val() );

							next = true;
						    return true; 

		                }else{

		                	$(".form-error").html("");
		                    $("#validateContractInfoForm .form-error.date_reserve").html(data.error['date_reserve']);
		                    $("#validateContractInfoForm .form-error.contract_price").html(data.error['contract_price']);

		                }    
			        }



			    });


        	}



        	if( currentIndex == 2 ){


        		if($("input[name='agent']").is(':checked')){


					$("#AddSalesForm input[name='agent_name']").val( $("input[name='agent']:checked").closest('tr').find(".agent_name").html() );
					$("#AddSalesForm input[name='agent_rank']").val( $("input[name='agent']:checked").closest('tr').find(".agent_rank").html() );
					$("#AddSalesForm input[name='agent_email']").val( $("input[name='agent']:checked").closest('tr').find(".agent_email").html() );
	        		$("#AddSalesForm input[name='agent']").val( $("input[name='agent']:checked").val() );

	        		next = true;
				    return true;
        		}
        		else{
						
					$("#ErrorModal .feedback-message").html( "No Agent Seleted." );
                    $("#ErrorModal").modal("show");

					next = false;
				    return false;        			
        		}




        	}

        	if( currentIndex == 3 ){

        		
				next = false;

        		var formdata = $("form#validateClientInfoForm").serializeArray();

				 $.ajax({
			        url: "/sales/validateClientInfo",
			        type:"POST", 
			        data: formdata,
			        async: false,
			        success: function(data){

			        	if($.isEmptyObject(data.error)){

			        		$(".form-error").html("");
			        		$("#AddSalesForm input[name='firstname']").val( $("#validateClientInfoForm input[name='firstname']").val() );
        					$("#AddSalesForm input[name='lastname']").val( $("#validateClientInfoForm input[name='lastname']").val() );
        					$("#AddSalesForm input[name='middlename']").val( $("#validateClientInfoForm input[name='middlename']").val() );

							next = true;
						    return true; 

		                }else{

		                	$(".form-error").html("");
		                    $("#validateClientInfoForm .form-error.firstname").html(data.error['firstname']);
		                    $("#validateClientInfoForm .form-error.lastname").html(data.error['lastname']);
		                    $("#validateClientInfoForm .form-error.middlename").html(data.error['middlename']);

		                }    
			        }



			    });



        	}



        	return next ;

        

        },
        onFinished: function (event, currentIndex){

        	var form = $("form#AddSalesForm");
            form.submit();


		}



	});


	$('.Selection-Container').slimScroll({
		height: '200px',
		wheelStep: 2,
	});


    $('.datepicker').datetimepicker({
        viewMode: 'months',
        format: 'YYYY/MM/DD',
        maxDate: moment(),
        minDate: moment().subtract(60, 'years').startOf('year')
    });




}
