<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Transaction;
use App\Models\Shipping;
use App\Models\Orderitem;
class Order extends Model
{
    use HasFactory;
    protected $table='orders';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderItems()
    {
        return $this->hasMany(Orderitem::class);
    }

    public function shipping()
    {
        return $this->hasOne(Shipping::class);
    }

    public function transaction()
    {
        return $this->hasOne(Transaction::class);
    }
}
