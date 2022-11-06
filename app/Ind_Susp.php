<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ind_Susp extends Model
{
    //
    public $timestamps = false;
    protected $table = 'ind_susp';
    protected $fillable = [
        'name', 'father','address','district','age', 'drone_id'
    ];
}
