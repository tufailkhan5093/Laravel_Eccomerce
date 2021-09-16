<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Setting;
class FooterComponent extends Component
{
    public function render()
    {
        $setting=Setting::all();
        return view('livewire.footer-component',['settings'=>$setting])->layout('layouts.base');
    }
}
