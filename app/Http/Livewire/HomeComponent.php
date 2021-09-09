<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Products;
use App\Models\Category;
use App\Models\HomeSlider;
use App\Models\HomeCategory;
use App\Models\Sale;
class HomeComponent extends Component
{
    public function render()
    {
        $slides=HomeSlider::where('status',1)->get();
        $products=Products::orderBy('created_at','DESC')->get()->take(8);
        $category=HomeCategory::find(1);
        $cat=explode(',',$category->sel_categories);
        $categories=Category::whereIn('id',$cat)->get();
        $no_of_products=$category->no_of_products;
        $s_products=Products::where('sale_price','>',0)->inRandomOrder()->get()->take(8);
        $sale=Sale::find(1);
        return view('livewire.home-component',['sale'=>$sale,'s_products'=>$s_products,'categories'=>$categories,'no_of_products'=>$no_of_products,'slides'=>$slides,'products'=>$products])->layout('layouts.base');
    }
}
