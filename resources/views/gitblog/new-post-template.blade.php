
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
                @if(Session::has('success'))
        <div class="alert alert-success">
        <button class="close" type="button" data-dismiss="alert" aria-hidden="true">&#215;</button>
        {{ Session::get('success') }}
        </div>
        @endif
               
                <h3>Create a post</h3>
    
                 <form role="form" method="POST" action="{{ route('gitblog.new-post') }}" enctype="multipart/form-data">
                  
   {{ csrf_field() }}
    <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
    <label for="title">Title</label>
    <input type="text" name="title" class="form-control" id="title">
      @if ($errors->has('title'))
      <span class="help-block">
        <strong class="bg-white" style="color:black;">{{ $errors->first('title') }}</strong>
      </span>
      @endif
    </div>


    <div class="form-group {{ $errors->has('content') ? ' has-error' : '' }}">
    <label for="title">Content</label>
    <input type="text" name="content" class="form-control" id="content">
      @if ($errors->has('content'))
      <span class="  help-block">
        <strong class="bg-white" style="color:black;">{{ $errors->first('content') }}</strong>
      </span>
      @endif
    </div>

     <div class="form-group">
                        <label for="post_image">Image Upload</label>
                        <input type="file" class="form-control" name="post_image">
                         @if ($errors->has('post_image'))
                        <span class="help-block">
        <strong class="bg-white" style="color:black;">{{ $errors->first('post_image') }}</strong>
      </span>
      @endif
      </div>
    
      @foreach($tags as $tag)
    <div class="checkbox">
    <label>
      <input type="checkbox" name="tags[]" value="{{ $tag->id }}"> {{ $tag->name }}
      </label>
      </div>
      @endforeach
    
      

    <button type="submit" class="btn btn-success btn-lg"/>Publish</button>


  </form>

 <br/> 
<a data-toggle="modal" data-target="#upload_image_modal" class="btn btn-success btn-lg">Update Profile Picture</a>


</div>  
</div>




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
