<?php

namespace Database\Factories;

use App\Models\Categories;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Categories>
 */
class CategoriesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [  
            'parent_id' => function () {  
                // حداکثر تعداد والدین را محدود کنید  
                $maxParents = 10; // تعداد والدین را به تناسب نیازتان تنظیم کنید  

                // تنها والدین موجود را دریافت کنید  
                $parents = Categories::limit($maxParents)->get();  

                if ($parents->isEmpty()) {  
                    // اگر والد وجود ندارد، یک والد جدید ایجاد کن  
                    $parent = Categories::factory()->create();  
                } else {  
                    // انتخاب تصادفی از والدین  
                    $parent = $parents->random();  
                }  

                return $parent->id; // برگرداندن id والد  
            },  
            'title' => function() {  
                return $this->faker->unique()->word;  
            },  
            'slug' => function() {  
                return $this->faker->unique()->slug;  
            },  
            'type' => $this->faker->randomElement(['type1', 'type2', 'type3']),  
        ];
    }

}
