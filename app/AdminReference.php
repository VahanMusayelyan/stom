<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminReference extends Model {

    protected $table = "admin_reference";
    protected $fillable = ['id',
        'city_id',
        'class_id',
        'specializ_id',
        'conversion1_normal',
        'conversion1_good',
        'conversion2_normal',
        'conversion2_good',
        'conversion3_normal',
        'conversion3_good',
        'created_at',
        'updated_at'
    ];

}
