<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EntryLog extends Model
{
    protected $fillable = [ 
        'vhf_entry_id', 
        'status_id', 
        'remarks'
    ];
}
