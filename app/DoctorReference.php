<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DoctorReference extends Model
{
     protected $table = "doctor_reference";
    protected $fillable = ['id',
        'city_id',
        'class_id',
        'specializ_id',
        'conversion_normal',
        'conversion_good',
        'repetition_rate_normal',
        'repetition_rate_good',
        'turnover_normal',
        'turnover_good',
        'workload_normal',
        'workload_good',
        'avarage_hour_normal',
        'avarage_hour_good',
        'avarage_visit_normal',
        'avarage_visit_good'
        ]; 
}
