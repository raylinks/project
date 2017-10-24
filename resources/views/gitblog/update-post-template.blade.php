
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
                @if(Session::has('success'))
        <div class="alert alert-success">
        <button class="close" type="button" data-dismiss="alert" aria-hidden="true">&#215;</button>
        {{ Session::get('success') }}
        </div>
        @endif

       @if(Session::has('danger'))
        <div class="alert alert-danger">
        <button class="close" type="button" data-dismiss="alert" aria-hidden="true">&#215;</button>
        {{ Session::get('danger') }}
        </div>
        @endif
               
               
                <h3>Edit Post</h3>
    
                 <form role="form" method="POST" action="{{ route('gitblog.update-post') }}" enctype="multipart/form-data">

   {{ csrf_field() }}
    <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
    <label for="title">Title</label>
    <input type="text" name="title" class="form-control" value="{{ $posts->title}}" id="title">
      @if ($errors->has('title'))
      <span class="help-block">
        <strong class="bg-white" style="color:black;">{{ $errors->first('title') }}</strong>
      </span>
      @endif
    </div>


    <div class="form-group {{ $errors->has('content') ? ' has-error' : '' }}">
    <label for="title">Content</label>
    <input type="text" name="content" class="form-control" value="{{ $posts->content}}" id="content">
      @if ($errors->has('content'))
      <span class="  help-block">
        <strong class="bg-white" style="color:black;">{{ $errors->first('content') }}</strong>
      </span>
      @endif
    </div>

     <div class="form-group">
                        <label for="post_image">Image Upload</label>
                        <input type="file" class="form-control" name="post_image" >
                         @if ($errors->has('post_image'))
                        <span class="help-block">
        <strong class="bg-white" style="color:black;">{{ $errors->first('post_image') }}</strong>
      </span>
      @endif
      </div>
    

       @foreach($tags as $tag)
    <div class="checkbox">
    <label>
      <input type="checkbox" name="tags[]" value="{{ $tag->id }}" {{ $posts->tags->contains($tag->id) ? 'checked' : '' }}> {{ $tag->name }}
      </label>
      </div>
      @endforeach
    
    <input type="hidden" name="id" value="{{ $postId }}" />
      

    <button type="submit" class="btn btn-success btn-lg"/>Update</button>


  </form>

  





             </div>  
            </div>
