<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Carbon;
use App\Models\Products;
use App\Models\Category;
use App\Models\Subcategory;
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
    public $scategory_id;

    public $images;
    public $newimages;


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
        $this->scategory_id=$product->scategory_id;

        $this->images=explode(',',$product->images);
        
       
       
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
            unlink('assets/images/products'.'/'.$product->image);
            $imageName=Carbon::now()->timestamp.'.'.$this->new_image->extension();
            $this->new_image->storeAs('products',$imageName);
            $product->image=$imageName;
        }

        if($this->newimages)
        {
            if($product->images)
            {
                $images=explode(',',$product->images);
                foreach($images as $image)
                {
                    if($image)
                    {
                        unlink('assets/images/products'.'/'.$image);
                    }  
                  }
            }

            $imagesName='';
            foreach($this->newimages as $key=>$image)
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

        session()->flash('message','Product Updated');


    }

    public function changeSubCategory()
    {
        $this->scategory_id=0;
    }
    
    public function render()
    {
        $categories=Category::all();
        $scategories=Subcategory::where('category_id',$this->category_id)->get();
        return view('livewire.admin-edit-product-component',['categories'=>$categories,'scategories'=>$scategories])->layout('layouts.base');
    }
}