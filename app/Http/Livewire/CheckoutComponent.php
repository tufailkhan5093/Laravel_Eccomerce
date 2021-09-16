<?php

namespace App\Http\Livewire;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;
use App\Models\Order;
use App\Models\Orderitem;
use Livewire\Component;
use App\Models\Shipping;
use Cart;
use Stripe;

class CheckoutComponent extends Component
{
    public $card_no;
    public $month;
    public $year;
    public $cvc;

    public $ship_to_different;
    public $firstname;
    public $lastname;
    public $email;
    public $mobile;
    public $line1;
    public $line2;
    public $city;
    public $province;
    public $country;
    public $zipcode;

    public $thankyou;

    public $s_firstname;
    public $s_lastname;
    public $s_email;
    public $s_mobile;
    public $s_line1;
    public $s_line2;
    public $s_city;
    public $s_province;
    public $s_country;
    public $s_zipcode;

    public $paymentmode;

    public function updated($fields)
    {
        $this->validateOnly($fields,[
            'firstname'=>'required',
        'lastname'=>'required',
        'mobile'=>'required',
        'email'=>'required|email',
        'line1'=>'required|numeric',
        'country'=>'required',
        'province'=>'required',
        'zipcode'=>'required',
        'city'=>'required',
        'paymentmode'=>'required',

        ]);

        if($this->ship_to_different)
        {
            $this->validateOnly($fields,[
          
                's_firstname'=>'required',
                's_lastname'=>'required',
                's_mobile'=>'required',
                's_email'=>'required|email',
                's_line1'=>'required|numeric',
                's_country'=>'required',
                's_province'=>'required',
                's_zipcode'=>'required',
                's_city'=>'required',
                ]);   
        };

        if($this->paymentmode=='card')
        {
            $this->validateOnly($fields,[
                'card_no'=>'required|numeric',
                'month'=>'required|numeric',
                'year'=>'required|numeric',
                'cvc'=>'required|numeric',
            ]);
        }
    }

    public function placeOrder()
    {
        $this->validate([
          
        'firstname'=>'required',
        'lastname'=>'required',
        'mobile'=>'required',
        'email'=>'required|email',
        'line1'=>'required|numeric',
        'country'=>'required',
        'province'=>'required',
        'zipcode'=>'required',
        'city'=>'required',
        'paymentmode'=>'required',
        ]);

        if($this->paymentmode=='card')
        {
            $this->validate([
                'card_no'=>'required|numeric',
                'month'=>'required|numeric',
                'year'=>'required|numeric',
                'cvc'=>'required|numeric',
            ]);
        }


        
        $order=new Order;
        $order->user_id=Auth::user()->id;
        $order->subtotal=session()->get('checkout')['subtotal'];
        $order->discount=session()->get('checkout')['discount'];
        $order->tax=session()->get('checkout')['tax'];
        $order->total=session()->get('checkout')['total'];

        $order->firstname= $this->firstname;
        $order->lastname= $this->lastname;
        $order->email= $this->email;
        $order->mobile= $this->mobile;
        $order->line1= $this->line1;
        $order->line2= $this->line2;
        $order->city= $this->city;
        $order->province= $this->province;
        $order->country= $this->country;
        $order->zipcode= $this->zipcode;
        $order->status='ordered';
        $order->is_shipping_different=$this->ship_to_different ? 1:0;
        $order->save();

        foreach(Cart::instance('cart')->content() as $item)
        {
            $orderitem=new Orderitem();
            $orderitem->product_id=$item->id;
            $orderitem->order_id=$order->id;
            $orderitem->price=$item->price;
            $orderitem->quantity=$item->qty;
            $orderitem->save();
        };

        if($this->ship_to_different)
        {
            $this->validate([
          
                's_firstname'=>'required',
                's_lastname'=>'required',
                's_mobile'=>'required',
                's_email'=>'required|email',
                's_line1'=>'required|numeric',
                's_country'=>'required',
                's_province'=>'required',
                's_zipcode'=>'required',
                's_city'=>'required',
                ]);

                $shipping=new Shipping();
                $shipping->order_id=$order->id;
                $shipping->firstname= $this->s_firstname;
                $shipping->lastname= $this->s_lastname;
                $shipping->email= $this->s_email;
                $shipping->mobile= $this->s_mobile;
                $shipping->line1= $this->s_line1;
                $shipping->line2= $this->s_line2;
                $shipping->city= $this->s_city;
                $shipping->province= $this->s_province;
                $shipping->country= $this->s_country;
                $shipping->zipcode= $this->s_zipcode;
                $shipping->save();
        };

        if($this->paymentmode=='cod')
        {
            $this->makeTransaction($order->id,'pending');
            $this->resetCart();

        }
        else if($this->paymentmode=='card')
        {
            $strpie=Stripe::make(env('STRIPE_KEY'));
            try{
                $token=$strpie->tokens()->create([
                    'card'=>[
                        'number'=>$this->card_no,
                        'exp_month'=>$this->month,
                        'exp_year'=>$this->year,
                        'cvc'=>$this->cvc,
                    ]
                ]);

                if(!isset($token['id']))
                {
                    session()->flash('stripe_error','The stripe token was not generated correctly!');
                    $this->thankyou=0;
                }
                $customer=$strpie->customers()->create([
                    'name'=>$this->firstname.' '.$this->lastname,
                    'email'=>$this->email,
                    'phone'=>$this->mobile,
                    'address'=>[
                        'line1'=>$this->line1,
                        'postal_code'=>$this->zipcode,
                        'city'=>$this->city,
                        'state'=>$this->province,
                        'country'=>$this->country,

                    ],
                    'shipping'=>[
                        'name'=>$this->firstname.' '.$this->lastname,
                        'address'=>[
                            'line1'=>$this->line1,
                            'postal_code'=>$this->zipcode,
                            'city'=>$this->city,
                            'state'=>$this->province,
                            'country'=>$this->country,
    
                        ],

                    ],
                    'source'=>$token['id']
                ]);
                $charge=$strpie->charges()->create([
                    'customer'=>$customer['id'],
                    'currency'=>'USD',
                    'amount'=>session()->get('checkout')['total'],
                    'description'=>'Payment for order no '.$order->id,
                ]);

                if($charge['status']=='succeeded')
                {
                    $this->makeTransaction($order->id,'approval');
                    $this->resetCart();
                }
                else
                {
                    session()->flash('stripe_error','Error in Transaction');
                    $this->thankyou=0;
                }
            }
            catch(Exception $e)
            {
                session()->flash('stripe_error',$e->getMessage());
                $this->thankyou=0;
            }
        }

       
        
    }

    public function resetCart()
    {
    $this->thankyou=1;
    Cart::instance('cart')->destroy();
    session()->forget('checkout');
    return redirect()->route('thankyou');
    }

    public function makeTransaction($order_id,$status)
    {
        $transaction=new Transaction();
        $transaction->user_id=Auth::user()->id;
        $transaction->order_id=$order_id;
        $transaction->mode=$this->paymentmode;
        $transaction->status=$status;
        $transaction->save();

    }

    public function verifyForCheckout()
    {
        if(!Auth::check())
        {
            return redirect()->route('login');
        }
        else if(!session()->get('checkout'))
        {
            return redirect()->route('product.cart');
        }
        else if($this->thankyou)
        {
            return redirect()->route('thankyou');
        }
    }

   

    public function render()
    {
        $this->verifyForCheckout();
        return view('livewire.checkout-component')->layout('layouts.base');
    }
}
