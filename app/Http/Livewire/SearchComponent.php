<?php

namespace App\Http\Livewire;
use Cart;
use App\Models\Products;
use App\Models\Category;
use Livewire\WithPagination;
use Livewire\Component;



class SearchComponent extends Component
{
    public $sorting;
    public $pagesize;

    public $search;
    public $product_cat;
    public $product_cat_id;

    public function mount()
    {
        $this->sorting='default';
        $this->pagesize=12;
        $this->fill(request()->only('search','product_cat','product_cat_id'));
    }
    public function store($id,$name,$price)
    {
        Cart::add($id,$name,1,$price)->associate('App\Models\Products');
        session()->put('success_message','Item added to Cart Successfully!');
        return redirect()->route('product.cart');
    }

    use WithPagination;
    public function render()
    {
        if($this->sorting=='date')
        {
            $products=Products::where('name','like','%'.$this->search.'%')->where('category_id',$this->product_cat_id)->orderBy('created_at','DESC')->paginate($this->pagesize);
        }

        else if($this->sorting=='price')
        {
            $products=Products::where('name','like','%'.$this->search.'%')->where('category_id','like','%'.$this->product_cat_id.'%')->orderBy('price','ASC')->paginate($this->pagesize);
        }

        else if($this->sorting=='price-desc')
        {
            $products=Products::where('name','like','%'.$this->search.'%')->where('category_id','like','%'.$this->product_cat_id.'%')->orderBy('price','DESC')->paginate($this->pagesize);
        }
        else{
            $products=Products::where('name','like','%'.$this->search.'%')->where('category_id','like','%'.$this->product_cat_id.'%')->paginate($this->pagesize);
        }

        $categories=Category::all();
        
        return view('livewire.search-component',['products'=>$products,'categories'=>$categories])->layout('layouts.base');
    }
}
