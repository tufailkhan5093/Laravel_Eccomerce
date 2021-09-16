<?php

namespace App\Http\Livewire\Admin;
use App\Models\Setting;
use Livewire\Component;

class AdminSettingComponent extends Component
{
    public $email;
    public $phone;
    public $phone2;
    public $address;
    public $map;
    public $facebook;
    public $instagram;
    public $youtube;
    public $twitter;
    public $pinterest;

    public function mount()
    {
        $setting=Setting::find(1);
        if($setting)
        {
            $this->email=$setting->email;
            $this->phone=$setting->phone;
            $this->phone2=$setting->phone2;
            $this->address=$setting->address;
            $this->map=$setting->map;
            $this->facebook=$setting->facebook;
            $this->instagram=$setting->instagram;
            $this->youtube=$setting->youtube;
            $this->twitter=$setting->twitter;
            $this->pinterest=$setting->pinterest;

        }
    }

    public function updated($fields)
    {
        $this->validateOnly($fields,[

            'email'=>'required|email',
            'phone'=>'required',
            'phone2'=>'required',
            'map'=>'required',
            'twitter'=>'required',
            'instagram'=>'required',
            'facebook'=>'required',
            'youtube'=>'required',
            'pinterest'=>'required',
            'address'=>'required',

        ]);
    }

    public function saveSetting()
    {
        $this->validate([

            'email'=>'required|email',
            'phone'=>'required',
            'phone2'=>'required',
            'map'=>'required',
            'twitter'=>'required',
            'instagram'=>'required',
            'facebook'=>'required',
            'youtube'=>'required',
            'pinterest'=>'required',
            'address'=>'required',

        ]);

        $setting=Setting::find(1);
        if(!$setting)
        {
            $setting=new Setting();
            $setting->email=$this->email;
                
            $setting->phone=$this->phone;    
            $setting->phone2=$this->phone2;   
            $setting->address=$this->address;  
            $setting->map=$this->map;     
            $setting->facebook=$this->facebook;
            $setting->instagram=$this->instagram;
            $setting->youtube=$this->youtube; 
            $setting->twitter=$this->twitter;  
            $setting->pinterest=$this->pinterest;
            $setting->save();
            session()->flash('message','Setting has been saved successfully!');


        }
    }

    public function render()
    {
        return view('livewire.admin.admin-setting-component')->layout('layouts.base');
    }
}
