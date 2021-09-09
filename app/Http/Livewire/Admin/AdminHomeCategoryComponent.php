<?php

namespace App\Http\Livewire\Admin;
use App\Models\HomeCategory;
use App\Models\Category;
use Livewire\Component;

class AdminHomeCategoryComponent extends Component
{
    public $selected_categories=[];
    public $noofproducts;

    public function mount()
    {
        $category=HomeCategory::find(1);
        $this->selected_categories=explode(',',$category->sel_categories);
        $this->noofproducts=$category->no_of_products;
    }

    public function UpdateHomeCategory()
    {
        $category=HomeCategory::find(1);
        $category->sel_categories=implode(',',$this->selected_categories);
        $category->no_of_products=$this->noofproducts;
        $category->save();

        session()->flash('message','HomeCategory has been updated');
    }

    public function render()
    {
        $categories=Category::all();
        return view('livewire.admin.admin-home-category-component',['categories'=>$categories])->layout('layouts.base');
    }
}
