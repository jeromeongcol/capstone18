
<!-- Modal Delete User -->
<div class="modal fade event-modal" id="AddEventModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-super-lg">
        <div class="modal-content">
            <div class="modal-header">
                    <ul class="modal-head-title">
                        <li class="modal-title">ADD EVENT</li>
                    </ul>
                    <ul class="modal-close">
                        <li class="" data-dismiss="modal"><i class="fa fa-close"></i></li>
                    </ul>
            </div>

            <form action="/events/add" method="POST" id="addEventForm">
            
               {{ csrf_field() }}

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





                </div> <!-- end modal -->
                <div class="modal-footer text-center">
                        <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">CANCEL</button>
                        <button type="submit" class="btn btn-primary">SUBMIT</button>
                     
                </div>

            </form>

        </div>
    
    </div>
</div>
<!--  End Modal -->