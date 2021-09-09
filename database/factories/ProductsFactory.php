<?php

namespace Database\Factories;

use App\Models\Products;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
class ProductsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Products::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name=$this->faker->unique()->words($nb=2,$asText=true);
        $slug=Str::slug($name);
        return [
            'name'=>$name,
            'slug'=>$slug,
            'short_description'=>$this->faker->text(50),
            'description'=>$this->faker->text(500),
            'price'=>$this->faker->numberBetween(100,2000),
            'sale_price'=>$this->faker->numberBetween(100,2000),
            'SKU'=>'DIGI'.$this->faker->numberBetween(100,2000),
            'stock_status'=>'instock',
            'quantity'=>$this->faker->numberBetween(10,100),
            'image'=>'digital_'.$this->faker->unique()->numberBetween(1,22).'.jpg',
            'category_id'=>$this->faker->numberBetween(1,5),


        ];
    }
}
