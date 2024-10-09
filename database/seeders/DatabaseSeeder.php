<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Categories;
use App\Models\Order;
use App\Models\Products;
use App\Models\Roles;
use App\Models\User;
use Database\Factories\AddressFactory;
use Database\Factories\CategoriesFactory;
use Database\Factories\ProductsFactory;
use Database\Factories\RolesFactory;
use Database\Factories\UserFactory;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = User::factory()->count(5)->create();  

        // ایجاد ۸ آدرس برای هر کاربر  
        $addresses = Address::factory()->count(5)->create();  
    
        // ایجاد ۸ دسته‌بندی  
        // $categories = Categories::factory()->count(5)->create();  
    
        // ایجاد ۸ محصول و نسبت دادن هر محصول به یک دسته‌بندی تصادفی  
        // $products = Products::factory()->count(5)->create();  
    
        // ایجاد ۸ نقش  
        $roles = Roles::factory()->count(5)->create();  
    
        // ایجاد ۸ سفارش و نسبت دادن هر سفارش به یک کاربر تصادفی  
        // $orders = Order::factory()->count(5)->create();
    }  
}