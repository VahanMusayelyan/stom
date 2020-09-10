<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatisticDoctor extends Model
{
    protected $table = "statistic_doctors";
    protected $fillable = ['id',
        'organization_id',
        'employee_id',
        'specializ_id',
        'first_consulting',
        'first_therapy',
        'total_therapy',
        'schedule_time',
        'spent_time',
        'turnover',
        'clients'
        ]; 
}
