@extends('layouts-default.app')

@section('content')

    <div class="page-header" filter-color="orange">
        <div class="page-header-image" style="background-image:url({{ asset('layouts-default/assets/img/login.jpg') }})"></div>
        <div class="container">
            <div class="col-md-4 content-center">
                <div class="card card-login card-plain">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('password.email') }}">

                            {{ csrf_field() }}
                        <div class="header header-primary text-center">
                            <div class="logo-container">
                                <img src="{{ asset('layouts-default/assets/img/now-logo.png') }}" alt="">
                            </div>
                        </div>
                        <div class="content">

                            <div class="alert alert-info bg-info" role="alert">
                                    <div class="container">
                                        <strong>Heads up!</strong>  Please enter your email address. You will receive a link to create a new password via email.
                                    </div>
                                </div>
                                
                                 @if ($errors->has('email'))

                                <div class="alert alert-danger" role="alert">
                                    <div class="container">
                                        <strong>Oh snap!</strong> {{ $errors->first('email') }}
                                    </div>
                                </div>

                                 @endif

                                @if (session('status'))

                                <div class="alert alert-success" role="alert">
                                    <div class="container">
                                        <strong>Well done!</strong> {{ session('status') }}
                                    </div>
                                </div>

                                 @endif



                                <div class="input-group form-group-no-border input-lg">
                                    <span class="input-group-addon">
                                        <i class="now-ui-icons users_circle-08"></i>
                                    </span>
                                    <input type="text" name="email" class="form-control" placeholder="Email Address...">
                                </div>

                        </div>
                        <div class="footer text-center">

                            <button type="submit" class="btn btn-info btn-round btn-lg btn-block">GET NEW PASSWORD</button>
                            
                            <span class="helper-text"><i class="now-ui-icons ui-1_lock-circle-open"></i> &nbsp;<a href="/login">Log in ?</span>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
