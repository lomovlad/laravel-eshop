<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'price' => $this->faker->numberBetween(100, 1000),
            'old_price' => $this->faker->numberBetween(100, 1200),
            'excerpt' => $this->faker->text(100),
            'content' => $this->faker->text(300),
            'image' => null,
            'gallery' => [],
            'is_hit' => 1,
            'is_new' => 0,
            'category_id' => Category::factory(),
        ];
    }
}
