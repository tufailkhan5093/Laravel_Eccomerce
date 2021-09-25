<?php

namespace App\Http\Livewire\Admin;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Products;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Carbon;

class AddProductComponent extends Component
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
    public $images;
    public $category_id;
    public $scategory_id;


    public function mount()
    {
        $this->stock_status='instock';
        $this->featured=0;
    }

    public function generateSlug()
    {
        $this->slug=Str::slug($this->name);
    }

    public function addProducts()
    {
        $product=new Products;
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

        $imageName=Carbon::now()->timestamp.'.'.$this->image->extension();
        $this->image->storeAs('products',$imageName);
        $product->image=$imageName;

        if($this->images)
        {
            $imagesName='';
            foreach($this->images as $key=>$image)
            {
                $imageName=Carbon::now()->timestamp.$key.'.'.$image->extension();
                $image->storeAs('products',$imageName);
                $imagesName=$imagesName.','.$imageName;
            }
            $product->images=$imagesName;
        }
        if($this->scategory_id)
        {
            $product->subcategory_id=$this->scategory_id;
        }

        $product->save();

        session()->flash('message','Product added Successfully');
    }

    public function changeSubCategory()
    {
        $this->scategory_id=0;
    }

    public function render()
    {
        $categories=Category::all();
        $scategories=Subcategory::where('category_id',$this->category_id)->get();
        return view('livewire.admin.add-product-component',['categories'=>$categories,'scategories'=>$scategories])->layout('layouts.base');
    }
}