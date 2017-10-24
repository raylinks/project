@extends('layouts.master')
@section('content')
     <!-- **********************************************************************************************************************************************************
      MAIN SIDEBAR MENU
      *********************************************************************************************************************************************************** -->
      <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
              
                  <p class="centered"><a href="profile.html"><img src="{{  Auth::user()->profile_pic }}" onerror=" this.src =''" alt="" class="img-circle" width="120"/></a></p>
                  <h5 class="centered">{{ Auth::user()->full_name}}</h5>
                  <h5 class="centered">joined: {{ \Carbon\Carbon::parse(Auth::user()->created_at)->diffForHumans() }}</h5>
                
                    
                  <li class="mt">
                      <a class="active" href="{{ url('/') }}">
                          <i class="fa fa-dashboard"></i>
                          <span>Dashboard</span>
                      </a>
                  </li>

                  <li class="sub-menu">
                      <a href="{{ url('/create-post') }}" >
                          <i class="fa fa-desktop"></i>
                          <span>Create a Post</span>
                      </a>
                  </li>

                  <li class="sub-menu">
                      <a href="{{ url('/manage-users') }}" >
                          <i class="fa fa-desktop"></i>
                          <span>Manage User</span>
                      </a>
                  </li>

                  <li class="sub-menu">
                  <a data-toggle="modal" data-target="#upload_image_modal" class="btn btn-success btn-lg">Update Profile Picture</a>
                  </li>
                 
                  <li class="sub-menu">
                  <a href="javascript:;" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="logout">
                          <span class="glyphicon glyphicon-log-out" aria-hidden="true" ></span>&nbsp; Log out
                           <form id ="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                           </form>

                      </a>
                  </li>
                 
     

              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">

              <div class="row">
                  <div class="col-lg-9 main-chart">

                      @if(Session::has('success'))
      <div class="alert alert-success">
        <button class="close" type="button" data-dismiss="alert" aria-hidden="true">&#215;</button>
        {{ Session::get('success') }}
      </div>
   @endif



                     <div class="post-preview">
                 @include('layouts.sidebar')
                    <a href="post.html">
                         @foreach($posts as $post)
                        <h3 class="post-title">
                        <a href="{{ url('posts') .'/'. $post->id }}">
                        {{ $post->title }}
                        </a>
                        </h2>
                        <h4 class="post-subtitle">
                            {{ $post->content }}
                        </h3>
                    </a>

                    <p><img src="{{  $post->image }}" width="500" height="320"></p>
                    <p class="post-meta">Posted by <a href="#">{{ $post->user->full_name }}</a> on {{ $post->created_at->toDayDateTimeString() }}</p>
                     <p><a href="{{ url('post-delete') .'/'. $post->id }}">Delete Post</a>
                    <a href="{{ url('admin-update-post', ['id' => $post->id])}}">Edit Post</a>
                    @endforeach
                </div>
                <br>
                    <div class="row">
                    <div class="col-md-12 text-center">
                    {{ $posts->links() }}
                   </div>
                   </div>
                      




























                  
                      
                    
                                    
                    <div class="row">
        
                         <!-- line modal -->
<div class="modal fade" id="upload_image_modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span
                            class="sr-only">Close</span></button>
                <h3 class="modal-title" id="lineModalLabel">Update Profile </h3>
            </div>
            <div class="modal-body">
                <!-- content goes here -->
                <form action="{{ url('update-profile-picture') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" value="{{Auth::user()->id}}" name="id" />
                    <div class="form-group">
                        <label for="exampleInputFile">Profile Picture Upload</label>
                        <input type="file" class="form-control" name="profile_image">
                        <p class="help-block">Select the image you want to upload here.</p>
                    </div>

                    <button type="submit" class="btn btn-default">Update</button>
                </form>

            </div>
            <div class="modal-footer">
                <div class="btn-group btn-group-justified col-md-4 pull-right" role="group" aria-label="group button">
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default" data-dismiss="modal" role="button">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

                        
                    </div><!-- /row -->
                    
                                    
                  </div><!-- /col-lg-9 END SECTION MIDDLE -->
                  
                  
      <!-- **********************************************************************************************************************************************************
      RIGHT SIDEBAR CONTENT
      *********************************************************************************************************************************************************** -->                  
                  
                  <div class="col-lg-3 ds">
                    <!--COMPLETED ACTIONS DONUTS CHART-->
                        <h3>NOTIFICATIONS</h3>
                                        
                      <!-- First Action -->
                      <div class="desc">
                        <div class="thumb">
                            <span class="badge bg-theme"><i class="fa fa-clock-o"></i></span>
                        </div>
                        <div class="details">
                        @foreach($users as $user)
                               <a href="#">{{ $user->full_name}}</a> joined gitlink blog.<br/>
                          <p>{{ \Carbon\Carbon::parse($user->created_at)->diffForHumans() }}</p><br/>
                          @endforeach

                        </div>
                      </div>
                     
                       <!-- USERS ONLINE SECTION -->
                        <h3>ADMIN MEMBERS</h3>
                      <!-- First Member -->
                      <div class="desc">
                        <div class="thumb">
                        <div class="details">
                          @foreach($users as $user)
                        <img src="{{  url($user->profile_pic) }}" onerror=" this.src =''" alt="" class="img-circle" width="35" height="35" />
                        <p><a href="#">{{ $user->full_name}}</a><br/>
                               <muted>Available</muted>
                            </p>
                          @endforeach
                        </div>
                      </div>
                        </div>
                     
                        <!-- CALENDAR-->
                        <div id="calendar" class="mb">
                            <div class="panel green-panel no-margin">
                                <div class="panel-body">
                                    <div id="date-popover" class="popover top" style="cursor: pointer; disadding: block; margin-left: 33%; margin-top: -50px; width: 175px;">
                                        <div class="arrow"></div>
                                        <h3 class="popover-title" style="disadding: none;"></h3>
                                        <div id="date-popover-content" class="popover-content"></div>
                                    </div>
                                    <div id="my-calendar"></div>
                                </div>
                            </div>
                        </div><!-- / calendar -->
                      
                  </div><!-- /col-lg-3 -->
              </div><! --/row -->
          </section>
      </section>
    
@endsection