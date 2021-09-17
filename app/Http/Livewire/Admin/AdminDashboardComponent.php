<?php

namespace App\Http\Livewire\Admin;
use App\Models\Order;
use Livewire\Component;
use Carbon\Carbon;

class AdminDashboardComponent extends Component
{
    public function render()
    
    {
        $order=Order::orderBy('created_at','DESC')->get()->take(10);
        $totalsales=Order::where('status','delivered')->count();
        $totalRevenue=Order::where('status','delivered')->sum('total');
        $todaySales=Order::where('status','delivered')->where('created_at',Carbon::today())->count();
        $todayRevenue=Order::where('status','delivered')->where('created_at',Carbon::today())->sum('total');
        
        return view('livewire.admin.admin-dashboard-component',[
            'orders'=>$order,
            'totalsales'=>$totalsales,
            'totalRevenue'=>$totalRevenue,
            'todaySales'=>$todaySales,
            'todayRevenue'=>$todayRevenue,
        ])->layout('layouts.base');
    }
}