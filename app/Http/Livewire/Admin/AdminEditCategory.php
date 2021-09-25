<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Subcategory;
class AdminEditCategory extends Component
{
    public $category_slug;
    public $category_id;
    public $name;
    public $slug;
    public $scategory_id;
    public $scategory_slug;

    public function mount($category_slug,$scategory_slug=null)
    {
        if($scategory_slug)
        {
            $this->scategory_slug=$scategory_slug;
            $scategory=Subcategory::where('slug',$scategory_slug)->first();
            $this->scategory_id=$scategory->id;
            $this->category_id=$scategory->category_id;
            $this->name=$scategory->name;
            $this->slug=$scategory->slug;
        }
        else 
        {
            $this->category_slug=$category_slug;
            $category=Category::where('slug',$category_slug)->first();
            $this->category_id=$category->id;
            $this->name=$category->name;
            $this->slug=$category->slug;
        }
        
        
    }

    public function generateSlug()
    {
        $this->slug=Str::slug($this->name);
    }

    public function updateCategory()
    {

        if($this->scategory_id)
        {
            $sscategory=Subcategory::find($this->scategory_id);
            $sscategory->name=$this->name;
            $sscategory->slug=$this->slug;
            $sscategory->category_id=$this->category_id;
            $sscategory->save();
            session()->flash('message','Sub Category Updated Successfully');
            
            
        }
        else 
        {
            $category=Category::find($this->category_id);
            $category->name=$this->name;
            $category->slug=$this->slug;
            $category->save();
            session()->flash('message','Category Updated Successfully');
        }
        
        
    }



    public function render()
    {
        $categories=Category::all();
        return view('livewire.admin.admin-edit-category',['categories'=>$categories])->layout('layouts.base');
    }
}