<?php

namespace App\Http\Livewire;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;
use App\Models\Order;
use Livewire\Component;

class UserOrderComponent extends Component
{
    use WithPagination;
    public function render()

    {
        $orders=Order::where('user_id',Auth::user()->id)->paginate(10);
        return view('livewire.user-order-component',['orders'=>$orders])->layout('layouts.base');
    }
}
