@extends('layouts.acctbase')
@section('content')



   <div class="login">
    <h1><a href="{{ url('/') }}">GITLINK BLOG </a></h1>
    <div class="login-bottom">
   
     @if(Session::has('danger'))
      <div class="alert alert-danger">
        <button class="close" type="button" data-dismiss="alert" aria-hidden="true">&#215;</button>
      {{ Session::get('danger') }}
      </div>
   @endif
  
      <h2>User Login</h2>
       <form class="form-login" action="{{ route('accounts.sign-in') }}" method="post" >
          {{ csrf_field() }}
          
      <div class="col-md-6">
        <label>
         Email<span class="req">*</span>
       </label>
    <input type="email" class="form-control" name="email" value="{{ $email or old('email') }}" required autocomplete="off"
      autocorrect="off"/>
        @if($errors->has('email'))
      <span class="help-block">
      <strong class="bg-white">{{ $errors->first('email')}}</strong>
      </span>
      @endif

         <label>
         Password<span class="req">*</span>
       </label>
      <input type="password" class="form-control" name="password" required autocomplete="off" autocorrect="off"/>
         <span class="help-block">
      <strong class="bg-white">{{ $errors->first('password')}}</strong>
      </span>
      <br>

                <label>
                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                </label>

                 <label>
                 <a class="btn btn-link" href="{{ route('password.request') }}">Forgot Your Password?</a>
                </label>
       

      
      
         
      </div>

      <div class="col-md-6 login-do">
        <label class="hvr-shutter-in-horizontal login-sub">
          <input type="submit" value="login">
          </label>
          <p>Do not have an account?</p>
        <a href="{{ route('accounts.sign-up') }}" class="hvr-shutter-in-horizontal">Signup</a>
      </div>
      
      <div class="clearfix"> </div>
    </div>
  </div>
  
@endsection