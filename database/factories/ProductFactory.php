<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->text(15),
            'price' => $this->faker->randomFloat(2,  1000, 1000000),
            'qty' => $this->faker->numberBetween($min = 1, $max = 20),
            'description' => $this->faker->paragraph,
            'category_id' => $this->faker->randomElement(Category::all()->pluck('id')),
        ];
    }
}
