<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Indian_BOPS extends Model
{
    //
    public $timestamps = false;
    protected $table = 'indian_bops';
    protected $fillable = [
        'id', 'bop', 'drone_id'
    ];
}
