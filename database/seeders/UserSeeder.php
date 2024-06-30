<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'username' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('password123'), // password123
                'level' => 'admin',
            ],
            [
                'name' => 'OP Rental',
                'username' => 'oprental',
                'email' => 'oprental@gmail.com',
                'password' => Hash::make('password123'), // password123
                'level' => 'user',
            ],
            [
                'name' => 'User Three',
                'username' => 'userthree',
                'email' => 'userthree@example.com',
                'password' => Hash::make('password123'), // password123
                'level' => 'user',
            ],
            [
                'name' => 'User Four',
                'username' => 'userfour',
                'email' => 'userfour@example.com',
                'password' => Hash::make('password123'), // password123
                'level' => 'admin',
            ],
            [
                'name' => 'User Five',
                'username' => 'userfive',
                'email' => 'userfive@example.com',
                'password' => Hash::make('password123'), // password123
                'level' => 'admin',
            ],
        ]);
    }
}
