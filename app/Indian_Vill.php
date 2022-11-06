<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Indian_Vill extends Model
{
    // $table->increments('id');
    public $timestamps = false;
    protected $table = 'indian_vill';
    protected $fillable = [
        'vill', 'dist', 'drone_id'
    ];
}
