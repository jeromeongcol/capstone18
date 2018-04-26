@extends('layouts-default.app')

@section('content')



  <div class="page-header" filter-color="orange">
        <div class="page-header-image" style="background-image:url({{ asset('layouts-default/assets/img/login.jpg') }})"></div>
        <div class="container">
            <div class="col-md-4 content-center">
                <div class="card card-login card-plain">

                        <div class="header header-primary text-center">
                            <div class="logo-container">
                                <h4>CHANGE PASSWORD</h4>
                            </div>
                        </div>

                        <br>

                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" role="form" method="POST" action="{{ route('password.request') }}">
                        {{ csrf_field() }}

                        <input type="hidden" name="token" value="{{ $token }}">

                            <label for="email" class="col-md-12 control-label">E-Mail Address</label>

                          <div class="input-group form-group-no-border input-lg">
                            <span class="input-group-addon">
                                <i class="now-ui-icons users_circle-08"></i>
                            </span>
                            <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" required autofocus>

                        </div>

                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif




                        <label for="email" class="col-md-12 control-label">Password</label>

                          <div class="input-group form-group-no-border input-lg">
                            <span class="input-group-addon">
                                <i class="now-ui-icons ui-1_lock-circle-open"></i>
                            </span>
                            <input id="password" type="password" class="form-control" name="password" required>

                        </div>



                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif


                        <label for="email" class="col-md-12 control-label">Password Confirmation</label>

                          <div class="input-group form-group-no-border input-lg">
                            <span class="input-group-addon">
                                <i class="now-ui-icons ui-1_lock-circle-open"></i>
                            </span>

                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>


                        </div>

                        @if ($errors->has('password_confirmation'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                        @endif


                        <div class="form-group">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">
                                    Reset Password
                                </button>
                            </div>
                        </div>
                    </form>


                </div>
        </div>
    </div>


@endsection
