 <div class="row">
<div class="col-md-6 col-md-offset-3">          
        <h1 class="">Profile Details</h1>
        
            <table class="table table-bordered">
                 <thead>
                <tr> 
                
        <div class="col-md-6 col-md-offset-3">{{ $user->full_name }}</div>
                </tr>
                </thead>

                <thead>
                <tr> 
                    <th>Phone Number</th>
                    <th>Email</th>
                  
                </tr>
                </thead>
                

                <tbody>
                <tr>
                        <th> {{ $user->phone_num }}</th>
                        <th> {{ $user->email }}</th>
                     
                 </tr>
                </tbody>
            </table>
</div>
</div>
        