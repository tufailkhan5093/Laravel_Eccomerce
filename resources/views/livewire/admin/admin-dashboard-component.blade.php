<div class="container">
    <div class="row" style="margin-top: 20px">

        <div class="col-md-3" style="border: 0.5px rgb(170, 170, 170) solid;">
            <h4 class="text-center">Total Sales</h4>
            <h3 class="text-center">{{$totalsales}}</h3>
            <hr>

            <p>Updated at: {{Carbon\Carbon::today()}}</p>
        </div>


        <div class="col-md-3" style="border: 0.5px rgb(170, 170, 170) solid;">
            <h4 class="text-center">Total Revenue</h4>
            <h3 class="text-center">${{$totalRevenue}}</h3>
            
            <hr>

            <p>Updated at: {{Carbon\Carbon::today()}}</p>
        </div>


        <div class="col-md-3" style="border: 0.5px rgb(170, 170, 170) solid;">
            <h4 class="text-center">Today Sales</h4>
            <h3 class="text-center">{{$todaySales}}</h3>
            <hr>

            <p>Updated at: {{Carbon\Carbon::today()}}</p>
        </div>

        <div class="col-md-3" style="border: 0.5px rgb(170, 170, 170) solid;">
            <h4 class="text-center">Today Revenue</h4>
            <h3 class="text-center">{{$todayRevenue}}</h3>
            <hr>

            <p>Updated at: {{Carbon\Carbon::today()}}</p>
        </div>
    </div>


    <div class="row" style="margin-top: 20px;border: 0.5px rgb(170, 170, 170) solid;">
        <div class="col-md-12">
            <div class="panel-heading">
                <h3 style="background-color: rgb(0, 132, 184);padding:10px;color:white" class="text-center">Latest Orders</h3>
            </div>

            <div class="panel-heading">

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
                            


                        </tr>
                    @endforeach
                </tbody>
            </table>
            
         
            
        </div>
    </div>
    
</div>
