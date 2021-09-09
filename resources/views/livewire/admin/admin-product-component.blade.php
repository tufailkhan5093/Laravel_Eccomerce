
<div class="container mt-5 border-2">
    <div class="row">
        <div class="col-md-12 border-2">
            <div class="panel-heading">
                All Products
            </div>

            <div class="panel-heading">
        @if(Session::has('message'))
        <div class="alert alert-success">{{Session::get('message')}}</div>
        @endif
               

                <a class="btn btn-success pull-right" href="{{route('admin.addproducts')}}">Add New</a>
            </div>

            <table class="table table-hover border">
                <thead>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Stock</th>
                    <th>Price</th>
                    <th>Category</th>
                    <th>Date</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr>
                        <td>{{$product->id}}</td>
                        <td><img src="{{ asset('assets/images/products') }}/{{$product->image}}" width="60px" /></td>
                        <td>{{$product->name}}</td>
                        <td>{{$product->stock_status}}</td>
                        <td>${{$product->price}}</td>
                        <td>{{$product->category->name}}</td>
                        <td>{{$product->created_at}}</td>
                        <td><a class="btn btn-info btn-sm" href="{{route('admin.editproducts',['slug'=>$product->slug])}}">Edit</a>
                            <a class="btn btn-danger btn-sm" wire:click.prevent="deleteproduct({{$product->id}})">Delete</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $products->links() }}
            
            
        </div>
       
    </div>
    
</div>
