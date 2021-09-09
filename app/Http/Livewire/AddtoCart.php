<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AddtoCart extends Component
{
    public $slug;

    public function mount($slug)
    {
        $this->slug=$slug; 

    }

    public function render()
    {
        $product=Products::where('slug',$this->slug)->first();
        if(!$product) {
            abort(404);
        }
        $cart = session()->get('cart');


        return view('livewire.addto-cart',['cart'=>$cart])->layout('layouts.base');
    }
}
