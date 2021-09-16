<?php

namespace App\Http\Livewire\Admin;
use App\Models\Coupon;
use Livewire\Component;

class AdminAddCouponComponent extends Component
{
    public $code;
    public $value;
    public $type;
    public $cart_value;
    public $coupon_id;
    public $expiry_date;



    public function storeCoupon()
    {
        $coupon=new Coupon;
        $coupon->code=$this->code;
        $coupon->value=$this->value;
        $coupon->type=$this->type;
        $coupon->cart_value=$this->cart_value;
        $coupon->expiry_date=$this->expiry_date;

        $coupon->save();
        session()->flash('message','Coupan has beed added succesfully');
    }

    public function render()
    {
        return view('livewire.admin.admin-add-coupon-component')->layout('layouts.base');
    }
}
