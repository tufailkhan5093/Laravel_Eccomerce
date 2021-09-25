<?php

namespace App\Http\Livewire;
use App\Models\Category;
use App\Models\Subcategory;
use Livewire\Component;
use Illuminate\Support\Str;
class AdminAddCategory extends Component
{
    public $name;
    public $slug;
    public $category_id;

    public function generateSlug()
    {
        $this->slug=Str::slug($this->name);
    }

    public function updated($fields)
    {
        $this->validateOnly($fields,[
            'name'=>'required',
            'slug'=>'required|unique:categories'
        ]);
    }

    public function storeCategory()
    {
        $this->validate([
            'name'=>'required',
            'slug'=>'required|unique:categories',
        ]);

        if($this->category_id)
        {
            $sub_cat=new Subcategory;
            $sub_cat->name=$this->name;
            $sub_cat->slug=$this->slug;
            $sub_cat->category_id=$this->category_id;
            $sub_cat->save();
        }
        else 
        {
            $category=new Category();
            $category->name=$this->name;
            $category->slug=$this->slug;
            $category->save();
        }
        

        
        session()->put('message','Category has been created Successfully');
        return redirect()->to('admin/categories');
    }


    public function render()
    {
        $categories=Category::all();
        return view('livewire.admin-add-category',['categories'=>$categories])->layout('layouts.base');
    }
}