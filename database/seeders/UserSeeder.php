<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert(
            [
                [
                    'name' => 'Administrator',
                    'email' => 'admin@gmail.com',
                    'password' => Hash::make('admin1234'),
                    'role' => 'admin'
                ],
                [
                    'name' => 'Kasirku',
                    'email' => 'user@gmail.com',
                    'password' => Hash::make('kasir1234'),
                    'role' => 'kasir'
                ]
            ]
        );
    }
}
