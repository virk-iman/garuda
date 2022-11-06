<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Drone extends Model
{
    //
    //public $timestamps = false;
    protected $fillable = [
        'id', 'drone_type', 'location', 'district', 'ps', 'lat', 'long', 'time_seen', 'fly_dur', 'pen_dist', 'action','cons_dropped','recovery','forensics'
    ];
}
