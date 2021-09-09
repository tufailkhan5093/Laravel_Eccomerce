
    <div class="container mt-4" style="padding-top: 30px">
        <div class=" panel panel-head">
            <div class="col-md-10 container containerr mt-4">
                <div class="row" style="padding-top: 30px">
                    <div class="col-md-6">
                        <h3 style="margin-left: 20px">Add Home Slide</h3>
                    </div>

                    <div class="col-md-6 mt-2">
                        <a class="btn btn-success pull-right" href="{{route('admin.homeslider')}}">All Home Slides</a>
                    </div>
                </div>

               <br><br>
                    <div class="col-md-10 ml-5">

                        @if(Session::has('message'))
                            <div class="alert alert-success">{{Session::get('message')}}</div>
                        @endif

                   <form  class="form-group" enctype="multipart/form-data" wire:submit.prevent="addSlider()">
                        <input wire:model="title"  type="text" placeholder="Title" class="form-control"><br>
                        <input wire:model="subtitle" placeholder="Sub Title" class="form-control"><br>
                        <input wire:model="price" placeholder="Price" class="form-control"><br>
                      
                        <input wire:model="link" type="text" placeholder="Link" class="form-control"><br>
                        <input wire:model="image"  type="file" placeholder="Image" class="form-control"><br>
                        @if($image)
                            <img src="{{$image->temporaryUrl()}}" width="120">
                        @endif
                        <select class="form-control" wire:model="status">
                            <option value="1">Active</option>
                            <option value="0">InActive</option>
                        </select><br>

                      

                        <input type="submit" class="btn btn-danger" value="Submit">


                   </form>


                  
                </div>
                
            </div>
        </div>
    </div>

