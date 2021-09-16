<?php

namespace App\Http\Livewire;
use Cart;
use Livewire\Component;

class WishlistComponent extends Component
{

    public function removeWishlist($product_id)
    {
        foreach(Cart::instance('wishlist')->content() as $witem)
        {
            if($witem->id==$product_id)
            {
                Cart::instance('wishlist')->remove($witem->rowId);
                $this->emitTo('wishlist-count-component','refreshComponent');
            }
        }
    }

  

    public function movetoCart($rowId)
    {
        $item=Cart::instance('wishlist')->get($rowId);
        Cart::instance('wishlist')->remove($rowId);
        Cart::instance('cart')->add($item->id,$item->name,1,$item->price)->associate('App\Models\Products');
        $this->emitTo('wishlist-count-component','refreshComponent');
        $this->emitTo('cart-count-component','refreshComponent');
    }
    public function render()
    {
        return view('livewire.wishlist-component')->layout('layouts.base');
    }
}
