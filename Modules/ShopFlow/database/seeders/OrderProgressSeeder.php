<?php

namespace Modules\ShopFlow\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\ShopFlow\Models\OrderProgress;

class OrderProgressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        OrderProgress::query()->insert([
            [
                'progress' => 'درحال پرداخت'
            ],
            [
                'progress' => 'درحال اماده سازی'
            ],
            [
                'progress' => 'در حال ارسال به پیک مربوطه'
            ],
            [
                'progress' => 'پیک محصولات را دریافت کرده '
            ],
            [
                'progress' => 'پیک در راه ارسال محصولات '
            ],
            [
                'progress' => 'به دست مشتری رسیده'
            ],
            [
                'progress' => 'سفارش با خطا مواجه شد'
            ],
        ]);
    }

}
