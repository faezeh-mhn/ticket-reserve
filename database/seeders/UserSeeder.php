<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            ['name' => 'jack', 'lastname' => 'Holmes', 'email' => 'jack@gmail.com', 'user_type' => 'admin',
                'password' => Hash::make('12345'), 'status' => 'active', 'category' => 'admin'
            ],

            ['name' => 'john', 'lastname' => 'Holmes', 'email' => 'john@gmail.com', 'user_type' => 'super_user',
                'password' => Hash::make('12345'), 'status' => 'active', 'category' => 'super_user'
            ]
        ];
        foreach ($users as $user) {
            User::create($user);
        }
    }
}
