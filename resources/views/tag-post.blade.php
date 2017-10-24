@extends('layouts.base2')
@section('content')

<div class="wrap">
    <div class="main">
        <div class="content">
            <div class="box1">
                 @foreach($posts as $post)
                <h3 class="post-title">
                 <a href="{{ url('posts') .'/'. $post->id }}" />
                 {{ $post->title }}
                 </a>
                 </h3>
                    <span>By {{ $post->user->full_name }}- {{ $post->created_at->diffForHumans() }}<span class="comments">{{ $post->comments->count() }} Comments</span></span> 
                    <div class="blog-img">
                    <div class="view-back">
                        <span class="views" title="views">(566)</span>
                        <span class="likes" title="likes">(124)</span>
                        <span class="link" title="link">(24)</span>
                        <a href="single.html"> </a>
                    </div>
                    <img src="{{ url($post->image) }}" >
                </div>
                <div class="blog-data">
                    <p>{{ $post->content }}</p>
                </div>

                    <span><a href="single.html">Continue reading >>></a></span>
                    <a href="{{ url('update-post', ['id' => $post->id])}}">Edit Post <a href="{{ url('delete-post') .'/'. $post->id }}">| Delete Post </a> </a>
                @endforeach     
                
            <div class="clear"></div>
        </div>

         @if(Session::has('success'))
      <div class="alert alert-success">
        <button class="close" type="button" data-dismiss="alert" aria-hidden="true">&#215;</button>
      {{ Session::get('success') }}
      </div>
   @endif

        <div class="comments-area">
                        <h3><img src="{{ url('images/r-blog.png') }}" title="comment">Leave a comment</h3>
                            <form action="{{ route('comments', ['id' => $post->id])}}" method="post">
                            {{ csrf_field() }}
                                <p>
                                    <label>Name</label>
                                    <span>*</span>
                                    <input type="text" name="full_name" value="{{ Auth::user()->full_name }}">
                                </p>
                                <p>
                                    <label>Email</label>
                                    <span>*</span>
                                    <input type="email" name="email" value="{{ Auth::user()->email }}">
                                </p>
                                <p>
                                    <label>Subject</label>
                                    <span>*</span>
                                    <textarea name="body" class="form-control"></textarea>
                                </p>
                                <p>
                                    <input type="submit" value="Post">
                                </p>
                            </form>     
                        </div>

                        <div class="box comment">
        <h2><span>({{ $post->comments->count() }})</span> Comment's</h2>

                    @foreach($post->comments as $comment)
        <ul class="list">
            <li>
                <div class="preview"></div>
                <div class="data">
                    <div class="title">{{ $comment->user->full_name }}  <a href="#"> {{ $comment->created_at->diffForHumans() }}</a></div>
                    <p>{{ $comment->body }}.</p>
                </div>
                <div class="clear"></div>
            </li>
        @endforeach
            </ul>
      <div class="clear"></div>
    </div>


<!--Likes -->
<div class="box comment">
<h2><span>Like this post</span></h2>
 <p class="hidden">{{ $currentUserLiked = false }}</p>
@foreach($post->likes as $like)

@if($like->user->id == $user->id)
<p class="hidden">{{ $currentUserLiked = true}}</p>
@endif
@endforeach
@if(!$currentUserLiked)

<span class="likes">{{ $post->likes->count() }}&nbsp;Likes</span><a href="{{ route('like', ['id' => $post->id])}}">&nbsp;<img src="{{ url('images/likes.png')}}" width="30">&nbsp;Like</a> <br>
 
 @else

<span class="unlikes">{{ $post->likes->count() }}&nbsp;Likes</span><a href="{{ route('unlike', ['id' => $post->id]) }}"><img src="{{ url('images/likes.png')}}" width="30">UnLike</a> <br>

@endif
</div>
<!--Like ends -->

        
                      
                    <div class="page_bottom">
                        <p>Back To : <a href="#">Top</a> |  <a href="#">Home</a></p>
                    </div>
            
</div>
<div class="sidebar">
<div class="sidebar_top">
    <h3>Blog Tags</h3>
    @include('layouts.sidebar')
</div>
<br>

<div class="sidebar_top">
    <h3>Archives</h3>
    @include('layouts.sidebar2')
</div>
            
            <div class="latest_comments">
                    <h3>Latest Comments</h3>
                     @foreach($post->comments as $comment)
                <div class="comments">
                    <p><span>{{ $comment->user->full_name }}</span> commented on</p>
                     <h4><a href="#">{{ $comment->post->title}}</a></h4>
                     <p>{{ $comment->created_at->toFormattedDateString() }}</p>
                </div>
                @endforeach
            </div>



            <div class="latest_photos">
                    <h3>Latest Photos</h3>
                    <ul>
                    
          
                        <li><a class="fancybox" href="images/img3.jpg" data-fancybox-group="gallery" title="Lorem ipsum dolor sit amet"><img src="{{ url($post->image) }}" width="50" height="50" /><span> </span></a></li>
            
                    </ul>
                </div>
        </div>
    <div class="clear"></div>
</div>
</div>
    

     
@endsection