<?php

namespace Modules\ShopFlow\Database\Seeders;

use Illuminate\Database\Seeder;

class ShopFlowDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $this->call(OrderProgressSeeder::class);
    }
}
