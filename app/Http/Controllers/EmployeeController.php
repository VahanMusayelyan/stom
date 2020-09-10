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
use App\OrganizationEmployee;
use Illuminate\Support\Facades\DB;

class EmployeeController extends AppController {

    public function index() {
        if (Auth::user() && Auth::user()->role_id == 2) {
            $id = Auth::user()->id;

            $result = Employee::select('*', 'employees.id')->where('employees.user_id', $id)->where('employees.employee_active', 1)
                    ->leftjoin('specializ_types', 'specializ_types.id', 'employees.specializ_id')
                    ->leftjoin('users', 'users.id', '=', 'employees.user_id')
                    ->paginate(10);
        } elseif (Auth::user() && Auth::user()->role_id == 1) {

            $result = Employee::select('*', 'employees.id')
                    ->leftjoin('specializ_types', 'specializ_types.id', 'employees.specializ_id')
                    ->leftjoin('users', 'users.id', '=', 'employees.user_id')
                    ->paginate(10);
        }

        return view('employees.list', ['result' => $result]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $id = Auth::user()->id;
        $organizations = DB::table('organizations')->select()->where('user_id', $id)->where('org_active', 1)->get();
        $specializations = DB::table('specializ_types')->select()->get();

        return view('employees.form', ['organizations' => $organizations,
            'specializations' => $specializations]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $validatedData = $request->validate([
            'employee_name' => ['required'],
            'org' => ['required'],
                ], [
            'employee_name.required' => 'Поле имя фамилия обязательно заполнить',
            'org.required' => 'Поле организация обязательно заполнить'
        ]);

        $data = new Employee;
        $data->employee_name = $request->employee_name;
        $data->user_id = Auth::user()->id;
        $data->specializ_id = $request->spec;
       
        $data->save();

        $id = $data->id;
        $org = $request->org;

        if ($request->spec == 1) {
            $messege = 'Администратор успешно добавлено';
        } else {
            $messege = 'Врачь успешно добавлено';
        }

        foreach ($org as $value) {
            DB::table('organizations_employees')->insert([
                'employee_id' => $id,
                'organization_id' => $value]);
        }


        return redirect()->route('employees.create')->with('success', $messege);
        ;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($specializ) {
        $id = Auth::user()->id;
        if ($specializ == 'doctor') {
            $results = Employee::select('*', 'employees.id')->where('employees.user_id', $id)->where('employees.employee_active', 1)->where('employees.specializ_id', '>', 1)
                    ->leftjoin('specializ_types', 'specializ_types.id', 'employees.specializ_id')
                    ->leftjoin('users', 'users.id', '=', 'employees.user_id')
                    ->leftjoin('organizations_employees', 'organizations_employees.employee_id', '=', 'employees.id')
                    ->leftjoin('organizations', 'organizations.id', '=', 'organizations_employees.organization_id')
                    ->where('organizations_employees.employee_active', 1)
                    ->get();
        } else {
            $results = Employee::select('*', 'employees.id')->where('employees.user_id', $id)->where('employees.employee_active', 1)->where('employees.specializ_id', 1)
                    ->leftjoin('specializ_types', 'specializ_types.id', 'employees.specializ_id')
                    ->leftjoin('users', 'users.id', '=', 'employees.user_id')
                    ->leftjoin('organizations_employees', 'organizations_employees.employee_id', '=', 'employees.id')
                    ->leftjoin('organizations', 'organizations.id', '=', 'organizations_employees.organization_id')
                    ->where('organizations_employees.employee_active', 1)
                    ->get();
        }
        
        $result = [];
        $small = [];
        
        foreach ($results as $key => $value){
            
            $result[$value->id] = $value;
          
            $small[$value->id][$value->organization_id] = $value->org_name;
               
           $result[$value->id]['org'] = $small[$value->id];
            
          
        }
     
        return view('employees.list', ['result' => $result,'specializ' => $specializ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {

        $user_id = Auth::user()->id;
        $organizations = DB::table('organizations')->select()->where('user_id', $user_id)->where("org_active",1)->get();
        $specializations = DB::table('specializ_types')->select()->get();

        $data = new Employee;
        $result = Employee::select('*', 'employees.id')->where('employees.id', $id)
                ->leftjoin('specializ_types', 'specializ_types.id', 'employees.specializ_id')
                ->get();
        
        $org_empl = OrganizationEmployee::where('employee_id',$id)->where('employee_active',1)->get()->toArray();
        $array_org = [];
        
        foreach ($org_empl as $key => $value){
            $array_org[$value['organization_id']] = $value;
        }
     

        return view('employees.edit', ['result' => $result,
            'organizations' => $organizations,
            'array_org' => $array_org,
            'specializations' => $specializations
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
        $org = $request->org;
        DB::table('organizations_employees')->where('employee_id', $id)->delete();
        

        foreach ($org as $value) {
            DB::table('organizations_employees')->insert([
                'employee_id' => $id,
                'organization_id' => $value]);
        }

        $data = new Employee;
        $data = $data->find($id);
        $data->employee_name = $request->employee_name;
        $data->user_id = Auth::user()->id;
        $data->specializ_id = $request->spec;
        $data->save();
 
        
        if($request->spec > 1){
            $personal = "doctor";
        }else{
            $personal = "admin";
        }

        return redirect('/employees/'.$personal);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
       
        Employee::where('id', $id)->update(['employee_active' => 0]);
        DB::table('organizations_employees')->select()->where('employee_id', $id)
                ->update(['employee_active' => 0]);
        
        return redirect()->back();
    }

    public function admin(Request $request) {
        $id = Auth::user()->id;
        $organizations = DB::table('organizations')->select()->where('user_id', $id)->where('org_active', 1)->get();
        $specializations = DB::table('specializ_types')->select()->get();

        $request->session()->put('personal', 1);
        return view('employees.form', ['organizations' => $organizations,
            'specializations' => $specializations]);
    }

    public function doctor(Request $request) {
        $id = Auth::user()->id;
        $organizations = DB::table('organizations')->select()->where('user_id', $id)->where('org_active', 1)->get();
        $specializations = DB::table('specializ_types')->select()->get();
        $request->session()->put('personal', 2);
        return view('employees.form', ['organizations' => $organizations,
            'specializations' => $specializations]);
    }

}
