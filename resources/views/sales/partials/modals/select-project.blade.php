
<!-- Modal Delete User -->
<div class="modal fade" id="SelectProjectDeveloperModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header modal-violet">
                    <ul class="modal-head-title">
                        <li class="">SELECT PROJECT</li>
                    </ul>
                    <ul class="modal-close">
                        <li class="" data-dismiss="modal"><i class="fa fa-close"></i></li>
                    </ul>
            </div>
            <div class="modal-body">

                  <div class="row">
                        <div class="col-md-6">
                            <form action="/project/search" method="GET" id="searchProject">
                                <div class="input-group search-control">
                                        <input type="text" class="form-control" id="search_project" placeholder="Search Project" name="key">
                                      <span class="input-group-btn">
                                        <button class="btn btn-info" type="submit">Go!</button>
                                      </span>
                                </div>
                            </form>
                        </div>

                        <div class="col-md-6">
                            <form action="/developer/search" method="GET" id="searchDeveloper">
                                <div class="input-group search-control">
                                        <input type="text" class="form-control" id="search_developer" placeholder="Search Developer" name="key">
                                      <span class="input-group-btn">
                                        <button class="btn btn-info" type="submit">Go!</button>
                                      </span>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                     <div class="row">
                        <div class="col-md-6" id="project-query-result">
                        </div>
                        <div class="col-md-6" id="developer-query-result">
                        </div>
                    </div>


            </div>
            <div class="modal-footer text-center">
                    <button type="button" class="btn btn-success btn-simple" id="AddProjectDeveloperToInput">SELECT PROJECT AND DEVELOPER</button>
            </div>
        </div>
    </div>
</div>
<!--  End Modal -->