<?php

namespace App\Http\Livewire\Admin;
use App\Models\Order;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class AdminOrderDetailComponent extends Component
{
    public $order_id;

    public function mount($order_id)
    {
        $this->order_id=$order_id;
    }

    public function cancelOrder()
    {
        $order=Order::find($this->order_id);
        $order->status='cancelled';
        $order->canceled_date=DB::raw('CURRENT_DATE');
        $order->save();
        session()->flash('order_message','Order has been canceled');


    }

    public function render()
    {
        $order=Order::find($this->order_id);
        return view('livewire.admin.admin-order-detail-component',['order'=>$order])->layout('layouts.base');
    }
}
