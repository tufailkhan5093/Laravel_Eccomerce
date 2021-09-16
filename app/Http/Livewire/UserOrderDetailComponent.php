<?php

namespace App\Http\Livewire;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;
use App\Models\Order;
use Livewire\Component;

class UserOrderDetailComponent extends Component
{
    use WithPagination;
    public $order_id;

    public function mount($order_id)
    {
        $this->order_id=$order_id;
    }
    public function render()
    {
        $order=Order::where('user_id',Auth::user()->id)->where('id',$this->order_id)->first();
        return view('livewire.user-order-detail-component',['order'=>$order])->layout('layouts.base');
    }
}
