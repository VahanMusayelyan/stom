<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Employee;

class Organization extends Model
{   
        protected $table = "organizations";
    protected $fillable = ['id',
        'org_name',
        'user_id',
        'ownership_type_id',
        'country_id',
        'region_id',
        'city_id',
        'org_class_id',
        'org_active',
        'profile_data',
        'organization_data1',
        'organization_data2',
        'organization_data3',
        'organization_data4',
        'organization_data5',
        'organization_data6',
        'organization_data7',
        'organization_data8',
        'organization_data9',
        'organization_data10',
        'created_at',
        'updated_at'
    ];
    
    public function employees()
    {
        return $this->belongsToMany('App\Employees');
    }
}