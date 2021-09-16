<?php

namespace App\Http\Livewire;
use Cart;
use App\Models\Coupon;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class CartComponent extends Component
{
    public $haveCouponCode;
    public $couponCode;
    public $discount;
    public $subtotalAfterDiscount;
    public $taxAfterDiscount;
    public $totalAfterDiscount;

    public function increaseQty($rowId)
    {
        $product=Cart::instance('cart')->get($rowId);
        $qty=$product->qty+1;
        Cart::instance('cart')->update($rowId,$qty);
        $this->emitTo('cart-count-component','refreshComponent');
    }

    public function decreaseQty($rowId)
    {
        $product=Cart::instance('cart')->get($rowId);
        $qty=$product->qty-1;
        Cart::instance('cart')->update($rowId,$qty);
        $this->emitTo('cart-count-component','refreshComponent');
    }

    public function destroy($rowId)
    {
        Cart::instance('cart')->remove($rowId);
        session()->flash('success_message','Item has been removed');
        $this->emitTo('cart-count-component','refreshComponent');
    }

    public function destroyAll()
    {
        Cart::instance('cart')->destroy();
        session()->flash('success_message','Cart has been cleaned');
        $this->emitTo('cart-count-component','refreshComponent');
    }

    public function applyCoupon()
    {
        $coupon=Coupon::where('code',$this->couponCode)->where('expiry_date','>',Carbon::today())->where('cart_value','<=',Cart::instance('cart')->subtotal())->first();
        if(!$coupon)
        {
            session()->flash('coupon_message','Coupon code is invalid');
            return;
        }
        else
        {
            session()->put('coupon',[
                'code'=>$coupon->code,
                'type'=>$coupon->type,
                'value'=>$coupon->value,
                'cart_value'=>$coupon->cart_value
            ]);
        }
    }

    public function calculateDiscount()
    {
        if(session()->has('coupon'))
        {
            if(session()->get('coupon')['type']=='fixed')
            {
                $this->discount=session()->get('coupon')['value'];
            }
            else
            {
                $this->discount=(Cart::instance('cart')->subtotal()*session()->get('coupon')['value'])/100;
            }

            $this->subtotalAfterDiscount=Cart::instance('cart')->subtotal()-$this->discount; 
            $this->taxAfterDiscount=($this->subtotalAfterDiscount * config('cart.tax'))/100;
            $this->totalAfterDiscount=$this->subtotalAfterDiscount+$this->taxAfterDiscount;   
        }
    }

    public function removeCoupon()
    {
        session()->forget('coupon');
    }

    public function checkout()
    {
        if(Auth::check())
        {
            return redirect()->route('checkout');
        }
        else
        {
            return redirect()->route('login');
        }
    }

    public function setAmoutforCheckout()
    {
        if(!Cart::instance('cart')->count()>0)
        {
            session()->forget('checkout');
            return;
        }
        if(session()->has('coupon'))
        {
            session()->put('checkout',[
                'discount'=>$this->discount,
                'subtotal'=>$this->subtotalAfterDiscount,
                'tax'=>$this->taxAfterDiscount,
                'total'=>$this->totalAfterDiscount,
            ]);
        }
        else
        {
            session()->put('checkout',[
                'discount'=>0,
                'subtotal'=>Cart::instance('cart')->subtotal(),
                'tax'=>Cart::instance('cart')->tax(),
                'total'=>Cart::instance('cart')->total(),
            ]);

        }
    }


    public function render()
    {
        $this->setAmoutforCheckout();
        if(session()->has('coupon'))
        {
            if(Cart::instance('cart')->subtotal() < session()->get('coupon')['cart_value'])
            {
                session()->forget('coupon');
            }
            else
            {
                $this->calculateDiscount();
            }
        }
        
        return view('livewire.cart-component')->layout('layouts.base');
    }
}
