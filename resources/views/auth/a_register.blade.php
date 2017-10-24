<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>GITLINK BLOG</title>
<link href="../../css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<!-- Custom Theme files -->
<link href="../../css/style1.css" rel='stylesheet' type='text/css' />
<link href="../../css/font-awesome.css" rel="stylesheet"> 
</head>
<body>
  <div class="login">
    <h1><a href="index.html">Gitlink Blog </a></h1>
    <div class="login-bottom">
    @if(Session::has('success'))
    <div class="alert alert-success">
    <button class="close" type="button" data-dismiss="alert" aria-hidden="true">&#215;</button>
    {{ Session::get('success') }}
    </div>
    @endif


      <h2>Admin Registration</h2>
       <form class="form-login" action="{{ route('auth.a_register') }}" method="post" >
          {!! csrf_field() !!}
          
      <div class="col-md-6">
       <label>
         Full Name<span class="req">*</span>
       </label>
    <input type="text" class="form-control" name="full_name" required value="{{ old('full_name') }}" autocomplete="off"
      autocorrect="off"/>
      @if($errors->has('full_name'))
      <span class="help-block">
        <strong class="bg-white">{{ $errors->first('full_name')}}</strong>
      </span>
      @endif
       
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
       
         <label>
         Password(again)<span class="req">*</span>
       </label>
      <input type="password"  class="form-control" name="password_confirmation" required autocomplete="off" autocorrect="off"/>
          <span class="help-block">
      <strong class="bg-white">{{ $errors->first('password-confirm')}}</strong>
      </span>

       <label>
        Phone Number<span class="req">*</span>
      </label>
      <input type="text"  class="form-control" name="phone_num" required value="{{ old('phone_num') }}" required placeholder="Phone "/>
     <br>
      
      
         
      </div>

    <div class="col-md-6 login-do">
        <label class="hvr-shutter-in-horizontal login-sub">
          <input type="submit" value="Submit">
          </label>
          <p>Already register</p>
        <a href="{{ route('auth.signin') }}" class="hvr-shutter-in-horizontal">Login</a>
      </div>
        <div class="clearfix"> </div>
    </div>
  </div>
    <!---->
<div class="copy-right">
            <p> &copy; 2017 Gitlink Blog. All Rights Reserved | Design by <a href="http://w3layouts.com/" target="_blank">W3layouts</a> </p>     </div>
    
<!---->
<!--scrolling js-->
<script src="../../js/jquery.min.js"> </script>
<script src="../../js/bootstrap.min.js"> </script>

  <script src="../../js/jquery.nicescroll.js"></script>
  <script src="../../js/scripts.js"></script>
  <!--//scrolling js-->
</body>
</html>

