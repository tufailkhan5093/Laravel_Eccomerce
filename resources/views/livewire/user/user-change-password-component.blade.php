<div>
    <div class="container" style="padding:30px 0;">
        <div class="row" style="margin-top:10px;border: 1px rgb(204, 203, 203) solid">
            <div class="col-md-12 container" >
                <div class="panel panel-defaul">
                    <div class="panel-heading" style="margin-left:40%">
                        <h4>Change Password</h4>
                    </div>
                    <div class="panel-body" style="margin-left:40%">
                    @if(Session::has('message'))
                        <div class="alert alert-success">{{Session::get('message')}}</div>
                    @endif
                        <form wire:submit.prevent="changePassword()" action="" class="form-horizontal">
                            <div class="form-group">
                               
                                <div class="col-md-4">
                                    <input wire:model="current_password" type="password" placeholder="Current Password" class="form-control input-md" name="currentpassword" />
                                    @error('current_password')<p class="text-danger">{{$message}}</p>@enderror
                                </div>
                            </div>

                            <div class="form-group">
                               
                                <div class="col-md-4">
                                    <input wire:model="password" type="password" placeholder="New Password" class="form-control input-md" name="currentpassword" />
                                    @error('password')<p class="text-danger">{{$message}}</p>@enderror
                                </div>
                            </div>

                            <div class="form-group">
                              
                                <div class="col-md-4">
                                    <input wire:model="password_confirmation" type="password" placeholder="Confirm Password" class="form-control input-md" name="currentpassword" />
                                </div>
                            </div>

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
