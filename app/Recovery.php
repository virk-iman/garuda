<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recovery extends Model
{
    //
     public $timestamps = false;
    protected $table = 'recovery';
    protected $fillable = [
        'dor','rec_agency','type_drone','model','payload_cap','max_speed','flight_time'
    ];
}
