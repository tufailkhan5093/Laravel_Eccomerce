<?php

namespace App\Http\Livewire\Admin;
use App\Models\HomeSlider;
use Livewire\Component;

class AdminHomeSliderComponent extends Component
{

    public function deleteSlider($id)
    {
        $category=HomeSlider::find($id);
        $category->delete();
        session()->flash('message','Slider has been deleted Successfully');
    }

    public function render()
    {
        $slides=HomeSlider::all();
        return view('livewire.admin.admin-home-slider-component',['slides'=>$slides])->layout('layouts.base');
    }
}
