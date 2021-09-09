<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-defaul">
                <div class="panel-heading">
                    Sale Setting
                </div>

                <div class="panel-body">
                    @if(Session::has('message'))
                    <div class="alert alert-success">{{Session::get('message')}}</div>
                    @endif
                    <form action="" class="form-horizontal" wire:submit.prevent="updateSale()">
                            <select class="form-control" wire:model="status">
                                <option value="0">InActive</option>
                                <option value="1">Active</option>
                            </select>

                            <input wire:model="sale_date" class="form-control" type="datetime" id="sale-date" placeholder="YYYY/MM/DD H:M:S">
                    
                            <input type="submit" class="btn btn-info" value="Submit">
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')

<script>
    $(function(){
        $('#sale-date').datetimepicker({
            format : 'Y-MM-DD h:m:s',
        })
        .on('dp-change',function(ev){
            var data=$('#sale-date').val();
            @this.set('sale-date',data);
        });
    })
</script>
@endpush
