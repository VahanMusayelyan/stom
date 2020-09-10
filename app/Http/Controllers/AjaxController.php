<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Organization;
use App\Employee;
use App\DoctorReference;
use App\AdminReference;
use App\OrganizationEmployee;
use Illuminate\Support\Facades\DB;

class AjaxController extends AppController {

    public function index(Request $request) {

        $id = $request->id;
        $value = $request->value;

        $result = DB::table('organizations')->where('id', $id)->update([
            'org_active' => $value
        ]);

        if ($result) {
            return 1;
        } else {
            return 0;
        }
    }

    public function user(Request $request) {

        $id = $request->id;
        $value = $request->value;

        $result = DB::table('users')->where('id', $id)->update([
            'user_active' => $value
        ]);

        if ($result) {
            return 1;
        } else {
            return 0;
        }
    }

//    public function admin(Request $request) {
//        $id = $request->id;
//        $org = $request->org;
//        $col = $request->col;
//        $val = $request->val;
//        $data_first = $request->first_data;
//        $array = ["1" => "Январь", "2" => "Февраль", "3" => "Март", "4" => "Апрель", "5" => "Май", "6" => "Июнь", "7" => "Июль", "8" => "Август", "9" => "Сентябрь", "10" => "Октябрь", "11" => "Ноябрь", "12" => "Декабрь"];
//
//        if (empty($data_first)) {
//            $data_first = date('Y-m-01');
//        } else {
//            $data_first = $request->first_data;
//            $month_year1 = explode(' ', $data_first);
//            $key1 = array_search($month_year1[0], $array);
//            $data_first = date('Y-m-d', strtotime($month_year1[1] . "-" . $key1 . "-1"));
//        }
//
//
//
//        if (empty($id) || empty($org) || intval($val) < 0) {
//            return 0;
//            return false;
//        }
//
//        $result = DB::table('statistic_admins')->where('employee_id', $id)->where('organization_id', $org)->where('date', "=", $data_first)->get()->toArray();
//
//        if (empty($result)) {
//
//            $final = DB::table('statistic_admins')->insert([
//                'organization_id' => $org,
//                'employee_id' => $id,
//                'specializ_id' => '1',
//                'date' => $data_first,
//                $col => $val
//            ]);
//        } else {
//            $final = DB::table('statistic_admins')->where('employee_id', $id)->where('organization_id', $org)->where('date', "=", $data_first)->update([
//                $col => $val
//            ]);
//        }
//
//        if (isset($final)) {
//
//            return 1;
//        } else {
//            return 0;
//        }
//    }

//    public function doctor(Request $request) {
//
//        $id = $request->id;
//        $org = $request->org;
//        $col = $request->col;
//        $val = $request->val;
//        $specializ_id = $request->specializ_id;
//        $data_first = $request->first_data;
//        $array = ["1" => "Январь", "2" => "Февраль", "3" => "Март", "4" => "Апрель", "5" => "Май", "6" => "Июнь", "7" => "Июль", "8" => "Август", "9" => "Сентябрь", "10" => "Октябрь", "11" => "Ноябрь", "12" => "Декабрь"];
//
//
//        if (empty($data_first)) {
//            $data_first = date('Y-m-01');
//        } else {
//            $data_first = $request->first_data;
//            $month_year1 = explode(' ', $data_first);
//            $key1 = array_search($month_year1[0], $array);
//            $data_first = date('Y-m-d', strtotime($month_year1[1] . "-" . $key1 . "-1"));
//        }
//
//
//        if (empty($id) || empty($org) || empty($specializ_id) || intval($val) < 0) {
//            return 0;
//            return false;
//        }
//
//        $result = DB::table('statistic_doctors')->where('employee_id', $id)->where('organization_id', $org)->where('date', "=", $data_first)->get()->toArray();
//
//        if (empty($result)) {
//            $final = DB::table('statistic_doctors')->insert([
//                'organization_id' => $org,
//                'employee_id' => $id,
//                'specializ_id' => $specializ_id,
//                'date' => $data_first,
//                $col => $val
//            ]);
//        } else {
//            $final = DB::table('statistic_doctors')->where('employee_id', $id)->where('organization_id', $org)->where('date', "=", $data_first)->update([
//                $col => $val
//            ]);
//        }
//
//        if (isset($final)) {
//
//            return 1;
//        } else {
//            return 0;
//        }
//    }

