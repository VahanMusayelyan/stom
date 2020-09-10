<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatisticAdmin extends Model
{
    protected $table = "statistic_admins";
    protected $fillable = ['id',
        'organization_id',
        'employee_id',
        'specializ_id',
        'first_patient',
        'recorded_patient',
        'final_patient',
        'date',
        'created_at',
        'updated_at'
        ]; 
}
