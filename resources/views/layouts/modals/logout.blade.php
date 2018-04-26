<!-- Modal Delete User -->
<div class="modal fade" id="logOutModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xs">
        <div class="modal-content">
            <div class="modal-header modal-dark">
                    <ul class="modal-head-title">
                        <li class="modal-title">LOGOUT!</li>
                    </ul>
                    <ul class="modal-close">
                        <li class="" data-dismiss="modal"><i class="fa fa-close"></i></li>
                    </ul>
            </div>
            <div class="modal-body">

                    <div class="row">
                        <div class="col-md-12">
                            <p class="modal-message">Are you sure you want to logout ?</p>
                        </div>
                    </div>

            </div>
            <div class="modal-footer text-center">
                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                          {{ csrf_field() }}
                           <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">NO</button>
                            <button type="submit" class="btn action-confirm btn-dark">YES</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!--  End Modal -->