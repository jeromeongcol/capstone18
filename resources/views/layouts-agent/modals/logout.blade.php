<!-- Mini Modal -->
<div class="modal fade modal-mini modal-info" id="LogOutModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header justify-content-center">
                <div class="modal-profile">
                    <img src="{{ $auth->photo }}" alt="" class="rounded-circle">
                </div>
            </div>
            <div class="modal-body">
                <p>{{ $auth->lastname }}, {{ $auth->firstname }} {{ $auth->middlename }}</p>
                <p>Are you sure you want to<br> log out ?</p>
            </div>
            <div class="modal-footer">
                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                    {{ csrf_field() }}
                    
                <button type="button" class="btn btn-link btn-neutral" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-link btn-neutral">Logout</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!--  End Modal -->