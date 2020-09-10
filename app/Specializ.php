<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Specializ extends Model
{
     protected $table = "specializ_types";
    protected $fillable = ['id',
        'specialization'
        ]; 
}
