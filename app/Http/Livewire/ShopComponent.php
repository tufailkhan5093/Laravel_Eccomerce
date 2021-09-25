<?php

namespace App\Http\Livewire;
use Cart;
use App\Models\Products;
use App\Models\Category;
use Livewire\WithPagination;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;


class ShopComponent extends Component
{
    public $sorting;
    public $pagesize;
    public $min_price;
    public $max_price;

    public function mount()
    {
        $this->sorting='default';
        $this->pagesize=12;
        $this->min_price=1;
        $this->max_price=1000;
    }
    public function store($id,$name,$price)
    {
        Cart::instance('cart')->add($id,$name,1,$price)->associate('App\Models\Products');
        session()->put('success_message','Item added to Cart Successfully!');
        $this->emitTo('cart-count-component','refreshComponent');
        return redirect()->route('product.cart');
    }

    public function addtoWishlist($id,$name,$price)
    {
        Cart::instance('wishlist')->add($id,$name,1,$price)->associate('App\Models\Products');
        session()->put('success_message','Item added to Cart Successfully!');
        $this->emitTo('wishlist-count-component','refreshComponent');
        
    }

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

    use WithPagination;
    public function render()
    {
        if($this->sorting=='date')
        {
            $products=Products::whereBetween('price',[$this->min_price,$this->max_price])->orderBy('created_at','DESC')->paginate($this->pagesize);
        }

        else if($this->sorting=='price')
        {
            $products=Products::whereBetween('price',[$this->min_price,$this->max_price])->orderBy('price','ASC')->paginate($this->pagesize);
        }

        else if($this->sorting=='price-desc')
        {
            $products=Products::whereBetween('price',[$this->min_price,$this->max_price])->orderBy('price','DESC')->paginate($this->pagesize);
        }
        else{
            $products=Products::whereBetween('price',[$this->min_price,$this->max_price])->paginate($this->pagesize);
        }

        $categories=Category::all();

        if(Auth::check())
        {
          
                Cart::instance('cart')->store(Auth::user()->email);
                Cart::instance('wishlist')->store(Auth::user()->email);
         
        }

        
        return view('livewire.shop-component',['products'=>$products,'categories'=>$categories])->layout('layouts.base');
    }
}