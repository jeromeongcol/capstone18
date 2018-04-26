
<!-- Modal Delete User -->
<div class="modal fade" id="SelectAgentModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xs">
        <div class="modal-content">
            <div class="modal-header modal-violet">
                    <ul class="modal-head-title">
                        <li class="">SELECT AGENT</li>
                    </ul>
                    <ul class="modal-close">
                        <li class="" data-dismiss="modal"><i class="fa fa-close"></i></li>
                    </ul>
            </div>
            <div class="modal-body">

                    <div class="row">
                        <div class="col-md-12">
                            <form action="/agent/search" method="GET" id="searchAgent">
                                <div class="input-group search-control">
                                        <input type="text" class="form-control" id="search_recuiter" placeholder="Search Recruiter" name="key">
                                      <span class="input-group-btn">
                                        <button class="btn btn-info" type="submit">Go!</button>
                                      </span>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12" id="recruiter-query-result">
                        </div>
                    </div>


            </div>
            <div class="modal-footer text-center">
                    <button type="button" class="btn btn-success btn-simple" id="AddAgentToInput">SELECT AGENT</button>
            </div>
        </div>
    </div>
</div>
<!--  End Modal -->