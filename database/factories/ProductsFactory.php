<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Products>
 */
class ProductsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
 {
  return [
    'category_id' => \App\Models\Categories::factory()->create(), // فرض بر این است که مدل و فکتوری Category وجود دارد  
    'title' => $this->faker->unique()->word,  
    'slug' => $this->faker->unique()->slug,  
    'price' => $this->faker->randomFloat(2, 10, 100), // قیمت تصادفی با دو رقم اعشار  
    'description' => $this->faker->paragraph,  
    'quantity' => $this->faker->numberBetween(1, 100),  
    'pic' => $this->faker->imageUrl(), // تولید یک URL تصادفی برای تصویر  
]; 
 }
}
