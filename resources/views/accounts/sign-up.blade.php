@extends('layouts.acctbase')
@section('content')



   <div class="login">
    <h1><a href="{{ url('/') }}">GITLINK BLOG </a></h1>
    <div class="login-bottom">
   
     @if(Session::has('success'))
      <div class="alert alert-success">
        <button class="close" type="button" data-dismiss="alert" aria-hidden="true">&#215;</button>
      {{ Session::get('success') }}
      </div>
   @endif
  
      <h2>User Registration</h2>
       <form class="form-login" action="{{ route('accounts.sign-up') }}" method="post" >
          {{ csrf_field() }}
          
      <div class="col-md-6">
       <input type="text" class="form-control" name="full_name" required value="{{ old('full_name') }}" autocomplete="off"
      autocorrect="off" placeholder="Full Name" />
      @if($errors->has('full_name'))
      <span class="help-block">
        <strong class="bg-white">{{ $errors->first('full_name')}}</strong>
      </span>
      @endif
      <br>
    <input type="email" class="form-control" name="email" value="{{ $email or old('email') }}" required autocomplete="off"
      autocorrect="off" placeholder="Email Address" />
        @if($errors->has('email'))
      <span class="help-block">
      <strong class="bg-white">{{ $errors->first('email')}}</strong>
      </span>
      @endif
        <br>
      <input type="password" class="form-control" name="password" required autocomplete="off" autocorrect="off" placeholder="Password" />
         <span class="help-block">
      <strong class="bg-white">{{ $errors->first('password')}}</strong>
      </span>
      <br>

      <input type="password"  class="form-control" name="password_confirmation" required autocomplete="off" autocorrect="off" placeholder="Confirm Password" />
          <span class="help-block">
      <strong class="bg-white">{{ $errors->first('password-confirm')}}</strong>
      </span>
      <br>

       <input type="text"  class="form-control" name="phone_num" required value="{{ old('phone_num') }}" required placeholder="Phone Number "/>
     <br>
      

               
       

      
      
         
      </div>

      <div class="col-md-6 login-do">
        <label class="hvr-shutter-in-horizontal login-sub">
          <input type="submit" value="Register">
          </label>
          <p>Already have an account?</p>
        <a href="{{ route('accounts.sign-in') }}" class="hvr-shutter-in-horizontal">Login</a>
      </div>
      
      <div class="clearfix"> </div>
    </div>
  </div>
  
@endsection