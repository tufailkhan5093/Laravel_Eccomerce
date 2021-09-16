<?php

namespace App\Http\Livewire;
use App\Models\Order;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class AdminOrderComponent extends Component
{
   

   

    public function updateOrderStatus($order_id,$status)
    {
        
        $order=Order::find($order_id);
        $order->status=$status;

        if($status=='delivered')
        {
            $order->delievered_date=DB::raw('CURRENT_DATE');
        }
        else if($status=='cancelled')
        {
            $order->canceled_date=DB::raw('CURRENT_DATE');
        }
        $order->save();
        session()->flash('order_message','Order status has been updated');
        
    }
 

  
    public function render()
    {
        $orders=Order::orderBy('created_at','DESC')->paginate(12);
        return view('livewire.admin-order-component',['orders'=>$orders])->layout('layouts.base');
    }
}
