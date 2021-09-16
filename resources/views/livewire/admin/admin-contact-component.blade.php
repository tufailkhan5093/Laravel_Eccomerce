<div class="container" style="padding:30px 0;">
    <div class="row">
        <div class="col-md-12" style="margin-top:10px;border: 1px rgb(204, 203, 203) solid">
            <div class="panel panel-heading">
               
            </div>

            <div class="panel-body" >
            <h4>Contact Messages</h4>

                @if(Session::has('message'))
                    <div class="alert alert-success">{{Session::get('message')}}</div>
                @endif

                <a class="btn btn-success pull-right" href="{{route('admin.addcoupons')}}">Add New</a>
            </div>

            <table class="table table-striped">
                <thead>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Message</th>
                    <th>Created at</th>
                   
                </thead>
                <tbody>
                    @foreach($contacts as $coupon)
                    <tr>
                        <td>{{$coupon->id}}</td>
                        <td>{{$coupon->name}}</td>
                        <td>{{$coupon->email}}</td>
                    
                        <td>{{$coupon->phone}}</td>
                        <td>{{$coupon->comment}}</td>
                        <td>{{$coupon->created_at}}</td>
                       
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{$contacts->links()}}
         
            
        </div>
    </div>
    
</div>

