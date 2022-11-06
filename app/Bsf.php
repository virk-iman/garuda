<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bsf extends Model
{
    //
    public $timestamps = false;
    protected $table = 'bsf';
    protected $fillable = [
        'id', 'bsf_post', 'drone_id'
    ];
}
