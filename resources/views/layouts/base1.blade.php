<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Gitlinks Blog</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{ url('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Theme CSS -->

  <link rel="stylesheet" type="text/css" href="{{ url('css/jquery.fancybox.css') }}" media="screen" />
    <link href="{{ url('css/style.css') }}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{ url('css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ url('css/clean-blog.css') }}" rel="stylesheet">

    <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
  <!-- Navigation -->
    <nav class="navbar navbar-default navbar-custom navbar-fixed-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    Menu <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="index.html">Gitlink Blog</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="{{ url('/') }}">Home</a>
                    </li>
                    <li>
                        <a href="about.html">About</a>
                    </li>
                    <li>
                        <a href="{{ url('sign-in') }}">Login</a>
                    </li>

                    <li>
                        <a href="{{ url('sign-up') }}">Register</a>
                    </li>
                    <li>
                        <a href="contact.html">Contact</a>
                    </li>
                       @if(Auth::check())

                       <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->full_name}} <i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ route('gitblog.new-post') }}">Add new post</a></li>
                                <li><a href="pricing.html">My Posts</a></li>
                                <li><a href="404.html">My Profile</a></li>
                                <li><a href="javascript:;" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="logout">Logout</a></li>
                                <form id ="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                              {{ csrf_field() }}
                                  </form>
                 
                                   @endif 
                 
    
                            </ul>
                        </li>
                 
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
     <!-- Page Header -->
    <!-- Set your background image for this header on the line below. -->
    <header class="intro-header" style="background-image: url('../images/profile-02.jpg')">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="site-heading">
                        <h1>Gitlinks Blog</h1>
                        <hr class="small">
                        <span class="subheading">Catch the most trending news in Nigeria</span>
                    </div>
                </div>
            </div>
        </div>
    </header>


@yield('content')
   <div class="footer">
        <div class="footer_grides"> 
           <div class="wrap">         
        <div class="footer_grid1">
          <h3>Popular Tweets</h3>
          <div class="tweet_data">
      <div class="tweet_img">
        <img src="images/tweet-img1.jpg" alt=""/>
    </div>
    <div class="tweet_desc">
       <h4>June 24th, 2013</h4>
    <p>Integer eget tortor et elit venenatis auctor morbi turpis nulla</p>
    </div>
    <div class="clear"></div>
    </div>  
    <div class="tweet_data">
      <div class="tweet_img">
        <img src="images/tweet-img2.jpg" alt=""/>
    </div>
    <div class="tweet_desc">
       <h4>June 04th, 2013</h4>
    <p>Integer eget tortor et elit venenatis auctor morbi turpis nulla</p>
    </div>
    <div class="clear"></div>
    </div>  
    <div class="tweet_data">
      <div class="tweet_img">
        <img src="images/tweet-img3.jpg" alt=""/>
    </div>
    <div class="tweet_desc">
       <h4>May 4th, 2013</h4>
    <p>Integer eget tortor et elit venenatis auctor morbi turpis nulla</p>
    </div>
    <div class="clear"></div>
    </div>  
     </div>     
        <div class="footer_grid2">
          <h3>Page Layout</h3>
                <ul>
                        <li><a href="{{ url('/') }}">Home</a></li>
                    <li><a href="{{ url('sign-up') }}">Register</a></li>
                    <li><a href="{{ url('sign-in') }}">Login</a></li>                   
                    <li><a href="">Contact</a></li>
                   </ul>
    <div class="grid2_bottom">
      <h3>Newsletters Signup</h3>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod.......</p>
        <div class="signup">
          <form>
            <input type="text" value="Enter your e-mail here" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Enter your e-mail here';"><input type="submit" value="Sign up">
          </form>
        </div>
      </div>
   </div>
    <div class="footer_grid3">
      <h3>Follow</h3>
                <div class="social_icons">
                  <div class="img_list">
              <ul>
               <li><img src="{{ url('images/facebook.png') }}" alt="" /><a href="#">Facebook</a></li>
               <li><img src="{{ url('images/google+.png') }}" alt="" /><a href="#">Google Plus</a></li>
               <li><img src="{{ url('images/twitter.png') }}" alt="" /><a href="#">Twitter</a></li>
               <li><img src="{{ url('images/linkedin.png') }}" alt="" /><a href="#">Likedin</a></li>
              </ul>
          </div>
          </div>
          
     </div>
   <div class="clear"></div>
  </div>
</div>
     <div class="copy_right">
        <p>Gitlink Blog ©2017 All Rights Reseverd | Design by  <a href="#">Gitlinks InfoSoft</a> </p>
       </div>  
  </div>

    <!-- jQuery -->

  <script type="text/javascript" src="{{ url('js/jquery-1.10.1.min.js') }}"></script>
  <script type="text/javascript" src="{{ url('js/jquery.mousewheel-3.0.6.pack.js') }}"></script> 
  <script type="text/javascript" src="{{ url('js/jquery.fancybox.js') }}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{ url('js/bootstrap.min.js') }}"></script>

    <!-- Contact Form JavaScript -->
    <script src="js/jqBootstrapValidation.js"></script>
    <script src="js/contact_me.js"></script>

    <!-- Theme JavaScript -->
    <script src="{{ url('js/clean-blog.min.js') }}"></script>
   
    <script src="{{ url('js/main.js') }}"></script>

</body>

</html>
