<?php

namespace App\Http\Livewire\Admin;
use App\Models\HomeSlider;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Carbon;

class AdminAddHomeSliderComponent extends Component
{
    use WithFileUploads;
    public $title;
    public $subtitle;
    public $image;
    public $link;
    public $status;
    public $price;


    public function mount()
    {
        $this->status=0;
    }

    public function addSlider()
    {
        $slider=new HomeSlider;
        $slider->title=$this->title;
        $slider->subtitle=$this->subtitle;
        $slider->link=$this->link;
        $slider->price=$this->price;
        $slider->status=$this->status;
        $slider->title=$this->title;

        $imageName=Carbon::now()->timestamp.'.'.$this->image->extension();
        $this->image->storeAs('sliders',$imageName);
        $slider->image=$imageName;
        $slider->save();

        session()->flash('message','Slide has been created successfully!');
        return redirect()->to('admin/homeslider/');

    }
    public function render()
    {
        return view('livewire.admin.admin-add-home-slider-component')->layout('layouts.base');;
    }
}
