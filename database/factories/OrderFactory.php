<?php

namespace Database\Factories;

use App\Models\Address;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Cart; // مطمئن شوید که این مدل را وارد کرده‌اید  
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [  
            'unique_code' => $this->faker->unique()->word, // ایجاد یک کد منحصر به فرد  
            'address_id' => Address::factory()->create(), // ایجاد یک آدرس جدید  
            'gate' => $this->faker->word, // ایجاد یک مقدار تصادفی برای gate  
            'price_total' => $this->faker->numberBetween(1000, 100000), // قیمت تصادفی بین 1000 تا 100000  
            'transaction_id' => $this->faker->optional()->word, // ایجاد یک شناسه تراکنش اختیاری  
            'status' => $this->faker->randomElement(['pending', 'completed', 'canceled']), // وضعیت تصادفی  
        ]; 
    }
}
