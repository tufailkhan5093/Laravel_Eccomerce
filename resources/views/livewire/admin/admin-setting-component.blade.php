<div>
    <div class="container" style="padding:30px 0;">
        <div class="row" style="margin-top:10px;border: 1px rgb(204, 203, 203) solid">
            <div class="col-md-12 container" >
                <div class="panel panel-defaul">
                    <div class="panel-heading" style="margin-left:40%">
                        <h4>Admin Setting</h4>
                    </div>
                    <div class="panel-body col-md-6" style="margin-left:25%;">
                    @if(Session::has('message'))
                        <div class="alert alert-success">{{Session::get('message')}}</div>
                    @endif
                        <form wire:submit.prevent="saveSetting()" action="" class="form-horizontal">
                         <input wire:model="email" placeholder="Email" class="form-control"><br>
                         @error('email')<p class="text-danger">{{$message}}</p>@enderror
                         <input wire:model="phone" placeholder="Phone" class="form-control"><br>
                         @error('phone')<p class="text-danger">{{$message}}</p>@enderror
                         <input wire:model="phone2" placeholder="phone2" class="form-control"><br>
                         @error('phone2')<p class="text-danger">{{$message}}</p>@enderror
                         <input wire:model="address" placeholder="address" class="form-control"><br>
                         @error('address')<p class="text-danger">{{$message}}</p>@enderror
                         <input wire:model="map" placeholder="map" class="form-control"><br>
                         @error('map')<p class="text-danger">{{$message}}</p>@enderror
                         <input wire:model="twitter" placeholder="twitter" class="form-control"><br>
                         @error('twitter')<p class="text-danger">{{$message}}</p>@enderror
                         <input wire:model="instagram" placeholder="instagram" class="form-control"><br>
                         @error('instagram')<p class="text-danger">{{$message}}</p>@enderror
                         <input wire:model="facebook" placeholder="facebook" class="form-control"><br>
                         <input wire:model="pinterest" placeholder="pinterest" class="form-control"><br>
                         @error('pinterest')<p class="text-danger">{{$message}}</p>@enderror
                         <input wire:model="youtube" placeholder="youtube" class="form-control"><br>
                         @error('youtube')<p class="text-danger">{{$message}}</p>@enderror
                            <div class="form-group">
                             
                                <div class="col-md-4">
                                    <input type="submit" value="Submit" class="btn btn-primary" />
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
