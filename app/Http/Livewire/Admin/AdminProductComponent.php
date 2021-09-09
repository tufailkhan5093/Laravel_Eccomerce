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
        $category->delete();
        session()->flash('message','Product has been deleted Successfully');
    }

    public function render()
    {
        $products=Products::paginate(12);
        return view('livewire.admin.admin-product-component',['products'=>$products])->layout('layouts.base');
    }
}
