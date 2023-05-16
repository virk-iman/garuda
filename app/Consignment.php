<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consignment extends Model
{
    //
    public $timestamps = false;
    protected $table = 'consignments';
    protected $fillable = [
        'type','item','qty','drone_id'
    ];
}
