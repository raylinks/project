 <div class="col-lg-10 col-lg-offset-1" style="background-color:white;">
    
        <br>
        <p>Back to account :: <a href="{{ url('/profile')}}" class="btn btn-info">Back</a></p>
          @if(Session::has('success'))
      <div class="alert alert-success">
        <button class="close" type="button" data-dismiss="alert" aria-hidden="true">&#215;</button>
        {{ Session::get('success') }}
      </div>
        @endif
                  
        <br/>
        <h1 class="">All Blog Users</h1>
        <h3></h3>
        @if($users->count() > 0)
            <table class="table table-bordered">
                <thead>
                <tr> 
                    <th>User Id</th>
                    <th>Full Name</th>
                    <th>Phone Number</th>
                    <th>Email</th>
                    <th>Profile Photo</th>
                    <th>Action</th>
                  
                </tr>
                </thead>
                

                <tbody>
                        @foreach($users as $user)
                <tr>
                        <th> {{ $user->id }}</th>
                        <th> {{ $user->full_name }}</th>
                        <th> {{ $user->phone_num }}</th>
                        <th> {{ $user->email }}</th>
                        <th><img src="{{ $user->profile_pic }}" width="40" height="40" /></th>
                        <th>
                        <a href="{{ url('/delete-user') .'/'. $user->id }}">Delete User</a>
                        </th>
                 </tr>
                     @endforeach
                </tbody>
            </table>
        @else
            <div class="alert alert-info"> No Blog Users found at this time...check back later</div>
        @endif
        <div class="row">
                    <div class="col-md-12 text-center">
                    {{ $users->links() }}
                   </div>
                   </div>
 

    </div>