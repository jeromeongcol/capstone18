
<!-- Modal Delete User -->
<div class="modal fade" id="ConfirmModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xs">
        <div class="modal-content">
            <div class="modal-header">
                    <ul class="modal-head-title">
                        <li class="modal-title"></li>
                    </ul>
                    <ul class="modal-close">
                        <li class="" data-dismiss="modal"><i class="fa fa-close"></i></li>
                    </ul>
            </div>
            <div class="modal-body">

                    <div class="row">
                        <div class="col-md-12">
                            <p class="modal-message"></p>
                        </div>
                    </div>

            </div>
            <div class="modal-footer text-center">
                  <form action="" method="" id="ConfirmForm">
                        {{ csrf_field() }}
                        <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">NO</button>
                        <input type="hidden" name="id" class="SelectedId" value="">
                        <input type="hidden" class="reloadList" value="">
                        <button type="submit" class="btn action-confirm">YES</button>
                  </form>
            </div>
        </div>
    </div>
</div>
<!--  End Modal -->