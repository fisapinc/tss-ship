<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('roles')->insert([
            ['id' => 1, 'name' => 'Authority', 'email' => 'authority@example.com', 'contact_info' => '01234568786', 'user_type' => 1, 'email_verified_at' => '', 'password' => ''],
           // ['id' => 1, 'name' => 'Ship-operator 1', 'email' => 'ship-operator@example.com', 'contact_info' => '0123456789', 'user_type' => '', 'is_active' => '', 'email_verified_at' => '', 'password' => ''],
        ]);

    }
}
