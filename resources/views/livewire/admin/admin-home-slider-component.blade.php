<div class="container" style="padding-top:30px">
    <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        All Slides
                    </div>

                    <div class="col-md-12">
                        <a href="{{route('admin.addhomeslider')}}" class="btn btn-success pull-right">Add New Slide</a>
                    </div>
                
                </div>
                @if(Session::has('message'))
                    <div class="alert alert-success">{{Session::get('message')}}</div>
                @endif

                <div>
                    <table class="table table-striped">
                        <thead>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Price</th>
                            <th>Link</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Action</th>
                        </thead>

                        <tbody>
                            @foreach($slides as $slide)
                            <tr>
                                <td>{{$slide->id}}</td>
                                <td><img src="{{asset('assets/images/sliders')}}/{{$slide->image}}" width="120"/></td>
                                <td>{{$slide->title}}</td>
                                <td>{{$slide->price}}</td>
                                <td>{{$slide->link}}</td>
                                <td>{{$slide->status==1?'Active':'inactive'}}</td>
                                <td>{{$slide->created_at}}</td>
                                
                                <td><a class="btn btn-info btn-sm" href="{{route('admin.edithomeslider',['slide_id'=>$slide->id])}}">Edit</a>
                                    <a class="btn btn-danger btn-sm" wire:click.prevent="deleteSlider({{$slide->id}})">Delete</a></td>
                            </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>

            </div>
    </div>
</div>
