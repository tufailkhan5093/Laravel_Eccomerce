<?php

namespace App\Http\Livewire\Admin;
use Livewire\WithPagination;
use App\Models\Products;
use Livewire\Component;

class AdminProductComponent extends Component
{
    use WithPagination;

    public function deleteproduct($id)
    {
        $category=Products::find($id);
        if($category->image)
        {
            unlink('assets/images/products'.'/'.$category->image);   //for deleteing product image too
        }

        if($category->images)
        {
            $images=explode(',',$category->images);
            foreach($images as $image)
            {
                if($image)
                {
                    unlink('assets/images/products'.'/'.$image);
                }
                  //for deleteing product image too
            }
        }
        $category->delete();
        session()->flash('message','Product has been deleted Successfully');
    }

    public function render()
    {
        $products=Products::paginate(12);
        return view('livewire.admin.admin-product-component',['products'=>$products])->layout('layouts.base');
    }
}