    public function refadmin(Request $request) {
		$data = new AdminReference;
        $id = $request->id;
        $val = $request->val;
        $col = $request->col;
        $city = $request->city;
        $class_name = $request->class_name;
        $specializ = $request->specializ;

        if (empty($id)) {
            $data->$col = $val;
			$data->city_id = $city;
			$data->class_id = $class_name;
			$data->specializ_id = $specializ;
			$data->save();
            $result = $data['id'];
        } else {
			$data = AdminReference::find($id);
			$data->$col = $val;
			$data->save();
            $result = $data['id'];
		
        }

        if (isset($result)) {
            return $result;
        } else {
            return 0;
        }
    }

    public function refdoctor(Request $request) {
        $id = $request->id;
        $val = $request->val;
        $col = $request->col;
        $city = $request->city;
        $class_name = $request->class_name;
        $specializ = $request->specializ;
        if (empty($id)) {

            DoctorReference::insert([$col => $val, 'city_id' => $city, 'class_id' => $class_name, 'specializ_id' => $specializ]);
            $result = DoctorReference::orderBy('id', 'desc')->first()->toArray();
        } else {
            $id = explode("_", $id);
            $id = $id['1'];
            $result = DoctorReference::where('id', $id)->update([$col => $val]);
            $result = DoctorReference::where('id', $id)->first()->toArray();
        }


        if (isset($result)) {
            return $result['id'];
        } else {
            return 0;
        }
    }

    /* Dropdown menu */

    public function show(Request $request) {
        $id = $request->user_id;
        $value = $request->value;
        $org_id = $request->org_id;
		

        if ($org_id == "") {

            if ($value == 0) {

                $result = Organization::select('id', 'org_name')->where('user_id', $id)->where('org_active',1)->get()->toArray();
            } elseif ($value == 1) {
                $result = OrganizationEmployee::select('*')->leftjoin('employees', 'organizations_employees.employee_id', '=', 'employees.id')->where('user_id', $id)->where("specializ_id", 1)->get()->toArray();
            } else {
                $result = OrganizationEmployee::select('*')->leftjoin('employees', 'organizations_employees.employee_id', '=', 'employees.id')->where('user_id', $id)->where("specializ_id", "<>", 1)->get()->toArray();
            }
        } else {

            if ($value == 0) {

                $result = Organization::select('id', 'org_name')->where('user_id', $id)->where('org_active',1)->get()->toArray();
            } elseif ($value == 1) {
                $result = OrganizationEmployee::select('*')->leftjoin('employees', 'organizations_employees.employee_id', '=', 'employees.id')->where('user_id', $id)->where("specializ_id", 1)->where("organization_id", $org_id)->get()->toArray();
            } else {
                $result = OrganizationEmployee::select('*')->leftjoin('employees', 'organizations_employees.employee_id', '=', 'employees.id')->where('user_id', $id)->where("specializ_id", "<>", 1)->where("organization_id", $org_id)->get()->toArray();
            }
        }




        if (isset($result)) {
            echo json_encode($result);
        } else {
            return 0;
        }
    }
    
    
    
