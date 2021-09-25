<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
class Products extends Model
{
    use HasFactory;
    protected $table='products';

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }

    public function orderItems()
    {
        return $this->hasMany(Orderitem::class,'product_id');
    }

    public function subCategories()
    {
        return $this->belongsTo(Subcategory::class,'subcategory_id');
    }

   
}