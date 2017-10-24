
@if(count($errors))
<div class="form-group">
    <div class="alert alert-danger">
    <button class="close" type="button" data-dismiss="alert" aria-hidden="true">&#215;</button>
    <ul>
    @foreach($errors->all() as $error)
   <li>{{ $error }}</li>
    @endforeach
     </ul>
    </div>
    </div>
@endif
    