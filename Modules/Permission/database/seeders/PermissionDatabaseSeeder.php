<?php

namespace Modules\Permission\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Permission\Models\Permission;
use Modules\Permission\Models\Roles;

class PermissionDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Roles::create(['title'=>'admin']);
        // $user = Roles::create(['title'=>'user']);

        //user permisson
        $user_create =  Permission::create([
            'title'=>'create_user',
            'label' => 'ایجاد کاربر',
        ]);
        
        /////////////////////
        $admin->givePermissionTo(
            $user_create
        );
    }
}
