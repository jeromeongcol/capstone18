        <div class="SeletedMenuHeader">
          
         <div class="row">
              <div class="col-md-6 col-xs-6">

                <h4>
                    <a class="back agent-submenu"><img src="{{ asset('layouts/img/back.png') }}"></a>Users > Add Agent
                </h4>

              </div>

              <div class="col-md-6 col-xs-6 text-right">

                 @if( ( $auth->role == "Admin") ||  ( $auth->role == "SuperAdmin") )

                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ImportUserExcelModal"><img src="{{ asset('layouts/img/import.png') }}"> Import Agents</button>

                  @endif

              </div>
          </div>

        </div>


        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">


              <div class="panel">
                <div class="panel-body page-content">

                    
                  <div class="AddAgentSteps steps-con">
                      <h2>Create Account</h2>
                      <section>
                         
                         <div class="row account-con">
                              <div class="col-md-10 col-md-offset-1">
                                  <br/><br/>

                                  <form action="/users/agent/validate/account" method="POST" id="UserAccountForm">
                                      
                                      {{ csrf_field() }}

                                      <div class="row">
                                         <div class="col-md-4">
                                             <div class="form-group">
                                                   <span class="input-group-addon" >Email Address</span>
                                                    <input class="form-control" value="{{ old('email') }}" name="email" type="text" required="">
                                                    <small class="help-block with-errors form-error email"></small>
                                              </div>
                                         </div>
                                          <div class="col-md-4">
                                                  <div class="form-group">
                                                       <span class="input-group-addon" >Password</span>
                                                        <input class="form-control" value="{{ old('password') }}" name="password" type="password" required>
                                                       <small class="help-block with-errors form-error password"></small>
                                                  </div>
                                         </div>
                                          <div class="col-md-4">
                                                  <div class="form-group">
                                                       <span class="input-group-addon" >Confirm Password</span>
                                                       <input class="form-control" value="{{ old('password_confirmation') }}" name="password_confirmation" type="password" required>
                                                        <small class="help-block with-errors form-error password_confirmation"></small>
                                                  </div>
                                         </div>
                                      </div>

                                  </form>
                              </div>
                         </div>

                      </section>


                      <h2>Basic Information</h2>
                      <section>
                          <div class="row account-con">

                              <form action="/users/agent/validate/account" method="POST" id="UserAdditionalInfoForm">
                                 {{ csrf_field() }}
                              <div class="col-md-10 col-md-offset-1">
                               <br/><br/>

                                <div class="row">

                                    <div class="col-md-4">
                                       <div class="form-group">
                                          <span class="input-group-addon" >Last name</span>
                                          <input class="form-control" value="{{ old('lastname') }}" type="text" name="lastname" required>
                                          <small class="help-block with-errors form-error lastname"></small>
                                      </div>
                                    </div>

                                    <div class="col-md-4">
                                      <div class="form-group">
                                          <span class="input-group-addon" >First name</span>
                                          <input class="form-control" value="{{ old('firstname') }}" type="text" name="firstname" required>
                                          <small class="help-block with-errors form-error firstname"></small>
                                      </div>
                                    </div>

                                    <div class="col-md-4">
                                       <div class="form-group">
                                          <span class="input-group-addon" >Middle name</span>
                                          <input class="form-control" value="{{ old('middlename') }}" type="text" name="middlename" required>
                                          <small class="help-block with-errors form-error middlename"></small>
                                      </div>
                                    </div>

                                </div>  

                              </div>
                            </form>
                         </div>
                      </section>

                      
                      <h2>Photo</h2>
                      <section>
                          <div class="row account-con">

                               <div class="col-md-4 col-md-offset-4">
                                  
                                  <div class="profile-picture-con user-picture-container">

                                    <div class="overlay showCropboxModal" id="user-photo">
                                      <div class="text">+</div>
                                    </div>

                                     <img src="{{ asset('storage/default.png') }}" id="profile-picture">
                                     <input type="hidden" id="imgUpload" name="avatar" value="">

                                  </div>

                               </div>
                         </div>
                      </section>

                      

                      <h2>Agent Rank</h2>
                      <section>
                          <div class="row">
                             <div class="col-md-12">


                                   <table class="table" id="SelectAgentRankTable">
                                        <thead>
                                          <tr>
                                            <th class="text-center"></th>
                                            <th class="text-center">Rank</th>
                                            <th class="text-center">Description</th>
                                            <th class="text-center">Rate</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          @php( $i = 1 )
                                          @foreach( $ranks as $rank )
                                          <tr class="data @if($i == 1) active @endif">
                                            <td class="text-center"><input type="radio" name='rank' value="{{ $rank->id }}" @if($i == 1) checked="checked" @endif></td>
                                            <td class="text-center rank">{{ $rank->rank }}</td>
                                            <td class="text-center">{{ $rank->description }}</td>
                                            <td class="text-center">{{ $rank->commission_rate }}</td>
                                          </tr>
                                           @php( $i++ )
                                          @endforeach
                                         
                                        </tbody>
                                  </table>

                             </div>
                         </div>
                      </section>

                      <h2>Recruiter</h2>
                      <section>
                          <div class="row">
                             <div class="col-md-12">
                                    <div class="input-group search-control">
                                          <input class="form-control" id="search_recuiter" placeholder="Search Recruiter" name="key" type="text">
                                          <span class="input-group-btn">
                                            <button class="btn btn-info" id="searchAgent">Go!</button>
                                          </span>
                                    </div>

                                    <div class="RecruitersTable-con">
                                       <table class="table" id="SelectRecruiterTable">
                                          @include('dashboard.users.forms.agent.partials.agent-search-result')
                                      </table>
                                    </div>

                             </div>
                         </div>
                      </section>


                      <h2>Affiliate Developer</h2>
                      <section>
                          <div class="row">
                             <div class="col-md-12">
                                
                                <label class="radio-inline">
                                  <input name="affiliate" value="1" type="radio" checked="true">
                                  <span><i></i>Affilated</span>
                                </label>


                                <label class="radio-inline">
                                  <input name="affiliate" value="0" type="radio">
                                  <span><i></i>No Affilation</span>
                                </label>


                             </div>
                             <div class="col-md-12 affiliated_content">
                                    <div class="input-group search-control">
                                          <input class="form-control" id="search_recuiter" placeholder="Search Developer" name="key" type="text">
                                          <span class="input-group-btn">
                                            <button class="btn btn-info" id="searchAgent">Go!</button>
                                          </span>
                                    </div>

                                    <div class="RecruitersTable-con">
                                       <table class="table" id="SelectRecruiterTable">
                                          @include('dashboard.users.forms.agent.partials.agent-affiliate-developer')
                                      </table>
                                    </div>

                             </div>
                         </div>
                      </section>



                      <h2>Finish</h2>
                      <section>

                        <form action="/users/agent/add" method="POST" id="AddAgentForm">
                        {{ csrf_field() }}

                        <div class="row account-con">


                              <div class="col-md-4">
                                
                                  <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <span class="input-group-addon" >Email Address</span>
                                            <input class="form-control" name="email" type="text" required readonly>
                                            <input class="form-control hidden" name="password" type="text" required readonly>
                                            <small class="help-block with-errors form-error email"></small>
                                        </div>
                                    </div>
                                  </div>

                                  <div class="row">
                                    <div class="col-md-12">
                                       <div class="form-group">
                                          <span class="input-group-addon" >Rank</span>
                                          <input class="form-control" type="text" name="rank-name" required disabled>
                                          <input class="form-control hidden" type="text" name="rank" required readonly>
                                          <small class="help-block with-errors form-error rank"></small>
                                      </div>
                                    </div>
                                  </div>

                                  <div class="row">
                                    <div class="col-md-12">
                                      <div class="form-group">
                                          <span class="input-group-addon" >Recruiter</span>
                                          <input class="form-control" type="text" name="recruiter-name" required disabled>
                                          <input class="form-control hidden" type="text" name="recruiter" required readonly>
                                          <small class="help-block with-errors form-error recruiter"></small>
                                      </div>
                                    </div>

                              </div>
                            </div>

                              <div class="col-md-4">

                                  <div class="row">
                                    <div class="col-md-12">
                                       <div class="form-group">
                                          <span class="input-group-addon" >Last name</span>
                                          <input class="form-control" type="text" name="lastname" required readonly>
                                          <small class="help-block with-errors form-error lastname"></small>
                                      </div>
                                    </div>
                                  </div>

                                  <div class="row">
                                    <div class="col-md-12">
                                      <div class="form-group">
                                          <span class="input-group-addon" >First name</span>
                                          <input class="form-control" type="text" name="firstname" required readonly>
                                          <small class="help-block with-errors form-error firstname"></small>
                                      </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                       <div class="form-group">
                                          <span class="input-group-addon" >Middle name</span>
                                          <input class="form-control" type="text" name="middlename" required readonly>
                                          <small class="help-block with-errors form-error middlename"></small>
                                      </div>
                                    </div>
                                </div>  

                              </div>


                               <div class="col-md-4">
                                  
                                  <div class="profile-picture-con user-picture-container">  
                                     <img src="{{ asset('storage/default.png') }}" id="profile-picture">
                                     <input type="hidden" id="imgUpload" name="avatar" value="">

                                  </div>

                               </div>

                              <div class="row affiliated_con">
                                    <div class="col-md-8">
                                       <div class="form-group">
                                          <span class="input-group-addon" >Affiliated Developer</span>
                                          <input class="form-control" type="text" name="developer-name" required readonly>
                                          <input class="form-control" type="hidden" name="developer" required readonly>
                                          <small class="help-block with-errors form-error middlename"></small>
                                      </div>
                                    </div>
                                </div> 

                         </div>

                       </form>


                      </section>


                  </div>  
  

                </div>
              </div>
              <!-- END RECENT PURCHASES -->
            </div>
          </div>



        </div>














