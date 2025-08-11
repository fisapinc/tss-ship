<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EntryLog extends Model
{
    protected $fillable = [ 
        //'emission_entry_id', 
        'status_id', 
        'remarks'
    ];
}
