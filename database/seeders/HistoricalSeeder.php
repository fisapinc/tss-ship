<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HistoricalSeeder extends Seeder
{
    
    public function run(): void
    {
         DB::table('historicals')->insert([
            ['id' => 1, 'mmsi_number' => '229136000', 'vessel_name' => 'CARNIVAL SPIRIT', 'vessel_type'=> 'PASSENGER', 'call_sign' => '9HA3097', 'imo_number' => '9134567' , 'imo_classes' => '', 'draught' => '12345678', 'air_draught' => '39823421', 'total_person_onboard' => '200', 'flag' => 'MY', 'date_arrival' => '22/11/2024', 'time_arrival' => '23:11:12', 'entry_sector' => '1', 'direction' => '1', 'position' => '', 'port_desination' => '', 'speed' => '', 'course' => '', 'hazardous_cargo' => 'N', 'quantity' => '1', 'description' => 'LOREM IPSUM', 'comments' => 'LOREM IPSUM', 'rule_10' => 'LOREM IPSUM', 'vessel_email' => 'LOREM IPSUM', 'internal_remark' => 'LOREM IPSUM'],
            ['id' => 2, 'mmsi_number' => '19246858', 'vessel_name' => 'MAGENTA FIGHT', 'vessel_type'=> 'PASSENGER', 'call_sign' => '9HA3089', 'imo_number' => '248685' , 'imo_classes' => '', 'draught' => '2845489', 'air_draught' => '578585', 'total_person_onboard' => '900', 'flag' => 'MY', 'date_arrival' => '22/11/2024', 'time_arrival' => '23:11:12', 'entry_sector' => '1', 'direction' => '1', 'position' => '', 'port_desination' => '', 'speed' => '', 'course' => '','hazardous_cargo' => 'N', 'quantity' => '1', 'description' => 'LOREM IPSUM', 'comments' => 'LOREM IPSUM', 'rule_10' => 'LOREM IPSUM', 'vessel_email' => 'LOREM IPSUM', 'internal_remark' => 'LOREM IPSUM' ],
            ['id' => 3, 'mmsi_number' => '5868484', 'vessel_name' => 'A1 CAUGHT', 'vessel_type'=> 'PASSENGER', 'call_sign' => '9HA3078', 'imo_number' => '686848' , 'imo_classes' => '', 'draught' => '2838458', 'air_draught' => '044849', 'total_person_onboard' => '100', 'flag' => 'MY', 'date_arrival' => '22/11/2024', 'time_arrival' => '23:11:12', 'entry_sector' => '1', 'direction' => '1', 'position' => '', 'port_desination' => '', 'speed' => '', 'course' => '','hazardous_cargo' => 'N', 'quantity' => '1', 'description' => 'LOREM IPSUM', 'comments' => 'LOREM IPSUM', 'rule_10' => 'LOREM IPSUM', 'vessel_email' => 'LOREM IPSUM', 'internal_remark' => 'LOREM IPSUM' ],
        ]);
        
    }
}
