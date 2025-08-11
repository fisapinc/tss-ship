<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {

        User::create([
        'name' => 'Authority',
        'email' => 'authority@example.com',
        'password' => Hash::make('password'), 
        'contact_info' => '01112345678',
        'user_type' => 1,
        ]);
    }
}
