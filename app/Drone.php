<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Drone extends Model
{
    //
    //public $timestamps = false;
    protected $fillable = [
        'id', 'drone_type', 'location', 'district', 'ps', 'lat', 'long', 'time_seen', 'fly_dur', 'pen_dist', 'action','fir_no','fir_date','under_sec','fir_act','fir_ps','cons_dropped','recovery','forensics'
    ];
}
