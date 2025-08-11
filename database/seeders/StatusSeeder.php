<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('statuses')->insert([
            ['id' => 1, 'name' => 'Pending', 'slug' => ''],
            ['id' => 2, 'name' => 'Verified', 'slug' => ''],
            ['id' => 3, 'name'=> 'Unverified', 'slug' => '']
        ]);
    }
}
