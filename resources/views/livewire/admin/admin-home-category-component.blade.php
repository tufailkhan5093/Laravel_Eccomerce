<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Manage Home Categories
                </div>

                <div class="panel-body">
                    @if(Session::has('message'))

                    <div class="alert alert-success">{{Session::get('message')}}</div>
                    @endif
                    <form action="" class="form-horizantal" wire:submit.prevent='UpdateHomeCategory()'>
                        <div class="form-group col-md-8" wire:ignore>
                            <select wire:model='selected_categories' class="sel_categories form-control" name='categories[]' multiple="multiple">
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                          <input wire:model='noofproducts' class="form-control" type="text" placeholder="No of Products">
                        </div>

                        <input type="submit" class="btn btn-info" value="Save">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function()
    {
        $('.sel_categories').select2();
        $('.sel_categories').on('change',function(e)
        {
            var data=$('.sel_categories').select2("val");
            @this.set('selected_categories',data);
        });
    })
</script>
    
@endpush
