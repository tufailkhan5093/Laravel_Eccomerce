<div>
    <div class="container">
        <div class=" panel panel-head">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <h3>Add new Coupon</h3>
                    </div>

                    <div class="col-md-6 mt-2">
                        <a class="btn btn-success" href="{{route('admin.coupons')}}">All Coupons</a>
                    </div>
                </div>

               <br><br>
                    <div class="col-md-6">

                        @if(Session::has('message'))
                            <div class="alert alert-success">{{Session::get('message')}}</div>
                        @endif

                   <form  class="form-group" wire:submit.prevent="storeCoupon()">
                       <input type="text" placeholder="Coupon Code" class=" mb-3 form-control" wire:model="code" ><br><br>
                       <select class="form-control" wire:model="type"><br><br>
                           <option value="fixed">Fixed</option>
                           <option value="percent">Percent</option>
                       </select>
                       <input type="text" placeholder="Value" class=" mb-3 form-control" wire:model="value"><br><br>
                       @error('name') <p class="text-danger">{{$message}}</p>@enderror
                       <input type="text" placeholder="Cart Value" class=" mb-3 form-control" wire:model="cart_value"><br><br>
                       <input type="text" placeholder="Expiry Date" id="expiry-date" class=" mb-3 form-control" wire:model="expiry_date"><br><br>
                       <input type="submit" class=" my-3 btn btn-danger" value="Submit">
                   </form>
                </div>
                
            </div>
        </div>
    </div>
</div>

@push('scripts')

    <script>
        $(function()
        {
            $('#expiry-date').datetimepicker({
                format:'Y-MM-DD'
            })
            .on('dp-change',function(ev)
            {
                var data=$('#expiry-date').val();
                @this.set('expiry-date',data);
            })
        })
    </script>

@endpush
