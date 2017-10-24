@extends('layouts.base')
@section('content')

<div class="wrap">
    <div class="main">
        <div class="content">
        <!-- ERROR DISPLAY BEGINS -->
           @if(Session::has('danger'))
        <div class="alert alert-danger">
        <button class="close" type="button" data-dismiss="alert" aria-hidden="true">&#215;</button>
        {{ Session::get('danger') }}
        </div>
        @endif
               
        @if(Session::has('success'))
        <div class="alert alert-success">
        <button class="close" type="button" data-dismiss="alert" aria-hidden="true">&#215;</button>
        {{ Session::get('success') }}
        </div>
        @endif

        <!-- ERROR DISPLAY ENDS -->

            <div class="box1">
            @foreach($posts as $post)
                 <h3><a href="{{ url('posts') .'/'. $post->id }}">{{ $post->title }}</a></h3>
                    <span>By {{ $post->user->full_name }}- {{ $post->created_at->diffForHumans() }}<span class="comments">{{ $post->comments->count() }} Comments</span><span class="comments">{{ $post->likes->count() }} Likes</span></span> 
               <div class="view">
                    <div class="view-back">
                        <span class="views" title="views">(566)</span>
                        <span class="likes" title="likes">(124)</span>
                        <span class="link" title="link">(24)</span>
                        <a href="single.html"> </a>
                    </div>
                    <a href=""><img src="{{ $post->image }}"></a>
                </div>
                <div class="data">
                    <p> {{ $post->content }}</p>
                    <span><a href="single.html">Continue reading >>></a></span>
                    <a href="{{ url('update-post', ['id' => $post->id])}}">Edit Post <a onclick="delete_post('{{$post->id}}');" href="{{ url('delete-post') .'/'. $post->id }}">| Delete Post </a> </a>


                </div>
            <div class="clear"></div>
            @endforeach
        </div>

                    <div class="page_links">
                        <div class="page_numbers">
                            {{ $posts->links() }}
                        </div>  
                        <div class="clear"></div>
                    <div class="page_bottom">
                        <p>Back To : <a href="#">Top</a> |  <a href="#">Home</a></p>
                    </div>

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
             @foreach($posts as $post)
             @foreach($post->comments as $comment)
                <div class="comments">
                    <p><span>{{ $comment->user->full_name }}</span> commented on</p>
                     <h4><a href="{{ url('posts') .'/'. $post->id }}">{{ $comment->post->title}}</a></h4>
                     <p>{{ $comment->created_at->toFormattedDateString() }}</p>
                </div>
                @endforeach
                @endforeach
           </div>
        

            <div class="latest_photos">
                    <h3>Latest Photos</h3>
                    <ul>
                      @foreach($posts as $post)
          
                        <li><a class="fancybox" href="#" data-fancybox-group="gallery" title="Lorem ipsum dolor sit amet"><img src="{{ $post->image }}" width="50" height="50" /><span> </span></a></li>
                        @endforeach
                    </ul>
                </div>
        </div>
    <div class="clear"></div>
</div>
</div>
    

     
@endsection