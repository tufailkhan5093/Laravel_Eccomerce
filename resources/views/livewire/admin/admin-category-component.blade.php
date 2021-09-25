{{-- <style>
    .sclist{
        list-style: none;
    }
</style> --}}

<div class="container mt-5 border-2">
  

    <div class="row">
        <div class="col-md-12 border-2">
            <div class="panel-heading">
                All Categories
            </div>

            <div class="panel-heading">

                @if(Session::has('message'))
                    <div class="alert alert-success">{{Session::get('message')}}</div>
                @endif

                <a class="btn btn-success pull-right" href="{{route('admin.addcategories')}}">Add New</a>
            </div>

            <table class="table table-hover border">
                <thead>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Sub Categories</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    
                    @foreach($categories as $category)
                    <tr>
                        <td>{{$category->id}}</td>
                        <td>{{$category->name}}</td>
                        <td>{{$category->slug}}</td>
                        <td>
                            <ul class="sclist">
                                @foreach ($category->subCategories as $scategory)

                                    <li><i class="fa fa-caret-right"></i>{{$scategory->name}}<a href="{{route('admin.editcategory',['category_slug'=>$category->slug,'scategory_slug'=>$scategory->slug])}}">Edit</a>
                                        <a onclick="confirm('Are you sure, You want to delete this Sub Category ?') || event.stopImmediatePropagation()" class="btn btn-danger btn-sm" wire:click.prevent="deleteSubCategory({{$scategory->id}})">Delete</a></li>

                                @endforeach
                            </ul>
                        </td>

                        

                        <td><a class="btn btn-info btn-sm" href="{{route('admin.editcategory',['category_slug'=>$category->slug])}}">Edit</a>
                            <a onclick="confirm('Are you sure, You want to delete this Category ?') || event.stopImmediatePropagation()" class="btn btn-danger btn-sm" wire:click.prevent="deleteCategory({{$category->id}})">Delete</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
           
            
        </div>
    </div>
    
</div>
