<?php

namespace App\Http\Livewire\User;
use App\Models\Orderitem;
use App\Models\Review;
use Livewire\Component;

class UserReviewComponent extends Component
{
    public $order_item_id;
    public $rating;
    public $comment;


    // public function updated($fields)
    // {
    //     $this->validateOnly([
    //         'rating'=>'required',
    //         'comment'=>'required',
    //     ]);
        
    // }
    public function addReview()
    {
        
        $review=new Review();
        $review->rating=$this->rating;
        $review->comment=$this->comment;
        $review->order_item_id=$this->order_item_id;
        $review->save();
        $order_item=Orderitem::find($this->order_item_id);
        $order_item->rstatus=true;
        $order_item->save();
        
        session()->flash('message','Review has been added successfully');

    }

    public function mount($order_item_id)
    {
        $this->order_item_id=$order_item_id;
    }

    public function render()
    {
        $orderitem=Orderitem::find($this->order_item_id);
        return view('livewire.user.user-review-component',['orderitem'=>$orderitem])->layout('layouts.base');
    }
}
