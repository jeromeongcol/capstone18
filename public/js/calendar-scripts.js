    $(function() {



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

});