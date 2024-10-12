<?php

namespace Database\Factories;
use App\Models\Address;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array  
    {  
        return [  
            'user_id' => User::factory(), // ایجاد یک کاربر تصادفی  
            'description' => $this->faker->address(), // ایجاد یک آدرس تصادفی  
        ];  
    }
}