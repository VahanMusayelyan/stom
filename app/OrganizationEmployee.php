<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrganizationEmployee extends Model
{
       protected $table = 'organizations_employees';
    protected $fillable = ['id',
        'employee_id',
        'organization_id',
        'created_at',
        'updated_at'
    ];
    
   
}
