<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Carbon;
use App\Models\Products;
use App\Models\Category;
class AdminEditProductComponent extends Component
{

    use WithFileUploads;
    public $name;
    public $slug;
    public $short_description;
    public $description;
    public $price;
    public $sale_price;
    public $sku;
    public $stock_status;
    public $featured;
    public $quantity;
    public $image;
    public $category_id;
    public $new_image;
    public $product_id;


    public function mount($slug)
    {
        $this->slug=$slug;
        $product=Products::where('slug',$slug)->first();
        $this->product_id=$product->id;
        $this->name=$product->name;
        $this->short_description=$product->short_description;
        $this->description=$product->description;
        $this->price=$product->price;
        $this->sale_price=$product->sale_price;
        $this->image=$product->image;
        $this->quantity=$product->quantity;
        $this->sku=$product->SKU;
        $this->featured=$product->featured;
        $this->category_id=$product->id;
        $this->stock_status=$product->stock_status;
       
       
    }

    public function generateSlug()
    {
        $this->slug=Str::slug($this->name);
    }

    public function updateProduct()
    {
        $product=Products::find($this->product_id);
        $product->name=$this->name;
        $product->slug=$this->slug;
        $product->price=$this->price;
        $product->sale_price=$this->sale_price;
        $product->short_description=$this->short_description;
        $product->description=$this->description;
        $product->SKU=$this->sku;
        $product->stock_status=$this->stock_status;
        $product->quantity=$this->quantity;
        $product->category_id=$this->category_id;
        if($this->new_image)
        {
            $imageName=Carbon::now()->timestamp.'.'.$this->new_image->extension();
            $this->new_image->storeAs('products',$imageName);
            $product->image=$imageName;
        }
        
        $product->save();

        session()->flash('message','Product Updated');


    }

    public function render()
    {
        $categories=Category::all();
        return view('livewire.admin-edit-product-component',['categories'=>$categories])->layout('layouts.base');
    }
}
