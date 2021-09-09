<?php

namespace App\Http\Livewire;
use App\Models\Category;
use Livewire\Component;
use Illuminate\Support\Str;
class AdminAddCategory extends Component
{
    public $name;
    public $slug;

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

        $category=new Category();
        $category->name=$this->name;
        $category->slug=$this->slug;
        $category->save();
        session()->put('message','Category has been created Successfully');
        return redirect()->to('admin/categories');
    }


    public function render()
    {
        return view('livewire.admin-add-category')->layout('layouts.base');
    }
}
