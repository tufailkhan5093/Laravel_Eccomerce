<style>
    nav svg{
        height:20px;
    }

    nav .hidden{
        display:block !important;
    }
    </style>

<div class="container mt-5 border-2">
    <div class="row">
        <div class="col-md-12 border-2">
            <div class="panel-heading">
                My Orders
            </div>

            <div class="panel-heading">

                @if(Session::has('message'))
                    <div class="alert alert-success">{{Session::get('message')}}</div>
                @endif

                <a class="btn btn-success pull-right" href="{{route('admin.addcoupons')}}">Add New</a>
            </div>

            <table class="table table-striped">
                <thead>
                    <th>Order ID</th>
                    <th>Subtotal</th>
                    <th>Discount</th>
                    <th>Tax</th>
                    <th>Total</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>ZipCode</th>
                    <th>Status</th>
                    <th>Order Date</th>
                    <th>Action</th>
                   
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>{{$order->id}}</td>
                            <td>${{$order->subtotal}}</td>
                            <td>${{$order->discount}}</td>
                            <td>${{$order->tax}}</td>
                            <td>${{$order->total}}</td>
                            <td>{{$order->firstname}}</td>
                            <td>{{$order->lastname}}</td>
                            <td>{{$order->email}}</td>
                            <td>{{$order->zipcode}}</td>
                            <td>{{$order->status}}</td>
                            <td>{{$order->created_at}}</td>
                            <td><a class="btn btn-info btn-sm" href="{{route('user.detail',['order_id'=>$order->id])}}">Detail</a></td>
                            

                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{$orders->links()}}
         
            
        </div>
    </div>
    
</div>

