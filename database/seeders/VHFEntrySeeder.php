<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VHFEntrySeeder extends Seeder
{
    private $vesselTypes = ['PASSENGER', 'CARGO', 'TANKER', 'FISHING', 'SAILING', 'HSC', 'TUG', 'OTHER'];
    private $flags = ['MY', 'SG', 'ID', 'TH', 'VN', 'PH', 'US', 'GB', 'JP', 'KR'];
    private $entrySectors = ['1', '2', '3', '4'];
    private $directions = ['1', '2', '3', '4'];
    private $hazardousOptions = ['Y', 'N'];
    
    public function run(): void
    {
        $records = [];
        
        for ($i = 1; $i <= 100; $i++) {
            $vesselType = $this->vesselTypes[array_rand($this->vesselTypes)];
            $flag = $this->flags[array_rand($this->flags)];
            $entrySector = $this->entrySectors[array_rand($this->entrySectors)];
            $direction = $this->directions[array_rand($this->directions)];
            $hazardous = $this->hazardousOptions[array_rand($this->hazardousOptions)];
            
            $records[] = [
                'id' => $i,
                'mmsi_number' => rand(100000000, 999999999),
                'vessel_name' => $this->generateVesselName(),
                'vessel_type' => $vesselType,
                'call_sign' => $this->generateCallSign(),
                'imo_number' => rand(100000, 9999999),
                'imo_classes' => '',
                'draught' => rand(1000000, 99999999),
                'air_draught' => rand(100000, 99999999),
                'total_person_onboard' => rand(10, 3000),
                'flag' => $flag,
                'date_arrival' => $this->generateRandomDate(),
                'time_arrival' => $this->generateRandomTime(),
                'entry_sector' => $entrySector,
                'direction' => $direction,
                'position' => '',
                'port_destination' => '',
                'speed' => rand(5, 30),
                'course' => rand(0, 359),
                'hazardous_cargo' => $hazardous,
                'quantity' => $hazardous === 'Y' ? rand(1, 100) : 0,
                'description' => 'LOREM IPSUM',
                'comments' => 'LOREM IPSUM',
                'rule_10' => 'LOREM IPSUM',
                'vessel_email' => 'vessel'.$i.'@example.com',
                'internal_remark' => 'LOREM IPSUM'
            ];
        }
        
        DB::table('historical')->insert($records);
    }
    
    private function generateVesselName(): string
    {
        $prefixes = ['CARNIVAL', 'ROYAL', 'MAGENTA', 'OCEAN', 'SEA', 'GOLDEN', 'SILVER', 'PACIFIC', 'ATLANTIC', 'ARCTIC'];
        $suffixes = ['SPIRIT', 'PRINCESS', 'EXPLORER', 'VOYAGER', 'HORIZON', 'SUNRISE', 'STAR', 'MOON', 'WAVE', 'JOURNEY'];
        return $prefixes[array_rand($prefixes)] . ' ' . $suffixes[array_rand($suffixes)];
    }
    
    private function generateCallSign(): string
    {
        $letters = range('A', 'Z');
        $numbers = range(0, 9);
        return $letters[array_rand($letters)] . $letters[array_rand($letters)] . 
               $numbers[array_rand($numbers)] . $numbers[array_rand($numbers)] . 
               $letters[array_rand($letters)] . $letters[array_rand($letters)];
    }
    
    private function generateRandomDate(): string
    {
        $start = strtotime('2023-01-01');
        $end = strtotime('2024-12-31');
        $timestamp = mt_rand($start, $end);
        return date('d/m/Y', $timestamp);
    }
    
    private function generateRandomTime(): string
    {
        return sprintf('%02d:%02d:%02d', rand(0, 23), rand(0, 59), rand(0, 59));
    }
}

