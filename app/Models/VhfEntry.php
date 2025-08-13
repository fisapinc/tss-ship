<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VhfEntry extends Model
{
    protected $table = 'vhf_entries';

    protected $fillable = [
        'vessel_name',
        'mmsi_number',
        'call_sign',
        'imo_number',
        'draught',
        'air_draught',
        'total_person_onboard',
        'flag',
        'date_arrival',
        'time_arrival',
        'entry_sector',
        'direction',
        'position',
        'port_destination',
        'speed',
        'course',
        'vessel_type',
        'imo_classes',
        'hazardous_cargo',
        'quantity',
        'description',
        'comments',
        'rule_10',
        'vessel_email',
        'internal_remark',
        'attachment'
    ];
}
