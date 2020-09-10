<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use App\User;
use App\DoctorReference;
use App\AdminReference;
use App\Specializ;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Organization;
use App\Employee;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Controllers\AppController;
use App\StatisticDoctor;

class ReferenceController extends AppController {

    public function index() {



        /* pass class_id  , city_id  , spec_id  */

        $specializations = DB::table('specializ_types')->select()->get()->toArray();
        $cities = DB::table('cities')->select()->get()->toArray();
        $classes = DB::table('org_classes')->select()->get()->toArray();

        $reference_doctor = DB::table('doctor_reference')->select('*', 'doctor_reference.id')
                        ->where('class_id', 1)
                        ->where('specializ_id', '<>', 1)
                        ->leftjoin('org_classes', 'org_classes.id', '=', 'doctor_reference.class_id')
                        ->leftjoin('cities', 'cities.id', '=', 'doctor_reference.city_id')
                        ->leftjoin('specializ_types', 'specializ_types.id', '=', 'doctor_reference.specializ_id')
                        ->get()->toArray();


        return view('reference.reference_doctor', [
            'reference_doctor' => $reference_doctor,
            'specializations' => $specializations,
            'cities' => $cities,
            'classes' => $classes,
        ]);
    }

    public function admin() {
        $specializations = DB::table('specializ_types')->select()->get()->toArray();
        $cities = DB::table('cities')->select()->get()->toArray();
        $classes = DB::table('org_classes')->select()->get()->toArray();
        /* pass class_id  , city_id  , spec_id  */
        $reference_admin = DB::table('admin_reference')->select('*', 'admin_reference.id')
                        ->where('class_id', 1)
                        ->where('specializ_id', 1)
                        ->leftjoin('org_classes', 'org_classes.id', '=', 'admin_reference.class_id')
                        ->leftjoin('cities', 'cities.id', '=', 'admin_reference.city_id')
                        ->leftjoin('specializ_types', 'specializ_types.id', '=', 'admin_reference.specializ_id')
                        ->get()->toArray();



        return view('reference.reference_admin', [
            'specializations' => $specializations,
            'cities' => $cities,
            'classes' => $classes,
            'reference_admin' => $reference_admin
        ]);
    }

    public function list_ref() {
        $specializations = DB::table('specializ_types')->select()->get()->toArray();
        $cities = DB::table('cities')->select()->get()->toArray();
        $classes = DB::table('org_classes')->select()->get()->toArray();

        return view('reference.reference', [
            'specializations' => $specializations,
            'cities' => $cities,
            'classes' => $classes
        ]);
    }

    public function showreference(Request $request) {
        $city = $request->city;
        $class = $request->class;
        $specializations = Specializ::select()->get()->toArray();

        $reference_doctor = DoctorReference::select("*","doctor_reference.id")->where('city_id', $city)->where('class_id', $class)->leftjoin('specializ_types', 'specializ_types.id', '=', 'doctor_reference.specializ_id')->get()->toArray();
        $reference_admin = AdminReference::select("*","admin_reference.id")->where('city_id', $city)->where('class_id', $class)->leftjoin('specializ_types', 'specializ_types.id', '=', 'admin_reference.specializ_id')->get()->toArray();

        $cities = DB::table('cities')->select()->get()->toArray();
        $classes = DB::table('org_classes')->select()->get()->toArray();

           
 
        foreach ($specializations as $key => $value_spec){
            foreach ($reference_doctor as $keys => $value){
				
                if($value_spec['id'] == $value['specializ_id']){
					
                    $specializations[$key]['city_id'] = $value['city_id'];
					$specializations[$key]['class_id'] = $value['class_id'];
					$specializations[$key]['reference_id'] = $value['id'];
					$specializations[$key]['specializ_id'] = $value['specializ_id'];
					$specializations[$key]['specialization'] = $value['specialization'];
					$specializations[$key]['conversion_normal'] = $value['conversion_normal'];
					$specializations[$key]['conversion_good'] = $value['conversion_good'];
					$specializations[$key]['repetition_rate_normal'] = $value['repetition_rate_normal'];
					$specializations[$key]['repetition_rate_good'] = $value['repetition_rate_good'];
					$specializations[$key]['turnover_normal'] = $value['turnover_normal'];
					$specializations[$key]['turnover_good'] = $value['turnover_good'];
					$specializations[$key]['workload_normal'] = $value['workload_normal'];
					$specializations[$key]['workload_good'] = $value['workload_good'];
					$specializations[$key]['avarage_hour_normal'] = $value['avarage_hour_normal'];
					$specializations[$key]['avarage_hour_good'] = $value['avarage_hour_good'];
					$specializations[$key]['avarage_visit_normal'] = $value['avarage_visit_normal'];
					$specializations[$key]['avarage_visit_good'] = $value['avarage_visit_good'];
					
                }
            }
        }
   
      
        foreach ($specializations as $key => $value_spec){
            foreach ($reference_admin as $keys => $value){
				
                if($value_spec['id'] == $value['specializ_id']){
                    $specializations[$key]['city_id'] = $value['city_id'];
					$specializations[$key]['class_id'] = $value['class_id'];
                                        $specializations[$key]['reference_id'] = $value['id'];
					$specializations[$key]['specializ_id'] = $value['specializ_id'];
					$specializations[$key]['specialization'] = $value['specialization'];
					$specializations[$key]['conversion1_normal'] = $value['conversion1_normal'];
					$specializations[$key]['conversion1_good'] = $value['conversion1_good'];
					$specializations[$key]['conversion2_normal'] = $value['conversion2_normal'];
					$specializations[$key]['conversion2_good'] = $value['conversion2_good'];
					$specializations[$key]['conversion3_normal'] = $value['conversion3_normal'];
					$specializations[$key]['conversion3_good'] = $value['conversion3_good'];
                }
            }
        }
     

  
        return view('reference.reference_show', [
            'specializations' => $specializations,
            'cities' => $cities,
            'classes' => $classes,
            'city' => $city,
            'class' => $class
        ]);
    }

}
