<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReportingMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('reporting_methods')->insert([
            ['id' => 1, 'name' => 'Automatic Identification System', 'code' => 'AIS', 'description' => ''],
            ['id' => 2, 'name' => 'VHF Radio', 'code' => 'VHF Radio', 'description' => ''],
            ['id' => 3, 'name' => 'Email', 'code' => 'Email', 'description' => ''],
            ['id' => 4, 'name' => 'Web Portal', 'code' => 'Web Portal', 'description' => '']
        ]);
    }
}
