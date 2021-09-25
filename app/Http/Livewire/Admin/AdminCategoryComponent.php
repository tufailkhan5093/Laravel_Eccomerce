<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Category;
use App\Models\Subcategory;

class AdminCategoryComponent extends Component
{
    use WithPagination;

    public function deleteCategory($id)
    {
        $category=Category::find($id);
        $category->delete();
        session()->flash('message','Category has been deleted Successfully');
    }

    public function deleteSubCategory($id)
    {
        $category=Subcategory::find($id);
        $category->delete();
        session()->flash('message','Sub Category has been deleted Successfully');
    }
    
    public function render()
    {
        $categories=Category::all();
        return view('livewire.admin.admin-category-component',['categories'=>$categories])->layout('layouts.base');
    }
}