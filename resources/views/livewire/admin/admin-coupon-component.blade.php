<div class="container mt-5 border-2">
    <div class="row">
        <div class="col-md-12 border-2">
            <div class="panel-heading">
                All Coupons
            </div>

            <div class="panel-heading">

                @if(Session::has('message'))
                    <div class="alert alert-success">{{Session::get('message')}}</div>
                @endif

                <a class="btn btn-success pull-right" href="{{route('admin.addcoupons')}}">Add New</a>
            </div>

            <table class="table table-hover border">
                <thead>
                    <th>ID</th>
                    <th>Coupon Code</th>
                    <th>Coupon Type</th>
                    <th>Coupon Value</th>
                    <th>Cart Value</th>
                    <th>Expiry Date</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    @foreach($coupons as $coupon)
                    <tr>
                        <td>{{$coupon->id}}</td>
                        <td>{{$coupon->code}}</td>
                        <td>{{$coupon->type}}</td>
                        @if($coupon->type=='fixed')
                            <td>${{$coupon->value}}</td>
                        @else
                        <td>{{$coupon->value}}%</td> 
                        @endif
                        <td>{{$coupon->cart_value}}</td>
                        <td>{{$coupon->expiry_date}}</td>
                        <td><a class="btn btn-info btn-sm" href="{{route('admin.editcoupons',['coupon_id'=>$coupon->id])}}">Edit</a>
                            <a onclick="confirm('Are you sure, You want to delete this Category ?') || event.stopImmediatePropagation()" class="btn btn-danger btn-sm" wire:click.prevent="deleteCoupon({{$coupon->id}})" >Delete</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
         
            
        </div>
    </div>
    
</div>

