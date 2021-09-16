<?php

namespace App\Http\Livewire\Admin;
use App\Models\Coupon;
use Livewire\Component;

class AdminCouponComponent extends Component
{
    public function deleteCoupon($coupon_id)
    {

        $coupon=Coupon::find($coupon_id);
        $coupon->delete();
        session()->flash('message','Coupan has been deleted');
    }
    public function render()
    {
        $coupons=Coupon::all();
        return view('livewire.admin.admin-coupon-component',['coupons'=>$coupons])->layout('layouts.base');
    }
}
