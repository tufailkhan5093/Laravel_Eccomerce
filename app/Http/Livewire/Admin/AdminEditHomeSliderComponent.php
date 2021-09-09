<?php

namespace App\Http\Livewire\Admin;
use Livewire\WithFileUploads;
use Illuminate\Support\Carbon;
use App\Models\HomeSlider;
use Livewire\Component;

class AdminEditHomeSliderComponent extends Component
{
    use WithFileUploads;
    public $title;
    public $subtitle;
    public $image;
    public $link;
    public $status;
    public $price;
    public $new_image;
    public $slide_id;

    public function mount($slide_id)
    {
        $slider=HomeSlider::find($slide_id);
        $this->title=$slider->title;
        $this->subtitle=$slider->subtitle;
        $this->price=$slider->price;
        $this->link=$slider->link;
        $this->status=$slider->status;
        $this->image=$slider->image;
       
    }

    public function EditSlider()
    {
        $slider=HomeSlider::find($this->slide_id);
        $slider->title=$this->title;
        $slider->subtitle=$this->subtitle;
        $slider->link=$this->link;
        $slider->status=$this->status;
        if($this->new_image)
        {
            $imageName=Carbon::now()->timestamp.'.'.$this->new_image->extension();
            $this->new_image->storeAs('sliders',$imageName);
            $slider->image=$imageName;
        }

        $slider->save();
        session()->flash('message','Slder Updated successfully!');
        return redirect()->to('admin/homeslider/');
    }


    public function render()
    {
        return view('livewire.admin.admin-edit-home-slider-component')->layout('layouts.base');;
    }
}
