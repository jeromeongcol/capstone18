@extends('layouts-default.app')

@section('content')
    <div class="page-header" filter-color="orange">
        <div class="page-header-image" style="background-image:url({{ asset('layouts-default/assets/img/login.jpg') }})"></div>
        <div class="container">
            <div class="col-md-4 content-center">
                <div class="card card-login card-plain">
                    <form role="form" method="POST" action="{{ route('login') }}">
                             {{ csrf_field() }}
                        <div class="header header-primary text-center">
                            <div class="logo-container">
                                <img src="{{ asset('layouts-default/assets/img/now-logo.png') }}" alt="">
                            </div>
                        </div>
                        <div class="content">

                               @if ($errors->has('email'))

                                    <div class="alert alert-danger" role="alert">
                                        <div class="container">
                                            <strong>Oh snap!</strong> {{ $errors->first('email') }}
                                        </div>
                                    </div>

                                 @endif


                                <div class="input-group form-group-no-border input-lg">
                                    <span class="input-group-addon">
                                        <i class="now-ui-icons users_circle-08"></i>
                                    </span>
                                    <input type="text" name="email" class="form-control" value="{{ old('email') }}" placeholder="Email Address..." required>
                                </div>
                                <div class="input-group form-group-no-border input-lg">
                                    <span class="input-group-addon">
                                        <i class="now-ui-icons ui-1_lock-circle-open"></i>
                                    </span>
                                    <input type="password" name="password" placeholder="Password..." class="form-control"  required/>
                                </div>

                        </div>
                        <div class="footer text-center">

                            <button type="submit" class="btn btn-info btn-round btn-lg btn-block">SIGN ME IN</button>
                            
                            <span class="helper-text"><i class="now-ui-icons ui-1_lock-circle-open"></i> &nbsp;<a href="/password/reset/">Forgot password?</a></span>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection



