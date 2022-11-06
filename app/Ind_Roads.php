<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ind_Roads extends Model
{
    //
    public $timestamps = false;
    protected $table = 'ind_roads';
    protected $fillable = [
        'road','drone_id'
    ];
}