     public function preview(Request $request) {
        $id = $request->id;
        $result = User::find($id);
        
        $result->preview = 1;
        $result->save();

        if (isset($result)) {
            return 1;
        } else {
            return 0;
        }
    }
    
    
    public function statdoctor(Request $request) {
        $specialization = DB::table('specializ_types')->select()->get()->toArray();
        $specializ_id = 0;
        $organization_id = session()->get('org_id');
        $array = ["1" => "Январь", "2" => "Февраль", "3" => "Март", "4" => "Апрель", "5" => "Май", "6" => "Июнь", "7" => "Июль", "8" => "Август", "9" => "Сентябрь", "10" => "Октябрь", "11" => "Ноябрь", "12" => "Декабрь"];
     
        if ($request->first_data) {
            $data_first = $request->first_data;
            $month_year1 = explode(' ', $data_first);
            $key1 = array_search($month_year1[0], $array);
            $data_first = date('Y-m-d', strtotime($month_year1[1] . "-" . $key1 . "-1"));
        } else {

            $data_first = date('Y-m-01');
        }
        
        if($request->specialization){
         $specializ_id = $request->specialization;
        
            
          $statistic_doctors = DB::table('statistic_doctors')->select()
                        ->leftjoin('employees', 'employees.id', 'statistic_doctors.employee_id')
                        ->leftjoin('specializ_types', 'specializ_types.id', 'employees.specializ_id')
                        ->where('employees.employee_active', 1)
                        ->where('statistic_doctors.organization_id', $organization_id)
                        ->where('statistic_doctors.specializ_id', $specializ_id)
                        ->where('statistic_doctors.date', $data_first)
                        ->get()->toArray();

        $employee_doctor = DB::table('employees')->select('*', 'employees.id')->where('specializ_id', $specializ_id)->where('employees.employee_active', 1)
                        ->leftjoin('specializ_types', 'specializ_types.id', 'employees.specializ_id')
                        ->leftjoin('organizations_employees', 'organizations_employees.employee_id', 'employees.id')->where('organizations_employees.organization_id', $organization_id)
                        ->get()->toArray();
  
            
        }else{

        $statistic_doctors = DB::table('statistic_doctors')->select()
                        ->leftjoin('employees', 'employees.id', 'statistic_doctors.employee_id')
                        ->leftjoin('specializ_types', 'specializ_types.id', 'employees.specializ_id')
                        ->where('employees.employee_active', 1)
                        ->where('statistic_doctors.organization_id', $organization_id)
                        ->where('statistic_doctors.specializ_id', '<>', 1)
                        ->where('statistic_doctors.date', $data_first)
                        ->get()->toArray();

        $employee_doctor = DB::table('employees')->select('*', 'employees.id')->where('specializ_id', '<>', 1)->where('employees.employee_active', 1)
                        ->leftjoin('specializ_types', 'specializ_types.id', 'employees.specializ_id')
                        ->leftjoin('organizations_employees', 'organizations_employees.employee_id', 'employees.id')->where('organizations_employees.organization_id', $organization_id)
                        ->get()->toArray();            
        }

        $statistic_doc = [];
        if (isset($statistic_doctors)) {
            foreach ($statistic_doctors as $key => $value) {
                $statistic_doc[$value->employee_id] = $value;
            }
        }
        $array = [];
      
        
        $array['statistic_doc'] = $statistic_doc;
        $array['employee_doctor'] = $employee_doctor;
        $array['specialization'] = $specialization;
        $array['data_first'] = $data_first;
        $array['specializ_id'] = $specializ_id;
       
        return json_encode($array);
    }
    
    
    public function statadmin(Request $request) {
        $organization_id = session()->get('org_id');
        $array = ["1" => "Январь", "2" => "Февраль", "3" => "Март", "4" => "Апрель", "5" => "Май", "6" => "Июнь", "7" => "Июль", "8" => "Август", "9" => "Сентябрь", "10" => "Октябрь", "11" => "Ноябрь", "12" => "Декабрь"];

        if ($request->first_data) {
            $data_first = $request->first_data;
            $month_year1 = explode(' ', $data_first);
            $key1 = array_search($month_year1[0], $array);
            $data_first = date('Y-m-d', strtotime($month_year1[1] . "-" . $key1 . "-1"));
        } else {
            
            $data_first = date('Y-m-01');
        }


        $statistic_admins = DB::table('statistic_admins')->select()
                        ->leftjoin('employees', 'employees.id', 'statistic_admins.employee_id')
                        ->where('employees.employee_active', 1)
                        ->where('statistic_admins.organization_id', $organization_id)
                        ->where('statistic_admins.specializ_id', 1)
                        ->where('statistic_admins.date', $data_first)
                        ->get()->toArray();

        $employee_admin = DB::table('employees')->select('*', 'employees.id')->where('specializ_id', 1)->where('employees.employee_active', 1)
                        ->leftjoin('organizations_employees', 'organizations_employees.employee_id', 'employees.id')->where('organizations_employees.organization_id', $organization_id)
                        ->get()->toArray();

        $statistic_admin = [];
        if (isset($statistic_admin)) {
            foreach ($statistic_admins as $key => $value) {
                $statistic_admin[$value->employee_id] = $value;
            }
        }
       
        $array = [];
        $array['statistic_admin'] = $statistic_admin;
        $array['employee_admin'] = $employee_admin;
        $array['data_first'] = $data_first;
  
       
        return json_encode($array);
    }

}
