<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Organization;

class AdminController extends AppController
{
    public function index(){
               
        return view('admin');
        

    }
    
    public function users(){
               
        $result = User::where('role_id',2)->orderBy('id','desc')->paginate(10);
        
        
         return view('users.list', ['result' => $result]);
        

    }
    
    public function showuser($id) {   
        
        $result = Organization::select("*","organizations.id")->where('organizations.user_id', $id)
                ->leftjoin('organiz_types', 'organiz_types.id', 'organizations.ownership_type_id')
                ->leftjoin('org_classes', 'org_classes.id', '=', 'organizations.org_class_id')
                ->leftjoin('countries', 'countries.id', '=', 'organizations.country_id')
                ->leftjoin('regions', 'regions.id', '=', 'organizations.region_id')
                ->leftjoin('cities', 'cities.id', '=', 'organizations.city_id')
                ->get();
       
        return view('users.organization_list', ['result' => $result]);
  
    }
    
}
