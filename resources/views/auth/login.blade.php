@extends('member.layouts.app')

@section('content')
<div class="app-content content container-fluid">
      <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body"><section class="flexbox-container">
    <div class="col-md-4 offset-md-4 col-xs-10 offset-xs-1  box-shadow-2 p-0">
        <div class="card border-grey border-lighten-3 m-0">
            <div class="card-header no-border">
                <div class="card-title text-xs-center">
                    <div class="p-1"><img src="../../app-assets/Alti.png" style="height:100px;"></div>
                </div>
                
            </div>
            <div class="card-body collapse in">
                <div class="card-block">
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}
                        
                       <!--  <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> -->

                         

                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            <label for="username" class="col-md-4 control-label">Username</label>
                            <div class="col-md-6">
                                <fieldset class="form-group position-relative has-icon-left mb-0">
                                    <input id="username" class="form-control" name="username" placeholder="Your Username" value="{{ old('username') }}" required autofocus>
                                        <div class="form-control-position">
                                            <i class="icon-head"></i>
                                        </div>
                                </fieldset>
                            </div>
                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            
                        </div>


                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>
                            <div class="col-md-6">
                                 <fieldset class="form-group position-relative has-icon-left">
                                    <input id="password" type="password" class="form-control" name="password" placeholder="Your Password" required>
                                    <div class="form-control-position"> 
                                    <i class="icon-key3"></i>
                                    </div>
                                </fieldset>
                            </div>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif

                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

<!--                         <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div> -->
                                <button type="submit" class="btn btn-red btn-lg btn-block">
                                    Login
                                <i class="icon-unlock2"></i></button>
                    </form>
                 </div>
            </div>
            <div class="card-footer">
                <!-- <div class="">
                    <p class="float-sm-right text-xs-center m-0">New User? <a href="/register" class="card-link">Create Account</a></p>
                </div> -->
            </div>
        </div>
    </div>
</section>
@endsection
