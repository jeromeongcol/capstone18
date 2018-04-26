    <!-- Modal Update User -->
    <div class="modal fade" id="ExportUserExcelModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xs">
                <div class="modal-content">
                    <div class="modal-header">
                        <ul class="modal-head-title">
                            <li class="">EXPORT EXCEL</li>
                        </ul>
                        <ul class="modal-close">
                            <li class="" data-dismiss="modal"><i class="fa fa-close"></i></li>
                        </ul>

                    </div>
                    <div class="modal-body">

                        <div class="row"> 
                            <div class="col-md-12">
                                
                                @if(  $auth->role == "SuperAdmin" )

                                    <center><h5>ADMINS</h5></center>

                                    <form method="POST" action="/users/export/all" id="ExportExcelUserForm" enctype="multipart/form-data">
                                        {{ csrf_field() }}

                                         <input class="form-control hidden" value="all_users_{{ date('Y_m_d_H_i_s') }}"  name="filename" type="text" required="">
                                        <button type="submit" class="btn btn-success btn-block">EXPORT ALL USERS</button>

                                     </form>

                                    <form method="POST" action="/users/export/all/active" id="ExportExcelUserForm" enctype="multipart/form-data">
                                        {{ csrf_field() }}

                                         <input class="form-control hidden" value="all_active_users_{{ date('Y_m_d_H_i_s') }}"  name="filename" type="text" required="">
                                        <button type="submit" class="btn btn-primary btn-block">EXPORT ALL ACTIVE USERS</button>

                                     </form>

                                    <form method="POST" action="/users/export/all/notactive" id="ExportExcelUserForm" enctype="multipart/form-data">
                                        {{ csrf_field() }}

                                          <input class="form-control hidden" value="all_not_active_users_{{ date('Y_m_d_H_i_s') }}"  name="filename" type="text" required="">

                                        <button type="submit" class="btn btn-info btn-block">EXPORT ALL NOT ACTIVE USERS</button>

                                     </form>

                                @endif

                                

                                @if( ( $auth->role == "Admin") ||  ( $auth->role == "SuperAdmin") ||  ( $auth->role == "Staff") )

                                <center><h5>AGENTS</h5></center>

                                <form method="POST" action="/users/export/agents" id="ExportExcelUserForm" enctype="multipart/form-data">
                                    {{ csrf_field() }}

                                    <div class="form-group">
                                            <input class="form-control hidden" value="all_agents_{{ date('Y_m_d_H_i_s') }}"  name="filename" type="text" required="">
                                    </div>

                                    <button type="submit" class="btn btn-success btn-block">EXPORT ALL AGENTS</button>
                                    
                                 </form>

                                <form method="POST" action="/users/export/agents/active" id="ExportExcelUserForm" enctype="multipart/form-data">
                                    {{ csrf_field() }}

                                            <input class="form-control hidden" value="all_active_agents_{{ date('Y_m_d_H_i_s') }}"  name="filename" type="text" required="">

                                    <button type="submit" class="btn btn-primary btn-block">EXPORT ALL ACTIVE AGENTS</button>
                                    
                                 </form>


                                 <form method="POST" action="/users/export/agents/notactive" id="ExportExcelUserForm" enctype="multipart/form-data">
                                    {{ csrf_field() }}

                                            <input class="form-control hidden" value="all_not_active_agents_{{ date('Y_m_d_H_i_s') }}"  name="filename" type="text" required="">

                                    <button type="submit" class="btn btn-info btn-block">EXPORT ALL NOT ACTIVE USERS</button>

                                 </form>


                                @endif



                               @if( ( $auth->role == "Admin") ||  ( $auth->role == "SuperAdmin")  )

                                <center><h5>STAFFS</h5></center>

                                <form method="POST" action="/users/export/staffs" id="ExportExcelUserForm" enctype="multipart/form-data">
                                    {{ csrf_field() }}

                                    <div class="form-group">
                                            <input class="form-control hidden" value="all_staffs_{{ date('Y_m_d_H_i_s') }}"  name="filename" type="text" required="">
                                    </div>

                                    <button type="submit" class="btn btn-success btn-block">EXPORT ALL STAFFS</button>
                                    
                                 </form>

                                <form method="POST" action="/users/export/staffs/active" id="ExportExcelUserForm" enctype="multipart/form-data">
                                    {{ csrf_field() }}

                                            <input class="form-control hidden" value="all_active_staffs_{{ date('Y_m_d_H_i_s') }}"  name="filename" type="text" required="">

                                    <button type="submit" class="btn btn-primary btn-block">EXPORT ALL ACTIVE STAFFS</button>
                                    
                                 </form>
                                 
                                <form method="POST" action="/users/export/staffs/notactive" id="ExportExcelUserForm" enctype="multipart/form-data">
                                    {{ csrf_field() }}

                                            <input class="form-control hidden" value="all_not_active_staffs_{{ date('Y_m_d_H_i_s') }}"  name="filename" type="text" required="">

                                    <button type="submit" class="btn btn-info btn-block">EXPORT ALL NOT ACTIVE USERS</button>

                                 </form>

                                 @endif

                            </div>

                        </div>

                    <br><br>
                </div>
            </div>
        </div>
    
    </div>