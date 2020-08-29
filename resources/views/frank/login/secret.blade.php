@extends('adminlte::page')

@section('title')
    {{ config('agentquote.company.name') }} :: Secret Login
@endsection

@section('content_header')
    <h1>Secret Login</h1>
@stop

@section('content')
    <div class="login-box">
        <div class="login-logo">
            <div class="login-logo-white-label">
                <img src="https://app.agentquote.com/images/email/email-logo.png" alt="Company Logo" />
            </div>

        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">Sign in to start your session</p>
            <form action="https://app2.agentquote.com/login" method="post">
                <input type="hidden" name="_token" value="o5fYbNoia74SfcnhHEwqWYr503wxXKfx5Z0EFeGP">

                <div class="form-group has-feedback ">
                    <input type="email" name="email" class="form-control" value=""
                           placeholder="Email">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback ">
                    <input type="password" name="password" class="form-control"
                           placeholder="Password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>

                <div class="form-group mb-1">
                    <div class="col-xs-4">
                        <button type="submit"
                                class="btn btn-primary btn-block btn-flat">Sign In</button>
                    </div>
                </div>
            </form>

        </div>
        <!-- /.login-box-body -->
    </div><!-- /.login-box -->



@stop


