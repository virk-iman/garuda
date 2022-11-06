<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pak_BOPS extends Model
{
    //
    public $timestamps = false;
    protected $table = 'pak_bops';
    protected $fillable = [
        'id', 'bop', 'drone_id'
    ];
}
