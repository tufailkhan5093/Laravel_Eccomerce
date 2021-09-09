<div>
    <div class="container">
        <div class=" panel panel-head">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <h3>Update Category</h3>
                    </div>

                    <div class="col-md-6 mt-2">
                        <a class="btn btn-success" href="{{route('admin.categories')}}">All Categories</a>
                    </div>
                </div>

               <br><br>
                    <div class="col-md-6">

                        @if(Session::has('message'))
                            <div class="alert alert-success">{{Session::get('message')}}</div>
                        @endif

                   <form  class="form-group" wire:submit.prevent="updateCategory">
                       <input type="text" placeholder="Category name" class=" mb-3 form-control" wire:model="name" wire:keyup="generateSlug"><br><br>
                       <input type="text" placeholder="Slug" class=" mb-3 form-control" wire:model="slug"><br><br>
                       <input type="submit" class=" my-3 btn btn-danger" value="Submit">
                   </form>
                </div>
                
            </div>
        </div>
    </div>
</div>
