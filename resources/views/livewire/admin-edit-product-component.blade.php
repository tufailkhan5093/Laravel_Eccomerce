
    <div class="container mt-4" style="padding-top: 30px">
        <div class=" panel panel-head">
            <div class="col-md-10 container containerr mt-4">
                <div class="row" style="padding-top: 30px">
                    <div class="col-md-6">
                        <h3 style="margin-left: 20px">Edit Products</h3>
                    </div>

                    <div class="col-md-6 mt-2">
                        <a class="btn btn-success pull-right" href="{{route('admin.products')}}">All Products</a>
                    </div>
                </div>

               <br><br>
                    <div class="col-md-10 ml-5">

                        @if(Session::has('message'))
                            <div class="alert alert-success">{{Session::get('message')}}</div>
                        @endif

                   <form  class="form-group" enctype="multipart/form-data" wire:submit.prevent="updateProduct()">
                        <input wire:model="name" wire:keyup="generateSlug()" type="text" placeholder="Product Name" class="form-control"><br>
                        <input wire:model="slug" placeholder="Product Slug" class="form-control"><br>
                        <textarea wire:model="short_description" placeholder="Short Description" class="form-control"></textarea><br>
                        <textarea wire:model="description" placeholder="Description" class="form-control"></textarea><br>
                        <input wire:model="price" type="text" placeholder="Price" class="form-control"><br>
                        <input wire:model="sale_price" type="text" placeholder="Sale Price" class="form-control"><br>
                        <input wire:model="sku" type="text" placeholder="SKU" class="form-control"><br>
                        <select wire:model="stock_status" class="form-control">
                            <option value="instock">Instock</option>
                            <option value="outofstock">Out of Stock</option>
                        </select><br>

                        <select wire:model="featured" class="form-control">
                            <option value="0">No</option>
                            <option value="1">Yes</option>
                        </select><br>

                        <input wire:model="quantity" type="text" placeholder="Quantity" class="form-control"><br>

                        <input wire:model="new_image" type="file"  class="form-control input-file"><br>
                            @if($new_image)
                            <img src="{{$new_image->temporaryUrl()}}" width="120" />
                            @else 
                            <img src="{{ asset('assets/images/products') }}/{{$image}}" width="120" />
                            @endif

                        
                            <input wire:model="newimages" multiple type="file"  class="form-control input-file"><br>
                                    @if($newimages)

                                    @foreach ($newimages as $newimage)
                                        @if ($newimage)

                                        <img src="{{$newimage->temporaryUrl()}}" width="120" />
                                        @endif
                                        
                                    @endforeach
                                
                                    @else 
                                    @foreach ($images as $newimage)
                                    @if ($newimage)

                                    <img src="{{asset('assets/images/products')}}/{{$image}}" width="120" />
                                    @endif
                                    
                                    @endforeach
                                    @endif
                        <select wire:model="category_id" class="form-control" wire:change="changeSubCategory()">
                            @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select><br>

                        <select wire:model="scategory_id" class="form-control">
                            <option value="0">Select Category</option>
                            @foreach($scategories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select><br>

                        <input type="submit" class="btn btn-danger" value="Update">


                   </form>


                  
                </div>
                
            </div>
        </div>
    </div>

