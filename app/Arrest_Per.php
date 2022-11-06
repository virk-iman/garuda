<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Arrest_Per extends Model
{
    public $timestamps = false;
    protected $table = 'arrested_per';
    protected $fillable = [
        'name', 'father','address','district','age', 'drone_id'
    ];
}
