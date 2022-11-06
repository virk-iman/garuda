<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pak_Vill extends Model
{
    //
    public $timestamps = false;
    protected $table = 'pak_vill';
    protected $fillable = [
        'vill', 'dist', 'drone_id'
    ];
}
