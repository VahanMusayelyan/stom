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
use Illuminate\Support\Facades\DB;
use App\OrganizationEmployee;

class OrganizationController extends AppController {

    public function index() {
        if (Auth::user() && Auth::user()->role_id == 2) {
            $id = Auth::user()->id;
            $result = DB::table('organizations')->select('*', 'organizations.id')->where('user_id', $id)
                    ->leftjoin('organiz_types', 'organiz_types.id', 'organizations.ownership_type_id')
                    ->leftjoin('org_classes', 'org_classes.id', '=', 'organizations.org_class_id')
                    ->leftjoin('countries', 'countries.id', '=', 'organizations.country_id')
                    ->leftjoin('regions', 'regions.id', '=', 'organizations.region_id')
                    ->leftjoin('cities', 'cities.id', '=', 'organizations.city_id')
                    ->leftjoin('users', 'users.id', '=', 'organizations.user_id')
                    ->where("organizations.org_active",1)
                    ->paginate(10);
        } elseif (Auth::user() && Auth::user()->role_id == 1) {

            $result = DB::table('organizations')->select('*', 'organizations.id')
                    ->leftjoin('organiz_types', 'organiz_types.id', 'organizations.ownership_type_id')
                    ->leftjoin('org_classes', 'org_classes.id', '=', 'organizations.org_class_id')
                    ->leftjoin('countries', 'countries.id', '=', 'organizations.country_id')
                    ->leftjoin('regions', 'regions.id', '=', 'organizations.region_id')
                    ->leftjoin('cities', 'cities.id', '=', 'organizations.city_id')
                    ->leftjoin('users', 'users.id', '=', 'organizations.user_id')
                    ->paginate(10);
        }


        return view('organizations.list', ['result' => $result]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $ownership = DB::table('organiz_types')->select()->get();
        $countries = DB::table('countries')->select()->get();
        $regions = DB::table('regions')->select()->get();
        $cities = DB::table('cities')->select()->get();
        $classes = DB::table('org_classes')->select()->get();
        return view('organizations.form', ['ownership' => $ownership,
            'countries' => $countries,
            'regions' => $regions,
            'cities' => $cities,
            'classes' => $classes,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $validatedData = $request->validate([
            'name_organiz' => ['required', 'max:50'],
        ],[
            'name_organiz.required' => 'Поле название организации обязательно заполнить'            
        ]);
        $org = $request->name_organiz;
        $class = $request->class;
        $result = Organization::where('org_name','=',$org)->where('org_class_id','=',$class)->get()->toArray();
        
        if($result){
            return redirect()->back()->with('error', 'Имя с такой клиники уже существует');
        }
        
        $data = new Organization;
        $data->org_name = $request->name_organiz;
        $data->user_id = Auth::user()->id;
        $data->ownership_type_id = $request->ownership;
        $data->country_id = $request->country;
        $data->region_id = $request->region;
        $data->city_id = $request->city;
        $data->org_class_id = $request->class;
        $data->organization_data1 = $request->organization_data1;
        $data->organization_data2 = $request->organization_data2;
        $data->organization_data3 = $request->organization_data3;
        $data->organization_data4 = $request->organization_data4;
        $data->organization_data5 = $request->organization_data5;
        $data->organization_data6 = $request->organization_data6;
        $data->organization_data7 = $request->organization_data7;
        $data->organization_data8 = $request->organization_data8;
        $data->organization_data9 = $request->organization_data9;
        $data->organization_data10 = $request->organization_data10;
        $data->save();

        $request->session()->put('org_name', $data->org_name);
        $request->session()->put('org_id', $data->id);
        
        return redirect()->route('statistics_doctor')->with('success', 'Клиника успешно добавлена');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id) {
        $data = new Organization;


        $result = Organization::select('*', 'organizations.id')->where('organizations.id', $id)
                ->leftjoin('organiz_types', 'organiz_types.id', 'organizations.ownership_type_id')
                ->leftjoin('org_classes', 'org_classes.id', '=', 'organizations.org_class_id')
                ->leftjoin('countries', 'countries.id', '=', 'organizations.country_id')
                ->leftjoin('regions', 'regions.id', '=', 'organizations.region_id')
                ->leftjoin('cities', 'cities.id', '=', 'organizations.city_id')
                ->leftjoin('users', 'users.id', '=', 'organizations.user_id')
                ->get();


        $request->session()->put('org_name', $result[0]->org_name);
        $request->session()->put('org_id', $result[0]->id);


        $employee = OrganizationEmployee::where('organization_id', $id)
                        ->leftjoin('employees', 'organizations_employees.employee_id', '=', 'employees.id')->where("employees.employee_active",1)->get();
        $employees = [];

        foreach ($employee as $key => $value) {
            if ($value->specializ_id == 1) {
                $employees['admin'][$key] = [$value->employee_name];
            } else {
                $employees['doctor'][$key] = [$value->employee_name];
            }
        }


        return view('organizations.show', ['result' => $result, 'employees' => $employees]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {

        $ownership = DB::table('organiz_types')->select()->get();
        $countries = DB::table('countries')->select()->get();
        $regions = DB::table('regions')->select()->get();
        $cities = DB::table('cities')->select()->get();
        $classes = DB::table('org_classes')->select()->get();

        $data = new Organization;
        $result = $data->find($id);

        $ownership = DB::table('organiz_types')->select()->get();

        return view('organizations.edit', ['result' => $result, 'ownership' => $ownership,
            'countries' => $countries,
            'regions' => $regions,
            'cities' => $cities,
            'classes' => $classes,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $data = new Organization;
        $data = $data->find($id);
        $data->org_name = $request->name_organiz;
        $data->user_id = Auth::user()->id;
        $data->ownership_type_id = $request->ownership;
        $data->country_id = $request->country;
        $data->region_id = $request->region;
        $data->city_id = $request->city;
        $data->org_class_id = $request->class;
        $data->organization_data1 = $request->organization_data1;
        $data->organization_data2 = $request->organization_data2;
        $data->organization_data3 = $request->organization_data3;
        $data->organization_data4 = $request->organization_data4;
        $data->organization_data5 = $request->organization_data5;
        $data->organization_data6 = $request->organization_data6;
        $data->organization_data7 = $request->organization_data7;
        $data->organization_data8 = $request->organization_data8;
        $data->organization_data9 = $request->organization_data9;
        $data->organization_data10 = $request->organization_data10;
        $data->save();

        return redirect('/organizations');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $result = DB::table('organizations_employees')->select()->where('organization_id', $id)
                ->leftjoin('employees','employees.id','=','organizations_employees.employee_id')->get()->toArray();
        
        
        
        $result = DB::table('organizations_employees')->select()->where('organization_id', $id)
                ->update(['employee_active' => 0]);
        
        $result = Organization::find($id)->update(['org_active' => 0]);
       
        return redirect()->back();
    }

}
