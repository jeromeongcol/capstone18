
<!-- Modal Delete User -->
<div class="modal fade event-modal" id="EventActionModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-super-lg">
        <div class="modal-content">
            <div class="modal-header">
                    <ul class="modal-head-title">
                        <li class="modal-title">EVENT DETAILS</li>
                    </ul>
                    <ul class="modal-close">
                        <li class="" data-dismiss="modal"><i class="fa fa-close"></i></li>
                    </ul>
            </div>

            <form action="/event/update" method="POST" id="updateEventForm">
                    {{ csrf_field() }}
                
                <input type="hidden" name="id" id="eventId"/>
                <div class="modal-body">
                    
                    <div class="row">
                        <div class="col-md-4">

                                <div class="form-group">
                                    <span class="input-group-addon" >Title</span>
                                     <input type="text" name="title" class="form-control"/>
                                     <small class="help-block with-errors form-error title"></small>
                                </div>

                                <div class="form-group">
                                    <span class="input-group-addon" >Speaker</span>
                                     <input type="text" name="speaker" class="form-control"/>
                                     <small class="help-block with-errors form-error speaker"></small>
                                </div>


                                <div class="form-group">
                                    <span class="input-group-addon" >Venue</span>
                                     <input type="text" name="venue" class="form-control"/>
                                     <small class="help-block with-errors form-error venue"></small>
                                </div>

                                <div class="form-group">
                                    <span class="input-group-addon" >Start Date</span>
                                     <input type="text" name="start" data-date-end-date="0d" class="eventdatepicker form-control" value="03/12/2017" />
                                     <small class="help-block with-errors form-error start"></small>
                                </div>


                                <div class="form-group">
                                    <span class="input-group-addon" >End Date</span>
                                     <input type="text" name="end" data-date-end-date="0d" class="eventdatepicker form-control" value="03/12/2017" />
                                     <small class="help-block with-errors form-error end"></small>
                                </div>



                        </div>
                        <div class="col-md-8">

                             <span class="input-group-addon" >Description</span>
                             <textarea name="description" class="summernote" id="description"></textarea>
                             <small class="help-block with-errors form-error description"></small>

                        </div>
                    </div>




                      



                </div>

                <div class="modal-footer text-center">
                        <button type="submit" id="updateEventBtn" class="btn btn-primary">UPDATE EVENT</button>
                        <button class="btn btn-danger cancelEventBtn">CANCEL EVENT</button>
                        <button class="btn btn-success resumeEventBtn">RE OPEN EVENT</button>
                </div>
            
        
            </form>

        </div>

    
    </div>
</div>
<!--  End Modal -->