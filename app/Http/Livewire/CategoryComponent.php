<?php

namespace App\Http\Livewire;
use Cart;
use App\Models\Products;
use App\Models\Category;
use App\Models\Subcategory;
use Livewire\WithPagination;
use Livewire\Component;



class CategoryComponent extends Component
{
    public $sorting;
    public $pagesize;
    public $category_slug;
    public $scategory_slug;

    public function mount($category_slug,$scategory_slug=null)
    {
        $this->sorting='default';
        $this->pagesize=12;
        $this->category_slug=$category_slug;
        $this->scategory_slug=$scategory_slug;  
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
        $category_id=null;
        $category_name="";
        $filter="";

        if($this->scategory_slug)
        {
            $scategory=Subcategory::where('slug',$this->scategory_slug)->first();
            $category_id=$scategory->id;
            $category_name=$scategory->name;
            $filter="sub";
        }
        else 
        {
            $category=Category::where('slug',$this->category_slug)->first();
            $category_id=$category->id;
            $category_name=$category->name;
            $filter="";
        }
        

        
        

        if($this->sorting=='date')
        {
            $products=Products::where($filter.'category_id',$category_id)->orderBy('created_at','DESC')->paginate($this->pagesize);
        }

        else if($this->sorting=='price')
        {
            $products=Products::where($filter.'category_id',$category_id)->orderBy('price','ASC')->paginate($this->pagesize);
        }

        else if($this->sorting=='price-desc')
        {
            $products=Products::where($filter.'category_id',$category_id)->orderBy('price','DESC')->paginate($this->pagesize);
        }
        else{
            $products=Products::where($filter.'category_id',$category_id)->paginate($this->pagesize);
        }

        $categories=Category::all();
        
        return view('livewire.category-component',['products'=>$products,'categories'=>$categories,'category_name'=>$category_name])->layout('layouts.base');
    }
}