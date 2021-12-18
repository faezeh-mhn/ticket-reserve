<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles =
            [
                ['id' => 1, 'role_name' => 'normal_user','permission'=>1],
                ['id' => 2, 'role_name' => 'admin','permission'=>1],
                ['id' => 3, 'role_name' => 'super_user','permission'=>1],
                ['id' => 4, 'role_name' => 'company','permission'=>1],
            ];


        foreach ($roles as $role) {
            Role::create($role);        }
    }
}
