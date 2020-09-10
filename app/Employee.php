<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Organization;

class Employee extends Model
{
    protected $table = "employees";
    protected $fillable = ['id',
        'employee_name',
        'specializ_id',
        'user_id',
        'employee_active',
        'created_at',
        'updated_at'
    ];
    
      public function organizations()
    {
        return $this->belongsToMany('App\Organization', 'organizations_employees', 'employee_id', 'organization_id');
    }
}